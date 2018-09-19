<?php

//INCLUDE THE FILES NEEDED...
require_once 'view/LoginView.php';
require_once 'view/RegisterView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'controller/LoginController.php';
require_once 'controller/RegisterController.php';
require_once 'model/LoginState.php';
require_once 'model/RegisterState.php';

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$loginView = new \view\LoginView();
$dateTimeView = new \view\DateTimeView();
$layoutView = new \view\LayoutView();
$registerView = new \view\RegisterView();

//CREATE OBJECTS OF THE MODELS
$loginState = new \model\LoginState();
$registerState = new \model\RegisterState();

// CREATE OBJECTS OF THE CONTROLLER
$loginController = new \controller\LoginController($loginState, $loginView);
$registerController = new \controller\registerController($registerState, $registerView);

$layoutView->echoHtml(false, $loginView, $dateTimeView, $registerView, $loginController, $registerController);
