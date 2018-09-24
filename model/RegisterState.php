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

    }

    public function CreateNewUserFromInput($data, $conn) {
        $userName = mysqli_real_escape_string($conn, $data['RegisterView::UserName']);
        $password = mysqli_real_escape_string($conn, $data['RegisterView::Password']);

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

        $checkIfUserNameExistsQuery = "SELECT id FROM user WHERE name= '" . $userName . "'";

        $result = mysqli_query($conn, $checkIfUserNameExistsQuery);
        $row = mysqli_fetch_assoc($result);

        if (!empty($row)) {
            throw new \Exception("User exists, pick another username.");
        } else {
            $query = "INSERT INTO user(name, password) VALUES('$userName', '$encryptedPassword')";

            if (mysqli_query($conn, $query)) {
                header('Location: ' . ROOT_URL . '');
            } else {
                echo 'ERROR: ' . mysqli_error($conn);
            }
        }

    }
}
