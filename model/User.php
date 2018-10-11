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

        $sanitizedName = filter_var($this->data['name'], FILTER_SANITIZE_STRING);

        // Validate name && password
        if (empty($this->data['name']) && empty($this->data['password'])) {
            throw new \Exception("Username has too few characters, at least 3 characters.
            Password has too few characters, at least 6 characters.");
        }

        // Validate password
        if (strlen($this->data['password']) < 6) {
            throw new \Exception("Password has too few characters, at least 6 characters.");
        }

        // Validate name
        if (strlen($this->data['name']) < 3) {
            throw new \Exception("Username has too few characters, at least 3 characters.");
        }

        // Validate Confirm password && password
        if ($this->data['password'] !== $this->data['confirm_password']) {
            throw new \Exception("Passwords do not match.");
        }

        // Validate for invalid characters in name
        if ($this->data['name'] != $sanitizedName) {
            throw new \Exception("Username contains invalid characters.");
        }

        // Validate if User Exists
        if ($this->doesUserExist($this->data['name'])) {
            throw new \Exception("User exists, pick another username.");
        }

        return $this->data;

    }

    public function registerNewUser($validatedRegisterInput) {

        $this->data = $validatedRegisterInput;

        // Hashing password
        $hashedPassword = password_hash($this->data->getPassword(), PASSWORD_DEFAULT);

        // Register the user
        $this->database->prepareStatementWithQuerytoDb('INSERT INTO user (name, password) VALUES (:name, :password)');

        // Bind the values
        $this->database->bindValuesToPlaceholder(':name', $this->data->getUserName());
        $this->database->bindValuesToPlaceholder(':password', $hashedPassword);

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
        $responseString = '';
        foreach ($arrayToFilter as $key => $value) {

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
        return $responseArray;
    }

    public function generateSuccessResponseToView($typeOfSuccess) {

        return $typeOfSuccess;
    }
}
