<?php

return [
    # ROTAS BASE
    'GET|/' => \Smart\Resale\Controller\HelloWorld::class,

    # LOGIN
    'GET|/login' => \Smart\Resale\Controller\User\LoginFormController::class,
    'POST|/login' => \Smart\Resale\Controller\User\LoginController::class,

    'GET|/signup' => \Smart\Resale\Controller\User\SignUpFormController::class,
    'POST|/signup' => \Smart\Resale\Controller\User\SignUpController::class,

    'GET|/logout' => \Smart\Resale\Controller\User\LogoutController::class,

    # CONFIG
    'GET|/config/user' => \Smart\Resale\Controller\User\UpdateUserFormController::class,
    'POST|/config/user' => \Smart\Resale\Controller\User\UpdateUserController::class,
    'POST|/config/remove-user' => \Smart\Resale\Controller\User\RemoveUserController::class,

    # BRAND
    'GET|/brands-list' => \Smart\Resale\Controller\Brand\BrandListController::class,
    'GET|/brands' => \Smart\Resale\Controller\Brand\BrandsController::class,
    'GET|/brand' => \Smart\Resale\Controller\Brand\BrandController::class,

    'POST|/add-brand' => \Smart\Resale\Controller\Brand\AddBrandController::class,

    'GET|/edit-brand' => \Smart\Resale\Controller\Brand\EditBrandModalController::class,
    'POST|/edit-brand' => \Smart\Resale\Controller\Brand\EditBrandController::class,

    'GET|/delete-brand' => \Smart\Resale\Controller\Brand\DeleteBrandModalController::class,
    'POST|/delete-brand' => \Smart\Resale\Controller\Brand\DeleteBrandController::class,
];
