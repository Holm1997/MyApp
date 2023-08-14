<?php

$fillable = ['login', 'password'];

$data = load($fillable);

$user_data = db()->query("SELECT u.id, u.first_name, u.last_name, u.phone, ur.id as roleid, ur.role
 from user u inner join user_roles ur 
 on u.user_roles_id = ur.id where u.login = :login and u.password = :password", $data)->find();

if ($user_data) {
    $_SESSION['user']['id'] = $user_data['id'];
    $_SESSION['user']['roleid'] = $user_data['roleid'];
    $_SESSION['user']['role'] = $user_data['role'];
    $_SESSION['user']['fname'] = $user_data['first_name'];
    $_SESSION['user']['lname'] = $user_data['last_name'];

    redirect('/');
}else {
    redirect('/login');
}




