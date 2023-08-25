<?php

$fillable1 = ['login'];
$fillable2 = ['password'];
$data1 = load($fillable1);
$data2 = load($fillable2);

$user_data = db()->query("SELECT u.id,u.login, u.password, u.first_name, u.last_name, u.phone, ur.id as roleid, ur.role
 from user u inner join user_roles ur 
 on u.user_roles_id = ur.id where u.login = :login", $data1)->find();

if ($user_data and $data2) {

    if (password_verify($data2['password'], $user_data['password'])) {

        $_SESSION['user']['id'] = $user_data['id'];
        $_SESSION['user']['roleid'] = $user_data['roleid'];
        $_SESSION['user']['role'] = $user_data['role'];
        $_SESSION['user']['fname'] = $user_data['first_name'];
        $_SESSION['user']['lname'] = $user_data['last_name'];
	$_SESSION['user']['login'] = $user_data['login'];

        redirect('/');
    } else {
	$_SESSION['error'] = 'Неверный логин или пароль';
	redirect('/login');
    }

} else {
    $_SESSION['error'] = 'Неверный логин или пароль';
    redirect('/login');
}




