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
            $userName = $this->loginView->getLoginUserName();
            $password = $this->loginView->getLoginPassword();

            if ($this->loginView->doesUserWantToStayLoggedIn() == true) {
                $keepMeLoggedIn = true;
            } else {
                $keepMeLoggedIn = false;
            }

            $actualUser = new \model\User($userName, $password, $keepMeLoggedIn);
            try {

                $this->state->validateLoginInputData($actualUser);

                return $arrayOfValues = array("value" => $this->state->validateDatabaseQuery($actualUser, $conn), "keepLoggedIn" => $keepMeLoggedIn);

            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function checkIfLogoutButtonIsClicked() {
        if ($this->loginView->isLogoutButtonClicked() == true) {
            setcookie('username', null, time() - 3600);
            session_destroy();
            return true;
        }
    }

}
