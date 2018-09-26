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

    public function checkLoginCredentials($conn) {
        if ($this->loginView->isLoginButtonClicked() == true) {
            $userName = $this->loginView->getLoginUserName();
            $password = $this->loginView->getLoginPassword();
            $actualUser = new \model\User($userName, $password, false);
            try {
                $this->state->validateLoginInputData($actualUser);
                return $this->state->validateDatabaseQuery($actualUser, $conn);
                // return "passed";
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function checkIfLogoutButtonIsClicked() {
        if ($this->loginView->isLogoutButtonClicked() == true) {
            session_destroy();
            return true;
        }
    }

}
