<?php

namespace controller;

class MainController {

    private $layoutView;
    private $loginView;
    private $registerView;
    private $userController;
    private $responseArray;

    public function __construct($layout, $userC, $login, $register) {
        $this->layoutView = $layout;
        $this->loginView = $login;
        $this->registerView = $register;
        $this->userController = $userC;
        $this->responseArray = array();
    }

    public function startApp() {

        if ($this->loginView->isLoginButtonClicked()) {
            echo "This runs if loginbutton is  clicked";
            $this->responseArray = $this->userController->loginResponseFromDatabase();
            if (array_key_exists('db_msg', $this->responseArray)) {
                echo "This runs if login is successeful";
                $this->layoutView->echoHtml(true, $this->responseArray, 'login');
                print_r($_SESSION);
            } else {
                echo "This runs if login is unsuccesseful";
                $this->layoutView->echoHtml(false, $this->responseArray, 'login');
            }

        } else if ($this->registerView->registerLinkIsClicked()) {
            if ($this->registerView->isRegisterButtonClicked()) {
                echo "This runs if someone registers, first startup";
                $this->responseArray = $this->userController->registerResponseFromDatabase();
                if (array_key_exists('db_msg', $this->responseArray)) {
                    $this->layoutView->echoHtml(false, $this->responseArray, 'login');
                } else {
                    $this->layoutView->echoHtml(false, $this->responseArray, 'register');
                }

            } else {
                echo "This runs if register page is loaded";
                $this->layoutView->echoHtml(false, $this->responseArray, 'register');
            }
        } else if ($this->loginView->isLogoutButtonClicked()) {
            echo "this runs if logoutbutton is clicked";
            $this->responseArray = $this->userController->logoutResponse();
            $this->layoutView->echoHtml(false, $this->responseArray, 'login');
            print_r($_SESSION);
        } else {
            echo "This runs if nothing is clicked, first startup";
            $this->layoutView->echoHtml(false, $this->responseArray, 'login');

        }

    }
}

/*switch ($pageState) {
case ($this->loginView->isLoginButtonClicked() == true):
$this->responseArray = $this->userController->loginResponseFromDatabase();
$this->layoutView->echoHtml(false, $this->responseArray, 'login');
break;

case ($this->registerView->registerLinkIsClicked() == true);
if ($this->registerView->isRegisterButtonClicked()) {
$this->responseArray = $this->userController->registerResponseFromDatabase();
if (array_key_exists('db_msg', $this->responseArray)) {
$this->layoutView->echoHtml(false, $this->responseArray, 'login');
} else {
$this->layoutView->echoHtml(false, $this->responseArray, 'register');
}
} else {
$this->layoutView->echoHtml(false, $this->responseArray, 'register');
}
break;

default:
$this->layoutView->echoHtml(false, $this->responseArray, 'login');
break;
}*/
