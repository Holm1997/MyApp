<?php


$container = new \myfrm\ServiceContainer();
$container->setService('\myfrm\Db', function () {
    $db_config = require CONFIG . '/db.php';
    return (\myfrm\Db::getInstance())->getConnection($db_config);
});


\myfrm\App::setContainer($container);