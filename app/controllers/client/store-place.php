<?php


if ($_POST['name'] and $_POST['phone']) {


        $fillable = ['name', 'phone'];

        $data = load($fillable);


        if (db()->query("INSERT INTO place (`name`,`phone`) VALUES (:name, :phone)", $data)) {
                $_SESSION['success'] = 'Кабинет добавлен успешно';
                redirect('/client/place');
        } else {
                $_SESSION['error'] = 'ОШИБКА запсии в базу данных. Попробуйте еще раз.';
                redirect('/client/create-place');
        }
} else {
        $_SESSION['error'] = 'ОШИБКА есть пустые поля. Необходимо заполнить';
        redirect('/client/create-place');

}