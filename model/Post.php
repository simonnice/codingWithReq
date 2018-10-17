<?php

namespace Model;

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

        $this->user_id = $user_id;
        $this->title = $title;
        $this->body = $body;
        $this->createdAt = $createdAt;

    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getBody(): string {
        return $this->body;
    }

}
