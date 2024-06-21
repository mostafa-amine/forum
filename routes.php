<?php

use Core\Router;
use Http\Controllers\AuthenticationController;
use Http\Controllers\HomeController;
use Http\Controllers\QuestionController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/questions', [QuestionController::class, 'index']);
Router::get('/questions/create', [QuestionController::class, 'create']);
Router::post('/', [QuestionController::class, 'store']);
Router::get('/question', [QuestionController::class, 'show']);

Router::get('/login', [AuthenticationController::class, 'loginForm']);
Router::post('/login', [AuthenticationController::class, 'login']);


Router::dispatch();
