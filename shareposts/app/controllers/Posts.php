<?php

class Posts extends Controller {

    public function __construct() {
        // Will redirect regardless of what method is used.
        if(!isLoggedIn()) {
            redirect("users/login");
        }
        $this->postsModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index() {
        // Get posts
        $posts = $this->postsModel->getPosts();
        $data = ['posts' => $posts];
        $this->view("posts/index", $data);
    }

    public function add() {
        if($_SERVER["REQUEST_METHOD"] == 'POST') {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'userId' => $_SESSION['userId'],
                'titleError' => '',
                'bodyError' => ''
             ];
            //  Validate the title
            if(empty($data['title'])) {
                $data['titleError'] = "Please enter a title";
            }
            //  Validate the body
            if(empty($data['body'])) {
                $data['bodyError'] = "Please enter body text";
            }
            // Make Sure there are no errors.
            if(empty($data['titleError']) && empty($data['bodyError'])) {
                if($this->postsModel->addPost($data)) {
                    flash('postMessage', "Post added successfully.");
                    redirect('posts');
                } else {
                    die("Something went wrong.");
                }
            } else {
                // Reload view with errors
                $this->view("posts/add", $data);
            }
        } else {
            $data = [
               'title' =>'',
               'body' => ''
            ];
            $this->view("posts/add", $data);
        }
    }

    public function show($id) {
        $post = $this->postsModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view("posts/show", $data);
    }

    public function edit($id) {
        if($_SERVER["REQUEST_METHOD"] == 'POST') {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'id' => $id,
                'titleError' => '',
                'bodyError' => ''
             ];
            //  Validate the title
            if(empty($data['title'])) {
                $data['titleError'] = "Please enter a title";
            }
            //  Validate the body
            if(empty($data['body'])) {
                $data['bodyError'] = "Please enter body text";
            }
            // Make Sure there are no errors.
            if(empty($data['titleError']) && empty($data['bodyError'])) {
                if($this->postsModel->updatePost($data)) {
                    flash('postMessage', "Post updated successfully.");
                    redirect('posts');
                } else {
                    die("Something went wrong.");
                }
            } else {
                // Reload view with errors
                $this->view("posts/edit", $data);
            }
        } else {
            // Get existing post from model
            $post = $this->postsModel->getPostById($id);
            // Check for owner
            if($post->user_id != $_SESSION['userId']) {
                redirect('posts');
            }
            $data = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body
            ];
            $this->view("posts/edit", $data);
        }
    }

    public function delete($id) {
        // Get existing post from model
        $post = $this->postsModel->getPostById($id);
        // Check for owner
        if($post->user_id != $_SESSION['userId']) {
            redirect('posts');
        }
        if($_SERVER["REQUEST_METHOD"] == 'POST') {
            if($this->postsModel->deletePost($id)) {
                flash('postMessage', "Post deleted successfully");
                redirect('posts');
            } else {
                die("Something went wrong");
            }
        } else {
            redirect('posts');
        }
    } 
}