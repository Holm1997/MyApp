<?php


const MIDDLEWARE = [

    'auth' => \myfrm\middleware\Auth::class,

];






//Main

$router->get('', 'main/index.php')->only('auth');
$router->post('','main/index.php')->only('auth');


//login
$router->get('login', 'auth/register.php');
$router->post('login', 'auth/login.php');
$router->get('logout', 'auth/logout.php')->only('auth');

// User
$router->get('users', 'users/index.php')->only('auth');
$router->get('users/show', 'users/user.php')->only('auth');
$router->get('users/create', 'users/create.php')->only('auth');
$router->post('users/create', 'users/store.php')->only('auth');
$router->delete('users', 'users/destroy.php')->only('auth');
$router->post('users/change-password', 'users/change_password.php')->only('auth');

//ticket
$router->get('tickets', 'tickets/index.php')->only('auth');
$router->get('tickets/completed', 'tickets/completed.php')->only('auth');
$router->get('tickets/create', 'tickets/create.php')->only('auth');
$router->post('tickets/create', 'tickets/store.php')->only('auth');
$router->get('tickets/show', 'tickets/show.php')->only('auth');
$router->post('tickets/show', 'tickets/show.php')->only('auth');
$router->delete('tickets', 'tickets/destroy.php')->only('auth');


//client
$router->get('clients/customers', 'clients/customers/index.php')->only('auth');
$router->get('clients/customers/show', 'clients/customers/info-customer.php')->only('auth');
$router->delete('clients/customers', 'clients/customers/destroy-customer.php')->only('auth');
$router->get('clients/departaments', 'clients/departaments/departament.php')->only('auth');
$router->delete('clients/departaments', 'clients/departaments/destroy-dep.php')->only('auth');
$router->get('clients/departaments/show', 'clients/departaments/info-dep.php')->only('auth');
$router->post('clients/departaments/show', 'clients/departaments/info-dep.php')->only('auth');
$router->get('clients/create', 'clients/create.php')->only('auth');
$router->get('clients/customers/create-customer', 'clients/customers/create-customer.php')->only('auth');
$router->post('clients/customers/create-customer', 'clients/customers/store-customer.php')->only('auth');
$router->get('clients/places', 'clients/places/place.php')->only('auth');
$router->get('clients/places/show', 'clients/places/info-place.php')->only('auth');
$router->delete('clients/places', 'clients/places/destroy-place.php')->only('auth');
$router->get('clients/departaments/create-dep', 'clients/departaments/create-dep.php')->only('auth');
$router->post('clients/departaments/create-dep', 'clients/departaments/store-dep.php')->only('auth');
$router->get('clients/places/create-place', 'clients/places/create-place.php')->only('auth');
$router->post('clients/places/create-place', 'clients/places/store-place.php')->only('auth');

//$router->delete();


