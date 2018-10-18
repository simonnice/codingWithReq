<?php

namespace Model;

class Post {

    private $db;
    private $userId;
    private $title;
    private $body;

    public function __construct($userId, $title, $body, $db) {
        $this->db = $db;

        if (!$title) {
            throw new \Exception("Title is missing. You will need to add one.");
        }

        if (!$body) {
            throw new \Exception("Body is missing. You will need to add one.");
        }

        if (strlen($body < 1)) {
            throw new \Exception("You need to atleast write something in your post!");
        }

        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;

    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getBody(): string {
        return $this->body;
    }

    public function getUserId(): int {
        return $this->userId;
    }

}
