<?php

// Config
// TODO: Remember to require database configs.

// Classes
require_once('./classes/Database.php');

// Controllers
require_once('./controllers/Controller.php');
require_once('./controllers/AuthController.php');
require_once('./controllers/FeatureController.php');
require_once('./controllers/resources/AccountController.php');
require_once('./controllers/resources/PictureController.php');
require_once('./controllers/resources/CommentController.php');
require_once('./controllers/resources/LikerController.php');

// Interfaces
require_once('./interfaces/IRepository.php');
require_once('./interfaces/IEmailService.php');
require_once('./interfaces/IAuthService.php');
require_once('./interfaces/IHttpResponseService.php');
require_once('./interfaces/IRegisterService.php');
require_once('./interfaces/IPictureService.php');
require_once('./interfaces/IDatabase.php');

// Repositories
require_once('./repositories/AccountRepository.php');
require_once('./repositories/PictureRepository.php');
require_once('./repositories/CommentRepository.php');

// Services
require_once('./services/AuthService.php');
require_once('./services/EmailService.php');
require_once('./services/HttpResponseService.php');
require_once('./services/RegisterService.php');
require_once('./services/PictureService.php');

// Router
require_once('./Router.php');

$router = new Router($_GET['url']);

?>