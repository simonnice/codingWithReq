<?php

namespace controller;

class MainController {

    private $layoutView;
    private $loginView;
    private $registerView;
    private $dateTimeView;
    private $userController;
    private $registerController;
    private $session;
    private $db;

    public function __construct() {
        $this->session = new \model\Session();
        $this->db = new \model\Database();
        $this->user = new \model\User($this->db, $this->session);

        //CREATE OBJECTS OF THE VIEWS
        $this->loginView = new \view\LoginView($this->user);
        $this->dateTimeView = new \view\DateTimeView();
        $this->registerView = new \view\RegisterView();

        $this->layoutView = new \view\LayoutView($this->dateTimeView, $this->loginView, $this->registerView);

        // CREATE OBJECTS OF THE CONTROLLER
        $this->userController = new \controller\UserController($this->loginView, $this->user, $this->session);
        $this->registerController = new \controller\RegisterController($this->registerView, $this->user, $this->session);
    }

    public function startApp() {

        $responseArray = array();
        if ($this->loginView->isLoginButtonClicked()) {

            $responseArray = $this->userController->loginResponseFromDatabase();
            if (array_key_exists('db_msg', $responseArray)) {

                $this->layoutView->echoHtml(true, $responseArray, 'login');

            } else {

                $this->layoutView->echoHtml(false, $responseArray, 'login');
            }

        } else if ($this->registerView->registerLinkIsClicked()) {
            if ($this->registerView->isRegisterButtonClicked()) {

                $responseArray = $this->userController->registerResponseFromDatabase();
                if (array_key_exists('db_msg', $responseArray)) {
                    $this->layoutView->echoHtml(false, $responseArray, 'login');
                } else {
                    $this->layoutView->echoHtml(false, $responseArray, 'register');
                }

            } else {

                $this->layoutView->echoHtml(false, $responseArray, 'register');
            }
        } else if ($this->loginView->isLogoutButtonClicked()) {

            $responseArray = $this->userController->logoutResponse();
            $this->layoutView->echoHtml(false, $responseArray, 'login');
        } else {
            $this->layoutView->echoHtml(false, $responseArray, 'login');
        }

    }

}

/*switch ($pageState) {
case ($this->loginView->isLoginButtonClicked() == true):
$responseArray = $this->userController->loginResponseFromDatabase();
$this->layoutView->echoHtml(false, $responseArray, 'login');
break;

case ($this->registerView->registerLinkIsClicked() == true);
if ($this->registerView->isRegisterButtonClicked()) {
$responseArray = $this->userController->registerResponseFromDatabase();
if (array_key_exists('db_msg', $responseArray)) {
$this->layoutView->echoHtml(false, $responseArray, 'login');
} else {
$this->layoutView->echoHtml(false, $responseArray, 'register');
}
} else {
$this->layoutView->echoHtml(false, $responseArray, 'register');
}
break;

default:
$this->layoutView->echoHtml(false, $responseArray, 'login');
break;
}*/
