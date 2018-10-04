<?php

namespace model;

class User {

    private $database;
    // private $userName;
    // private $password;
    // private $keepMeLoggedIn;

    public function __construct($database) {
        $this->database = $database;
    }

    // Will take in $data in the form of an array to validate
    public function validateInputInForm($data) {

        $sanitizedName = filter_var($data['name'], FILTER_SANITIZE_STRING);

        // Validate name && password
        if (empty($data['name']) && empty($data['password'])) {
            $data['name_err'] = "Username has too few characters, at least 3 characters.";
            $data['password_err'] = "Password has too few characters, at least 6 characters.";
        }

        // Validate password
        if (strlen($data['password']) < 6) {
            $data['password_err'] = "Password has too few characters, at least 6 characters.";
        }

        // Validate name
        if (strlen($data['name']) < 3) {
            $data['name_err'] = "Username has too few characters, at least 3 characters.";
        }

        // Validate Confirm password && password
        if ($data['password'] != $data['confirm_password']) {
            $data['confirm_password_err'] = "Passwords do not match.";
        }

        // Validate for invalid characters in name
        if ($data['name'] != $sanitizedName) {
            $data['name_err'] = "Username contains invalid characters.";
        }

        return $data;

    }

    public function registerNewUser($data) {

        // Hashing password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register the user
        $this->database->prepareStatementWithQuerytoDb('INSERT INTO user (name, password) VALUES (:name, :password)');

        // Bind the values
        $this->database->bindValuesToPlaceholder(':name', $data['name']);
        $this->database->bindValuesToPlaceholder(':password', $data['password']);

        // Execute the statement

        if ($this->database->executeStatement()) {
            return true;
        } else {
            return false;
        }

    }
}
