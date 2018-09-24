<?php

namespace model;

class LoginState {

    public function validateLoginInputData($userData) {

        if ($userData->getUserName() == "") {
            throw new \Exception('Username is missing');

        } else if ($userData->getPassword() == "") {
            throw new \Exception('Password is missing');
        }

    }

    public function validateDatabaseQuery($userData) {

        $userName = $userData->getUserName();
        $password = $userData->getPassword();
        $query = 'SELECT name, password FROM user WHERE name= .$userData'
}

}
