<?php
namespace controller;

class registerController {
    private $state;
    private $registerView;
    public function __construct($state, $register) {
        $this->state = $state;
        $this->registerView = $register;
    }
    /**
     * Handle a GET request to Register.php
     *testing
     */
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
                $this->state->ValidateRegisterInputData($data);
                return $this->state->CreateNewUserFromInput($data, $conn);

            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }

    }
}
