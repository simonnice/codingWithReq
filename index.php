<?php

//INCLUDE THE FILES NEEDED...
require_once 'config/Config.php';
require_once 'model/Session.php';
require_once 'model/Database.php';
require_once 'model/Register.php';
require_once 'model/Login.php';
require_once 'model/Cookie.php';
require_once 'model/Post.php';
require_once 'view/LoginView.php';
require_once 'view/PostView.php';
require_once 'view/RegisterView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'view/UserFeedback.php';
require_once 'controller/MainController.php';
require_once 'controller/LoginController.php';
require_once 'controller/RegisterController.php';
require_once 'controller/PostController.php';

date_default_timezone_set('Europe/Stockholm');
error_reporting(E_ALL);
ini_set('display_errors', 1);

//CREATE OBJECTS OF THE MODELS
$mainController = new \controller\MainController();
$mainController->startApp();
