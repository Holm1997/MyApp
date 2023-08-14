<?php


const MIDDLEWARE = [

    'auth' => \myfrm\middleware\Auth::class,

];






//Main

$router->get('', 'main/index.php')->only('auth');



//login
$router->get('login', 'auth/register.php');
$router->post('login', 'auth/login.php');
$router->get('logout', 'auth/logout.php')->only('auth');

// User
$router->get('user', 'user/index.php')->only('auth');
$router->get('user/show', 'user/user.php')->only('auth');
$router->get('user/create', 'user/create.php')->only('auth');
$router->post('user/create', 'user/store.php')->only('auth');
$router->delete('user', 'user/destroy.php')->only('auth');
$router->post('user/change-password', 'user/change_password.php')->only('auth');

//ticket
$router->get('ticket', 'ticket/index.php')->only('auth');
$router->get('ticket/completed', 'ticket/completed.php')->only('auth');
$router->get('ticket/create', 'ticket/create.php')->only('auth');
$router->post('ticket/create', 'ticket/store.php')->only('auth');
$router->get('ticket/show', 'ticket/show.php')->only('auth');
$router->post('ticket/show', 'ticket/show.php')->only('auth');
$router->delete('ticket', 'ticket/destroy.php')->only('auth');


//client
$router->get('client', 'client/index.php')->only('auth');
$router->get('client/show', 'client/info-client.php')->only('auth');
$router->delete('client', 'client/destroy-client.php')->only('auth');
$router->get('client/departament', 'client/departament.php')->only('auth');
$router->delete('client/departament', 'client/destroy-dep.php')->only('auth');
$router->get('client/departament/show', 'client/info-dep.php')->only('auth');
$router->post('client/departament/show', 'client/info-dep.php')->only('auth');
$router->get('client/create', 'client/create.php')->only('auth');
$router->get('client/create-client', 'client/create-client.php')->only('auth');
$router->post('client/create-client', 'client/store-client.php')->only('auth');
$router->get('client/place', 'client/place.php')->only('auth');
$router->get('client/place/show', 'client/info-place.php')->only('auth');
$router->delete('client/place', 'client/destroy-place.php')->only('auth');
$router->get('client/create-dep', 'client/create-dep.php')->only('auth');
$router->post('client/create-dep', 'client/store-dep.php')->only('auth');
$router->get('client/create-place', 'client/create-place.php')->only('auth');
$router->post('client/create-place', 'client/store-place.php')->only('auth');

//$router->delete();


