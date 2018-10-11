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
        
        
        else {
            if ($this->session->isSessionSet()) {
                $this->data['db_msg'] = "";
            } else {
                $this->data['db_msg'] = "Welcome";
            }
        }
    }
}
