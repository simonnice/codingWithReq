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
            throw new \Exception("Title is missing");
        }

        if (!$body) {
            throw new \Exception("Body is missing");
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
