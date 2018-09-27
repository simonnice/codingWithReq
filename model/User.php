<?php

namespace model;

class User {
    private $userName;
    private $password;
    private $keepMeLoggedIn;

    public function __construct($userName, $password, $loggedIn) {
        $this->userName = $userName;
        $this->password = $password;
        $this->loggedIn = $keepMeLoggedIn;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassword() {
        return $this->password;
    }
}
