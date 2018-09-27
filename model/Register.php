<?php

namespace model;

class Register {
    private $userName;
    private $password;
    private $passwordRepeat;

    public function __construct($userName, $password, $passwordRepeat) {
        $this->userName = $userName;
        $this->password = $password;
        $this->repeatedPassword = $passwordRepeat;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRepeatedPassword() {
        return $this->repeatedPassword;
    }

}
