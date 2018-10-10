<?php

namespace controller;

class RegisterController extends MainController {

    private $registerView;
    private $user;
    private $session;

    public function __construct($register, $user, $session) {
        $this->registerView = $register;
        $this->user = $user;
        $this->session = $session;
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

    public function validatetRegisterFormData($data) {
        return $validatedRegisterInput = $this->user->validateRegisterInputInForm($data);
    }

    // Returns a boolean to determine if registration was successful or not

    public function registerResponseFromDatabase() {

        $registerInput = $this->registerInputResponse();
        $validatedData = $this->validatetRegisterFormData($registerInput);

        if (strlen($validatedData) == 0) {
            $this->user->registerNewUser($validatedData);
            $successfulRegistration = true;
            return $this->user->generateSuccessResponseToView($successfulRegistration);

        } else {

            return $this->user->generateErrorResponseToView($validatedData);
        }

    }

}
