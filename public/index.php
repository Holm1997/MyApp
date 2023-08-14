<?php
session_start();



use myfrm\Router;



require_once __DIR__ . '/../vendor/autoload.php';
require dirname(__DIR__) . '/config/config.php';
require_once __DIR__ . '/bootstrap.php';
require CORE . '/func.php';




$router = new Router();
require CONFIG . '/routes.php';
$router->match();












