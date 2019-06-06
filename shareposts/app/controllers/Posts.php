<?php

class Posts extends Controller {

    public function __construct() {
        // Will redirect regardless of what method is used.
        if(!isLoggedIn()) {
            redirect("users/login");
        }
    }

    public function index() {
        $data = [];
        $this->view("posts/index", $data);
    }
}