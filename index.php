<?php

//INCLUDE THE FILES NEEDED...
require_once 'view/LoginView.php';
require_once 'view/registerView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'controller/LoginController.php';
require_once 'controller/RegisterController.php';
require_once 'model/LoginState.php';

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

//CREATE OBJECTS OF THE VIEWS
$loginView = new \view\LoginView();
$dateTimeView = new \view\DateTimeView();
$layoutView = new \view\LayoutView();
$registerView = new \view\RegisterView();

//CREATE OBJECTS OF THE MODELS
$state = new \model\LoginState();

// CREATE OBJECTS OF THE CONTROLLER
$loginController = new \controller\LoginController($state, $loginView);
$registerController = new \controller\registerController($registerView);

$layoutView->echoHtml(false, $loginView, $dateTimeView, $registerView, $loginController, $registerController);
