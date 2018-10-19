<?php

// Looking good
// No unneeded dependencies
// Maybe a little too small to be worth it?
// 19/10-18

namespace controller;

class RegisterController {

    private $db;

    public function __construct($db) {

        $this->db = $db;

    }

    public function sendRegisterInfoToDb($registerinfo) {

        $this->db->registerNewUser($registerinfo);

    }

}
