<?php

namespace model;

class User{
    private $userName;
    private $password
    private $loggedIn;

    public function __construct($userName, $password, $loggedIn) {
        $this->userName = $userName;
        $this->password = $password;
        $this->loggedIn = $loggedIn;
    }
}