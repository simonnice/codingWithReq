<?php

namespace model;

class User {

    private $database;
    private $session;
    private $data = array();

    // private $userName;
    // private $password;
    // private $keepMeLoggedIn;

    public function __construct($database, $session) {
        $this->database = $database;
        $this->session = $session;
    }

    // Will take in $this->data in the form of an array to validate
    public function validateRegisterInputInForm($userInputRegister) {

        $this->data = $userInputRegister;
        $returnString = "";

        $sanitizedName = filter_var($this->data['name'], FILTER_SANITIZE_STRING);

        // Validate name && password
        if (empty($this->data['name']) && empty($this->data['password'])) {
            $returnString .= "Username has too few characters, at least 3 characters. <br>";
            $returnString .= "Password has too few characters, at least 6 characters.";
        } else

        // Validate password
        if (strlen($this->data['password']) < 6) {
            $returnString .= "Password has too few characters, at least 6 characters.";
        } else

        // Validate name
        if (strlen($this->data['name']) < 3) {
            $returnString .= "Username has too few characters, at least 3 characters.";
        } else

        // Validate Confirm password && password
        if ($this->data['password'] !== $this->data['confirm_password']) {
            $returnString .= "Passwords do not match.";
        } else

        // Validate for invalid characters in name
        if ($this->data['name'] != $sanitizedName) {
            $returnString .= "Username contains invalid characters.";
        } else

        // Validate if User Exists
        if ($this->doesUserExist($this->data['name'])) {
            $returnString .= "User exists, pick another username.";
        }

        return $returnString;

    }

    public function registerNewUser($validatedRegisterInput) {

        $this->data = $validatedRegisterInput;

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

    public function validateLoginInputInForm($userInputLogin) {

        $this->data = $userInputLogin;

        if (empty($this->data['name'])) {
            $this->data['name_err'] = "Username is missing";

        } else if (empty($this->data['password'])) {
            $this->data['password_err'] = "Password is missing";
        } else if (!$this->doesInputUserMatchDbUser($this->data['name'], $this->data['password'])) {
            $this->data['db_err'] = "Wrong name or password";
        } else {
            if ($this->session->isSessionSet()) {
                $this->data['db_msg'] = "";
            } else {
                $this->data['db_msg'] = "Welcome";
            }
        }

        return $this->data;
    }

    public function loginUser($validatedUser) {

        $this->database->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');
        $this->database->bindValuesToPlaceholder(':name', $validatedUser);

        $row = $this->database->retrieveSingleObject();

        $this->session->createUserSessions($row);

        return $row;

    }

    public function logoutUser() {
        if ($this->session->isSessionSet()) {
            $this->session->destroyCurrentSession();
            $this->data['db_msg'] = "Bye bye!";
        } else {
            $this->data['db_msg'] = "";
        }

        return $this->generateSuccessResponseToView($this->data);
    }

    public function doesUserExist($userName) {
        $this->database->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');

        $this->database->bindValuesToPlaceholder(':name', $userName);

        $row = $this->database->retrieveSingleObject();

        if ($this->database->checkIfEntryExists() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function doesInputUserMatchDbUser($username, $password) {

        $this->database->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');
        $this->database->bindValuesToPlaceholder(':name', $username);

        if ($this->doesUserExist($username)) {
            $row = $this->database->retrieveSingleObject();
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        if (password_verify($password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }

    public function generateErrorResponseToView($arrayToFilter) {
        $messageString = "";

        foreach ($arrayToFilter as $key => $value) {

            if ($key == "name") {
                $responseArray[$key] = $value;
            }

            if ($key == "name_err") {
                $responseArray[$key] = $value;
            }

            if ($key == "password_err") {
                $responseArray[$key] = $value;
            }

            if ($key == "confirm_password_err") {
                $responseArray[$key] = $value;
            }

            if ($key == "db_err") {
                $responseArray[$key] = $value;
            }
        }
        return $messageString;
    }

    public function generateSuccessResponseToView($typeOfMessage) {
        $successArray = array();
        foreach ($arrayToFilter as $key => $value) {
            if ($key == "db_msg") {
                $successArray[$key] = $value;
            }

            if ($key == "name") {
                $successArray[$key] = $value;
            }
        }

        return $successArray;
    }
}
