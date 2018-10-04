<?php
namespace controller;

class UserController extends MainController {

    private $registerView;
    private $loginView;
    private $user;

    public function __construct($register, $login, $User) {
        $this->registerView = $register;
        $this->loginView = $login;
        $this->user = $User;
    }

    public function checkIfRegisterIsClicked() {
        if ($this->registerView->registerLinkIsClicked() == true) {
            return true;
        }
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
            'name_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
        ];

        return $data;

    }

    // returns the response from validation in User Model

    public function validateFormData($data) {
        return $validatedInput = $this->user->validateInputInForm($data);
    }

    // Returns a boolean to determine if registration was successful or not

    public function registerResponseFromDatabase() {

        if ($this->registerView->isRegisterButtonClicked() == true) {

            $registerInput = $this->registerInputResponse();
            $validatedData = $this->validateFormData($registerInput);

            if (empty($validatedData['name_err']) && empty($validatedData['password_err']) && empty($validatedData['confirm_password_err'])) {
                $isRegistered = $this->user->registerNewUser($validatedData);
            } else {
                return $validatedData;
            }

        } else {

            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            return $data;
        }
    }

}
