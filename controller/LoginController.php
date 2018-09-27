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

            if ($this->loginView->doesUserWantToStayLoggedIn() == true) {
                $keepMeLoggedIn = true;
            } else {
                $keepMeLoggedIn = false;
            }

            $actualUser = new \model\User($userName, $password, $keepMeLoggedIn);
            try {
                if ($actualUser->getLoggedIn() == true) {
                    setcookie('username', $userName, time() + 3600);
                }
                $this->state->validateLoginInputData($actualUser);
                return $this->state->validateDatabaseQuery($actualUser, $conn);

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
