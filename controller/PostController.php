<?php
namespace controller;

class PostController {

    private $loginView;
    private $db;
    private $session;
    private $cookie;

    public function __construct($login, $db, $session, $cookie) {
        $this->loginView = $login;
        $this->db = $db;
        $this->session = $session;
        $this->cookie = $cookie;
    }

}
