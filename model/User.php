<?php

namespace model;

class User {

    private $database;
    private $data = array();
    // private $userName;
    // private $password;
    // private $keepMeLoggedIn;

    public function __construct($database) {
        $this->database = $database;
    }

    // Will take in $this->data in the form of an array to validate
    public function validateInputInForm($userInput) {

        $this->data[] = $userInput;

        $sanitizedName = filter_var($this->data['name'], FILTER_SANITIZE_STRING);

        // Validate name && password
        if (empty($this->data['name']) && empty($this->data['password'])) {
            $this->data['name_err'] = "Username has too few characters, at least 3 characters.";
            $this->data['password_err'] = "Password has too few characters, at least 6 characters.";
        }

        // Validate password
        if (strlen($this->data['password']) < 6) {
            $this->data['password_err'] = "Password has too few characters, at least 6 characters.";
        }

        // Validate name
        if (strlen($this->data['name']) < 3) {
            $this->data['name_err'] = "Username has too few characters, at least 3 characters.";
        }

        // Validate Confirm password && password
        if ($this->data['password'] != $this->data['confirm_password']) {
            $this->data['confirm_password_err'] = "Passwords do not match.";
        }

        // Validate for invalid characters in name
        if ($this->data['name'] != $sanitizedName) {
            $this->data['name_err'] = "Username contains invalid characters.";
        }

        return $this->data;

    }

    public function registerNewUser($validatedInput) {

        $this->data[] = $validatedInput;

        // Hashing password
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

        // Register the user
        $this->database->prepareStatementWithQuerytoDb('INSERT INTO user (name, password) VALUES (:name, :password)');

        // Bind the values
        $this->database->bindValuesToPlaceholder(':name', $this->data['name']);
        $this->database->bindValuesToPlaceholder(':password', $this->data['password']);

        // Execute the statement

        if ($this->database->executeStatement()) {
            return true;
        } else {
            return false;
        }

    }

    public function handleUserResponse($responseToUser) {
        $this->data[] = $responseToUser;
        $formattedString;
        foreach ($data as $msg) {
            $formattedString .= $msg . "br";
        }

        return $formattedString;
    }
}
