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

        if (strlen($sanitizedName) < 3) {
            throw new \Exception("Username has too few characters, at least 3 characters.");
        } else if (strlen($sanitizedPassword) < 6) {
            throw new \Exception("Password has too few characters, at least 6 characters.");
        } else if ($sanitizedPassword != $sanitizedRepeatPassword) {
            throw new \Exception("Passwords do not match.");
        }

    }
}
