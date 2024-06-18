<?php

use Core\Router;
use Http\Controllers\HomeController;
use Http\Controllers\QuestionController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/questions', [QuestionController::class, 'index']);
Router::get('/questions/create', [QuestionController::class, 'create']);
Router::post('/', [QuestionController::class, 'store']);
Router::get('/questions/{id}', [QuestionController::class, 'view']);


Router::dispatch();
