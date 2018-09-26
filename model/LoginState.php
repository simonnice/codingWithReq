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

    public function validateDatabaseQuery($userData, $conn) {

        $userName = $userData->getUserName();
        $password = $userData->getPassword();

        $query = "SELECT name, password FROM user WHERE name= '" . $userName . "'";

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);

        if ($userName === $row['name'] && password_verify($password, $row['password'])) {
            return true;
        } else {
            throw new \Exception("Wrong name or password");
        }

    }

}
