<?php

class Login {

    private $username;
    private $password;
    private $db;

    public __construct($userName, $password, $db) {
        $this->db = $db;

        if (!$userName) {
            throw new \Exception("Username is missing");
        }

        if (!$password) {
            throw new \Exception("Password is missing");
        } 
        
        if (!$this->db->doesInputUserMatchDbUser($userName, $password)) {
            throw new \Exception("Wrong name or password");
        }
        
        $this->userName = $userName;
        $this->password = $password;
        
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassword(){
        return $this->password;
    }
}
