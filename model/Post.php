<?php

class Post {

    private $db;

    public function __construct($db) {
        $this->db = new Database;
    }
}
