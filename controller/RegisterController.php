<?php

namespace controller;

class RegisterController {

    private $registerView;
    private $user;
    private $session;
    private $message;

    public function __construct($register, $user, $session, $message) {
        $this->registerView = $register;
        $this->user = $user;
        $this->session = $session;
        $this->message = $message;
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

    public function registerResponseFromDatabase() {

        try {
            $registerInput = $this->registerInputResponse();
            $validatedData = $this->validatedRegisterFormData($registerInput);
            $this->user->registerNewUser($validatedData);
            return true;

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

}
