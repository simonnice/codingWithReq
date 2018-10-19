<?php
namespace controller;

class PostController {

    private $db;

    public function __construct($db) {
        $this->db = $db;

    }

    public function sendPostInfoToDB($postInfo) {
        $this->db->createNewPost($postInfo);
    }

    public function getPostsFromDB($user) {
        return $this->db->getPosts($user);
    }

    public function deletePostFromDB($userId) {
        $this->db->deletePost($userId);
    }

}
