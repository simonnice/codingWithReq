<?php

//INCLUDE THE FILES NEEDED...
require_once 'config/Config.php';
require_once 'helper/UrlRedirect.php';
require_once 'helper/SessionHelper.php';
require_once 'model/Database.php';
require_once 'view/LoginView.php';
require_once 'view/RegisterView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'controller/MainController.php';
require_once 'controller/LoginController.php';
require_once 'controller/UserController.php';
require_once 'model/LoginState.php';
require_once 'model/User.php';

date_default_timezone_set('Europe/Stockholm');
session_start();

//CREATE OBJECTS OF THE MODELS
$db = new Database;
$loginState = new \model\LoginState();
$user = new \model\User($db);

//CREATE OBJECTS OF THE VIEWS
$loginView = new \view\LoginView($user);
$dateTimeView = new \view\DateTimeView();
$registerView = new \view\RegisterView();

$layoutView = new \view\LayoutView($dateTimeView, $loginView, $registerView);

// CREATE OBJECTS OF THE CONTROLLER
$loginController = new \controller\LoginController($loginState, $loginView);
$userController = new \controller\UserController($registerView, $loginView, $user);
$mainController = new \controller\MainController($layoutView, $userController, $loginView, $registerView);

$mainController->startApp();
