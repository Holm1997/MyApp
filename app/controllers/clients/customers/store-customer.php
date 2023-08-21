<?php


if ($_POST['place'] and $_POST['name']) {



$place_name = $_POST['place'];

$place = db()->query("SELECT id FROM place WHERE name = '$place_name'")->find();
$place = $place['id'];


$fillable = ['name'];

$data = load($fillable);
$data['place_id'] = $place;






if (db()->query("insert into client (`name`, `place_id`) 
        values (:name, :place_id)", $data)) {
                $_SESSION['success'] = 'Заявитель добавлен';
                redirect('/client');
        }else{
                $_SESSION['error'] = 'ОШИБКА записи в базу данных. Попробуйте еще раз.';
                redirect('/client/create-client');
        }
} elseif (!$_POST['name'] and !$_POST['place']) {
        $_SESSION['error'] = 'ОШИБКА: поля ФИО и КАБИНЕТ не могут быть пустыми';
        redirect('/client/create-client');
} elseif (!$_POST['place']) {
        $_SESSION['error'] = 'ОШИБКА: поле КАБИНЕТ не может быть пустым';
        redirect('/client/create-client');
} else {
        $_SESSION['error'] = 'ОШИБКА: поле ФИО не может быть пустым';
        redirect('/client/create-client');
} 