<?php

namespace controller;

class RegisterController {

    private $session;
    private $db;

    public function __construct($session, $db) {

        $this->session = $session;
        $this->db = $db;

    }

    public function sendRegisterInfoToDb($registerinfo) {

        $this->db->registerNewUser($registerinfo);

    }

}
