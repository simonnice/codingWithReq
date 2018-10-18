<?php
namespace controller;

class PostController {

    private $db;
    private $session;

    public function __construct($db, $session) {
        $this->db = $db;
        $this->session = $session;
    }

    public function sendPostInfoToDB($postInfo) {
        $this->db->createNewPost($postInfo);
    }

    public function getPostsFromDB($user) {
        return $this->db->getPosts($user);
    }

}
