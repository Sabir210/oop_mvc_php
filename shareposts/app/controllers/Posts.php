<?php

class Posts extends Controller {

    public function __construct() {
        // Will redirect regardless of what method is used.
        if(!isLoggedIn()) {
            redirect("users/login");
        }
        $this->postsModel = $this->model('Post');
    }

    public function index() {
        // Get posts
        $posts = $this->postsModel->getPosts();
        $data = ['posts' => $posts];
        $this->view("posts/index", $data);
    }
}