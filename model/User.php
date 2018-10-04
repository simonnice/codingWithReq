<?php

namespace model;

class User {

    private $database;
    // private $userName;
    // private $password;
    // private $keepMeLoggedIn;

    public function __construct() {
        $this->database = new Database;
    }

    // Will take in $data in the form of an array to validate
    public function validateInputInForm($data) {

    }

    // public function getUserName() {
    //     return $this->userName;
    // }

    // public function getPassword() {
    //     return $this->password;
    // }

    // public function getLoggedIn() {
    //     return $this->loggedIn;
    // }
}
