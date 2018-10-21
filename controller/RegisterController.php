<?php

namespace controller;

class RegisterController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function sendRegisterInfoToDB($registerinfo) {
        $this->db->registerNewUser($registerinfo);
    }

}
