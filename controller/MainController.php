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
    private $cookie;

    public function __construct() {
        $this->session = new \model\Session();
        $this->db = new \model\Database($this->session);
        $this->cookie = new \model\Cookie();

        //CREATE OBJECTS OF THE VIEWS
        $this->loginView = new \view\LoginView();
        $this->dateTimeView = new \view\DateTimeView();
        $this->registerView = new \view\RegisterView();
        $this->responseMessages = new \view\Response();

        $this->layoutView = new \view\LayoutView($this->dateTimeView, $this->loginView, $this->registerView);

        // CREATE OBJECTS OF THE CONTROLLER
        $this->loginController = new \controller\LoginController($this->loginView, $this->db, $this->session, $this->cookie);
        $this->registerController = new \controller\RegisterController($this->registerView, $this->session, $this->db);
    }

    public function startApp() {

        // Logic for determining paths in LoginView - Fixed to handle new exception logic and Register class
        if ($this->loginView->isLoginButtonClicked()) {
            try {
                $loginInfo = new \model\Login($this->loginView->getLoginUserName(), $this->loginView->getLoginPassword(), $this->db);
                $this->loginController->login($loginInfo);
                if ($this->loginController->loggedInWithSession($loginInfo)) {
                    $response = $this->loginView->loginResponse($this->responseMessages::welcomeMessage);
                    $this->layoutView->echoHtml(true, $response, 'login');
                } else {
                    $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
                    $this->layoutView->echoHtml(true, $response, 'login');
                }

            } catch (\Exception $e) {
                $this->loginView->setRegisteredUserName($this->loginView->getLoginUserName());
                $this->layoutView->echoHtml(false, $e->getMessage(), 'login');
            }

            // Logic for determining paths in registerView - Fixed to handle new exception logic and Register class
        } else if ($this->registerView->registerLinkIsClicked()) {
            try {
                if ($this->registerView->isRegisterButtonClicked()) {
                    $registerInfo = new \model\Register($this->registerView->getRegisterUserName(),
                        $this->registerView->getRegisterPassword(), $this->registerView->getRegisterRepeatedPassword(), $this->db);
                    $this->registerController->sendRegisterInfoToDb($registerInfo);
                    $response = $this->registerView->registerResponse($this->responseMessages::successfulRegistration);
                    $this->loginView->setRegisteredUserName($registerInfo->getUserName());
                    $this->layoutView->echoHtml(false, $response, 'login');
                } else {
                    $response = $this->registerView->registerResponse($this->responseMessages::noFeedback);
                    $this->layoutView->echoHtml(false, $response, 'register');
                }

            } catch (\Exception $e) {
                $this->registerView->setUserName($this->registerView->getRegisterUserName());
                $this->layoutView->echoHtml(false, $e->getMessage(), 'register');
            }

            // Logic for determining paths Logout
        } else if ($this->loginView->isLogoutButtonClicked()) {
            if ($this->loginController->logoutResponse()) {
                $response = $this->loginView->loginResponse($this->responseMessages::bye);
                $this->layoutView->echoHtml(false, $response, 'login');
            } else {
                $response = $this->registerView->registerResponse($this->responseMessages::noFeedback);
                $this->layoutView->echoHtml(false, $response, 'login');
            }

        } else {
            // Logic for first path
            if ($this->loginController->isLoggedIn()) {
                $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
                $this->layoutView->echoHtml(true, $response, 'login');
            } else {
                $response = $this->loginView->loginResponse($this->responseMessages::noFeedback);
                $this->layoutView->echoHtml(false, $response, 'login');
            }

        }

    }

}

/*switch ($pageState) {
case ($this->loginView->isLoginButtonClicked() == true):
$responseArray = $this->loginController->loginStatus();
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
