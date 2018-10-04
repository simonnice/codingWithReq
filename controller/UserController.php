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

            try {
                $this->state->ValidateRegisterInputData($registeredUser);
                return $this->state->CreateNewUserFromInput($registeredUser, $conn);

            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }

    }
}
