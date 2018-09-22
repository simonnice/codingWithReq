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

    public function checkRegisterInputs() {
        if (isset($_POST['DoRegistration'])) {

            $data = $this->registerView->getRegisterFormData();

            try {
                $this->state->ValidateRegisterInputData($data);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
