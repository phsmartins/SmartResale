<?php

return [
    # ROTAS BASE
    'GET|/' => \Smart\Resale\Controller\HelloWorld::class,

    # LOGIN
    'GET|/login' => \Smart\Resale\Controller\User\LoginFormController::class,
    'POST|/login' => \Smart\Resale\Controller\User\LoginController::class,

    'GET|/signup' => \Smart\Resale\Controller\User\SignUpFormController::class,
];
