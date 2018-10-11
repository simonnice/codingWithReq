<?php

namespace controller;

class RegisterController {

    private $registerView;
    private $session;
    private $db;

    public function __construct($registerView, $session, $db) {
        $this->registerView = $registerView;
        $this->session = $session;
        $this->db = $db;

    }

    public function registerResponseFromDatabase($registerinfo) {

        $this->db->registerNewUser($registerinfo);

    }

}
