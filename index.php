<?php

//INCLUDE THE FILES NEEDED...
require_once 'config/Config.php';
require_once 'helper/UrlRedirect.php';
require_once 'model/Session.php';
require_once 'model/Database.php';
require_once 'view/LoginView.php';
require_once 'view/RegisterView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'controller/MainController.php';
require_once 'controller/UserController.php';
require_once 'model/User.php';

date_default_timezone_set('Europe/Stockholm');
error_reporting(E_ALL);
ini_set('display_errors', 1);

//CREATE OBJECTS OF THE MODELS
$session = new \model\Session();
$db = new Database;
$user = new \model\User($db, $session);

//CREATE OBJECTS OF THE VIEWS
$loginView = new \view\LoginView($user);
$dateTimeView = new \view\DateTimeView();
$registerView = new \view\RegisterView();

$layoutView = new \view\LayoutView($dateTimeView, $loginView, $registerView);

// CREATE OBJECTS OF THE CONTROLLER
$userController = new \controller\UserController($registerView, $loginView, $user, $session);
$mainController = new \controller\MainController($layoutView, $userController, $loginView, $registerView);

$mainController->startApp();
