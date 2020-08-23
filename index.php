<?php

session_start();

// Controllers
require_once('./controllers/Controller.php');
require_once('./controllers/AuthController.php');
require_once('./controllers/FeatureController.php');
require_once('./controllers/resources/AccountController.php');
require_once('./controllers/resources/PictureController.php');
require_once('./controllers/resources/CommentController.php');
require_once('./controllers/resources/LikerController.php');

// Interfaces
require_once('./interfaces/IAccountRepository.php');
require_once('./interfaces/IPictureRepository.php');
require_once('./interfaces/ICommentRepository.php');
require_once('./interfaces/ILikerRepository.php');
require_once('./interfaces/IEmailService.php');
require_once('./interfaces/IAuthService.php');
require_once('./interfaces/IHttpResponseService.php');
require_once('./interfaces/IPictureService.php');
require_once('./interfaces/IDatabase.php');

// Repositories
require_once('./repositories/AccountRepository.php');
require_once('./repositories/PictureRepository.php');
require_once('./repositories/CommentRepository.php');
require_once('./repositories/LikerRepository.php');

// Services
require_once('./services/AuthService.php');
require_once('./services/EmailService.php');
require_once('./services/HttpResponseService.php');
require_once('./services/PictureService.php');

// Config
require_once('./config/logging.php');

// Classes
require_once('./classes/Database.php');
require_once('./classes/Validation.php');

// Router
require_once('./Router.php');

$router = new Router($_GET['url']);

?>
