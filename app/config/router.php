<?php

$router = $di->getRouter();

$router->add('/confirm/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'confirmEmail'
]);
$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action' => 'resetPassword'
]);

// Define your routes here

$router->handle();
