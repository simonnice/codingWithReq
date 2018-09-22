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
            throw new \Exception("Username has too few characters, at least 3 characters.<br>
            Password has too few characters, at least 6 characters.<br> ");
        } else if (strlen($sanitizedName) < 3) {
            throw new \Exception("Username has too few characters, at least 3 characters.");
        } else if (strlen($sanitizedPassword) < 6) {
            throw new \Exception("Password has too few characters, at least 6 characters.");
        } else if ($sanitizedPassword != $sanitizedRepeatPassword) {
            throw new \Exception("Passwords do not match.");
        }

    }

    public function CreateNewUserFromInput($data) {
        $userName = mysqli_real_escape_string($data['RegisterView::UserName']);
        $password = mysqli_real_escape_string($data['RegisterView::Password']);

        $query = "INSERT INTO user(name, password) VALUES('$userName', '$password')"

    }
}
