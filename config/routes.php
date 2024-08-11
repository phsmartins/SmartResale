<?php

return [
    # ROTAS BASE
    'GET|/' => \Smart\Resale\Controller\HelloWorld::class,

    # LOGIN
    'GET|/login' => \Smart\Resale\Controller\User\LoginFormController::class,
];
