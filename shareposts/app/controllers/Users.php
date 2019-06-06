<?php

class Users extends Controller{
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form


            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'nameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['emailError'] = "Please enter an email";
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = "The email you've entered is already taken";
                }
            }

            // Validate name
            if(empty($data['name'])) {
                $data['nameError'] = "Please enter a name";
            }

            // Validate password
            if(empty($data['password'])) {
                $data['passwordError'] = "Please enter a password";
            } else if(strlen($data['password']) < 6) {
                $data['passwordError'] = "Password must be at least 6 characters long";
            }

            // Validate confirm password
            if(empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = "Please confirm password";
            } else {
                if($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = "Passwords do not match!";
                }
            }

            // Make sure errors are empty
            if(empty($data['nameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                // Validated
                
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if($this->userModel->register($data)) {
                    flash("registerSuccess", "You are registered and can log in");
                    redirect("users/login");
                } else {
                    die("Something went wrong");
                }
            } else {
                // Load with errors
                $this->view("users/register", $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'nameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];
            $this->view("users/register", $data);
        }
    }

    public function login() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form

            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => '',
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['emailError'] = "Please enter an email";
            }

            // Validate password
            if(empty($data['password'])) {
                $data['passwordError'] = "Please enter a password";
            }

            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                $data['emailError'] = "No user found.";
            }

            // Make sure errors are empty
            if(empty($data['emailError']) && empty($data['passwordError'])) {
                // Validated
                // Check and set logged in user.
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser) {
                    // Create session variable
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = "Incorrect password";
                    $this->view("users/login", $data);
                }
            } else {
                // Load with errors
                $this->view("users/login", $data);
            }
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
            $this->view("users/login", $data);
        }
    }

    public function createUserSession($user) {
        $_SESSION['userId'] = $user->id;
        $_SESSION['userEmail'] = $user->email;
        $_SESSION['userName'] = $user->name;
        redirect('posts');
    }

    public function logout() {
        unset($_SESSION['userId']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userName']);
        session_destroy();
        redirect("users/login");
    }

}