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
            'db_msg' => '',
            'name_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'db_err' => '',
        ];

        return $data;

    }

    // returns the response from validation in User Model

    public function validatedRegisterFormData($data) {
        return $validatedRegisterInput = $this->user->validateRegisterInputInForm($data);
    }

    // Returns a boolean to determine if registration was successful or not

    public function registerResponseFromDatabase() {

        $registerInput = $this->registerInputResponse();
        $validatedData = $this->validatedRegisterFormData($registerInput);

        if (empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['db_err'])) {
            $this->user->registerNewUser($validatedData);
            return true;

        } else {

            return $validatedData;
        }

    }

}
