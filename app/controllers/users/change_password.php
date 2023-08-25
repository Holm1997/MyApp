<?php

$id = $_SESSION['user']['id'];

$fillable = ['oldpassword', 'password1', 'password2'];

$data = load($fillable);

$password = db()->query("SELECT `password` FROM user WHERE id ='$id'")->find();





if (password_verify($data['oldpassword'], $password['password'])) {
    if (($data['password1'] == $data['password2']) and $data['password1'] != '') {

        $pass = $data['password1'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);
      
        if (db()->query("UPDATE user SET password = '$pass' WHERE id = '$id'")) {

            redirect("/logout");
        } else {

            $_SESSION['error'] = 'ОШИБКА записи в базу данных. Попробуйте еще раз';
	    redirect('/');
        }

    } else {
        $_SESSION['error'] = 'ОШИБКА новые пароли не совпадают или пустые поля';
	redirect($_SERVER['/']);
    }
} else {
    $_SESSION['error'] = 'ОШИБКА пустое поле или неверный старый пароль';
    redirect('/');
}
