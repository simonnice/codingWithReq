<?php
namespace controller;

require_once 'model/Register.php';

class registerController {
    private $state;
    private $registerView;
    public function __construct($state, $register) {
        $this->state = $state;
        $this->registerView = $register;
    }

    public function checkIfRegisterIsClicked() {
        if ($this->registerView->registerLinkIsClicked() == true) {
            return true;
        }
    }

    public function checkRegisterInputs($conn) {
        if ($this->registerView->isRegisterButtonClicked() == true) {

            $registeredUserName = $this->registerView->getRegisterUserName();
            $registeredPassword = $this->registerView->getRegisterPassword();
            $registeredRepeatPassword = $this->registerView->getRegisterRepeatedPassword();

            $registeredUser = new \model\Register($registeredUserName, $registeredPassword, $registeredRepeatPassword);

            try {
                $this->state->ValidateRegisterInputData($registeredUser);
                return $this->state->CreateNewUserFromInput($registeredUser, $conn);

            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }

    }
}
