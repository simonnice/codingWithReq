<?php

// Looking good - All dependencies needed
// 19/10 - 18
namespace model;

class Register {
    private $userName;
    private $password;
    private $passwordRepeat;
    private $db;

    public function __construct($userName, $password, $passwordRepeat, $db) {

        $this->db = $db;

        $sanitizedName = filter_var($userName, FILTER_SANITIZE_STRING);

        // Validate name && password
        if (!$userName && !$password && !$passwordRepeat) {
            throw new \Exception("Username has too few characters, at least 3 characters.
            Password has too few characters, at least 6 characters.");
        }

        // Validate password
        if (strlen($password) < 6) {
            throw new \Exception("Password has too few characters, at least 6 characters.");
        }

        // Validate name
        if (strlen($userName) < 3) {
            throw new \Exception("Username has too few characters, at least 3 characters.");
        }

        // Validate Confirm password && password
        if ($password !== $passwordRepeat) {
            throw new \Exception("Passwords do not match.");
        }

        // Validate for invalid characters in name
        if ($userName != $sanitizedName) {
            throw new \Exception("Username contains invalid characters.");
        }

        // Validate if User Exists
        if ($this->db->doesUserExist($userName)) {
            throw new \Exception("User exists, pick another username.");
        }

        $this->userName = $userName;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getPassword(): string {
        return $this->password;
    }
}
