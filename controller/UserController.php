<?php
namespace controller;

class UserController {
    private $state;
    private $registerView;
    public function __construct($state, $register, $User) {
        $this->state = $state;
        $this->registerView = $register;
        $this->user = $User;
    }

    public function checkIfRegisterIsClicked() {
        if ($this->registerView->registerLinkIsClicked() == true) {
            return true;
        }
    }

    public function checkRegisterInputs() {
        if ($this->registerView->isRegisterButtonClicked() == true) {

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

            $validatedInput = $this->user->validateInputInForm($data);
            if (empty($validatedInput['name_err']) && empty($validatedInput['password_err']) && empty($validatedInput['confirm_password_err'])) {
                $registerUser = $this->user->registerNewUser($validatedInput);
            }

            if ($registerUser) {
                echo "Hurray, it should have been saved to db";
            } else {
                echo "Something is wrong";
            }
        }

    }
}
