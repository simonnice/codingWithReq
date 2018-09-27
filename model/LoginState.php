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

        $userName = mysqli_real_escape_string($conn, $userData->getUserName());
        $password = mysqli_real_escape_string($conn, $userData->getPassword());

        $query = "SELECT name, password FROM user WHERE name= '" . $userName . "'";

        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);

        if ($userName === $row['name'] && password_verify($password, $row['password'])) {
            $_SESSION['loggedInUser'] = $row['name'];
            if ($userData->getLoggedIn() == true) {
                setcookie('username', $userName, time() + 3600);
            }
            return true;
        } else {
            throw new \Exception("Wrong name or password");
        }

    }

}
