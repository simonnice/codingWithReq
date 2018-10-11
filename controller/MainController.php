<?php

namespace controller;

class MainController {

    private $layoutView;
    private $loginView;
    private $registerView;
    private $dateTimeView;
    private $loginController;
    private $registerController;
    private $session;
    private $db;
    private $responseMessages;
    private $user;

    public function __construct() {
        $this->session = new \model\Session();
        $this->db = new \model\Database();
        $this->user = new \model\User($this->db, $this->session);

        //CREATE OBJECTS OF THE VIEWS
        $this->loginView = new \view\LoginView($this->user);
        $this->dateTimeView = new \view\DateTimeView();
        $this->registerView = new \view\RegisterView();
        $this->responseMessages = new \view\Response();

        $this->layoutView = new \view\LayoutView($this->dateTimeView, $this->loginView, $this->registerView);

        // CREATE OBJECTS OF THE CONTROLLER
        $this->loginController = new \controller\LoginController($this->loginView, $this->user, $this->session, $this->responseMessages);
        $this->registerController = new \controller\RegisterController($this->registerView, $this->session, $this->responseMessages, $this->db);
    }

    public function startApp() {

        $response = '';

        // Logic for determining paths in LoginView, fix incoming
        if ($this->loginView->isLoginButtonClicked()) {
            try {

            }
            if ($this->loginController->loginResponseFromDatabase()) {
                $response = $this->responseMessages::welcomeMessage;
                $this->layoutView->echoHtml(true, $response, 'login');
            } else {
                $response = $this->loginController->loginResponseFromDatabase();
                $this->layoutView->echoHtml(false, $response, 'login');
            }

            // Logic for determining paths in registerView - Fixed to handle new exception logic and Register class
        } else if ($this->registerView->registerLinkIsClicked()) {
            try {
                if ($this->registerView->isRegisterButtonClicked()) {
                    $registerInfo = new \model\Register($this->registerView->getRegisterUserName(),
                        $this->registerView->getRegisterPassword(), $this->registerView->getRegisterRepeatedPassword(), $this->db);
                    $this->registerController->registerResponseFromDatabase($registerInfo);
                    $successMessage = $this->responseMessages::successfulRegistration;
                    $this->layoutView->echoHtml(false, $successMessage, 'login');
                } else {
                    $this->layoutView->echoHtml(false, $response, 'register');
                }

            } catch (\Exception $e) {
                $this->layoutView->echoHtml(false, $e->getMessage(), 'register');
            }

            // Logic for determining paths Logout
        } else if ($this->loginView->isLogoutButtonClicked()) {

            $responseArray = $this->loginController->logoutResponse();
            $this->layoutView->echoHtml(false, $responseArray, 'login');
        } else {
            // Logic for first path
            $this->layoutView->echoHtml(false, $response, 'login');
        }

    }

}

/*switch ($pageState) {
case ($this->loginView->isLoginButtonClicked() == true):
$responseArray = $this->loginController->loginResponseFromDatabase();
$this->layoutView->echoHtml(false, $responseArray, 'login');
break;

case ($this->registerView->registerLinkIsClicked() == true);
if ($this->registerView->isRegisterButtonClicked()) {
$responseArray = $this->loginController->registerResponseFromDatabase();
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
