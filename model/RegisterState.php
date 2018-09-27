<?php

namespace model;

class RegisterState {

    public function ValidateRegisterInputData($registeredUser) {

        $sanitizedName = filter_var($registeredUser->getUserName(), FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($registeredUser->getPassword(), FILTER_SANITIZE_STRING);
        $sanitizedRepeatPassword = filter_var($registeredUser->getRepeatedPassword(), FILTER_SANITIZE_STRING);

        if (empty($sanitizedName) == true && empty($sanitizedPassword) == true) {
            throw new \Exception("Username has too few characters, at least 3 characters.
            Password has too few characters, at least 6 characters.");
        }

        if (strlen($sanitizedPassword) < 6) {
            throw new \Exception("Password has too few characters, at least 6 characters.");
        }

        if (strlen($sanitizedName) < 3) {
            throw new \Exception("Username has too few characters, at least 3 characters.");
        }

        if ($sanitizedPassword != $sanitizedRepeatPassword) {
            throw new \Exception("Passwords do not match.");
        }

        if ($sanitizedName != $registeredUser->getUserName()) {
            throw new \Exception("Username contains invalid characters.");
        }

    }

    public function CreateNewUserFromInput($registerUserToDB, $conn) {
        $userName = mysqli_real_escape_string($conn, $registerUserToDB->getUserName());
        $password = mysqli_real_escape_string($conn, $registerUserToDB->getPassword());

        $checkIfUserNameExistsQuery = "SELECT id FROM user WHERE name= '" . $userName . "'";
        $result = mysqli_query($conn, $checkIfUserNameExistsQuery);
        $row = mysqli_fetch_assoc($result);

        if (!empty($row)) {
            throw new \Exception("User exists, pick another username.");
        } else {
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
            $query = "INSERT INTO user(name, password) VALUES('$userName', '$encryptedPassword')";

            if (mysqli_query($conn, $query)) {
                $_SESSION['newUser'] = $userName;

                return true;
            } else {
                echo 'ERROR: ' . mysqli_error($conn);
            }
        }

    }
}
