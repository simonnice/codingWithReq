<?php

namespace controller;

require_once 'model/User.php';

class loginController {

    private $state;
    private $loginView;

    public function __construct(\model\LoginState $state, $login) {
        $this->state = $state;
        $this->loginView = $login;
    }

    /**
     * Handle a login request to the site
     *
     */

    public function checkLoginCredentials() {
        if ($this->loginView->isLoginButtonClicked() == true) {

            // $data = $this->loginView->getFormData();

            $userName = $this->loginView->getLoginUserName();
            $password = $this->loginView->getLoginPassword();

            $actualUser = new \model\User($userName, $password, false);

            try {
                $this->state->validateLoginInputData($actualUser);
                $this->state->validateDatabaseQuery($actualUser);
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }

    }

}
