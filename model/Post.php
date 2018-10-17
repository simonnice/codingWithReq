<?php

class Post {

    private $db;
    private $user_id;
    private $title;
    private $body;
    private $createdAt;

    public function __construct($user_id, $title, $body, $createdAt, $db) {
        $this->db = new Database;

        if (!$title) {
            throw new \Exception("Title is missing");
        }

        if (!$body) {
            throw new \Exception("Body is missing");
        }

    }

}
