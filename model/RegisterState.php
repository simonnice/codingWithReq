<?php

namespace model;

class RegisterState {

    public function ValidateRegisterInputData($data) {

        $sanitizedName = filter_var($data['RegisterView::UserName'], FILTER_SANITIZE_STRING);

        $sanitizedPassword = filter_var($data['RegisterView::Password'], FILTER_SANITIZE_STRING);
        $sanitizedRepeatPassword = filter_var($data['RegisterView::PasswordRepeat'], FILTER_SANITIZE_STRING);

        $sanitizedName = filter_var($data['RegisterView::UserName'], FILTER_SANITIZE_SPECIAL_CHARS);
        $sanitizedPassword = filter_var($data['RegisterView::Password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $sanitizedRepeatPassword = filter_var($data['RegisterView::PasswordRepeat'], FILTER_SANITIZE_SPECIAL_CHARS);

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

        if ($sanitizedName != $data['RegisterView::UserName']) {
            throw new \Exception("Username contains invalid characters.");
        }

    }

    public function CreateNewUserFromInput($data, $conn) {
        $userName = mysqli_real_escape_string($conn, $data['RegisterView::UserName']);
        $password = mysqli_real_escape_string($conn, $data['RegisterView::Password']);

        $checkIfUserNameExistsQuery = "SELECT id FROM user WHERE name= '" . $userName . "'";
        $result = mysqli_query($conn, $checkIfUserNameExistsQuery);
        $row = mysqli_fetch_assoc($result);

        if (!empty($row)) {
            throw new \Exception("User exists, pick another username.");
        } else {
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
            $query = "INSERT INTO user(name, password) VALUES('$userName', '$encryptedPassword')";

            mysqli_query($conn, $query);
            return true; 
        

    }
}
