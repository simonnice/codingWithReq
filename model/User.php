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
        
        // Validate name && password
        if(empty($data['name']) && empty($data['password'])) {
            $data['name_err'] = "Username has too few characters, at least 3 characters."
            $data['password_err'] = "Password has too few characters, at least 6 characters." 
        }
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


if (empty($registeredUser->getUserName()) == true && empty($registeredUser->getPassword()) == true) {
    throw new \Exception("Username has too few characters, at least 3 characters.
    Password has too few characters, at least 6 characters.");
}
