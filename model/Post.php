<?php

namespace Model;

class Post {

    private $userId;
    private $title;
    private $body;

    public function __construct($userId, $title, $body) {

        if (!$title) {
            throw new \Exception("Title is missing. You will need to add one.");
        }

        if (!$body) {
            throw new \Exception("Body is missing. You will need to add one.");
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
