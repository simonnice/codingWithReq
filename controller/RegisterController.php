<?php

namespace controller;

class RegisterController {

    private $registerView;
    private $session;
    private $message;
    private $user;

    public function __construct($registerView, $session, $message, $user) {
        $this->registerView = $registerView;
        $this->session = $session;
        $this->message = $message;
        $this->user = $user;
    }

    // Cleans up input from register form and returns it
    public function registerInputResponse() {

        $sanitizedName = filter_var($this->registerView->getRegisterUserName(), FILTER_SANITIZE_STRING);
        $sanitizedPassword = filter_var($this->registerView->getRegisterPassword(), FILTER_SANITIZE_STRING);
        $sanitizedRepeatPassword = filter_var($this->registerView->getRegisterRepeatedPassword(), FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($sanitizedName),
            'password' => trim($sanitizedPassword),
            'confirm_password' => trim($sanitizedRepeatPassword),
        ];

        return $data;

    }

    // returns the response from validation in User Model

    public function validatedRegisterFormData($data) {
        return $validatedRegisterInput = $this->user->validateRegisterInputInForm($data);
    }

    // Returns a boolean to determine if registration was successful or not

    public function registerResponseFromDatabase($registerinfo) {

        $this->user->registerNewUser($registerinfo);

    }

}
