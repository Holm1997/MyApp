<?php




if ($_POST['phone']) {
    $phone = $_POST['phone'];
    $id = $_POST['id'];

    if (db()->query("UPDATE client SET phone = '$phone' WHERE id = $id")) {
        $_SESSION['success'] = 'Телефон добавлен';
        redirect("/clients/customers/show?id=$id>");
    } else {
        $_SESSION['error'] = 'ОШИБКА записи в базу данных. Попробуйте еще раз';
        redirect("/clients/customers/show?id=$id>");
    } 
} else {
    $_SESSION['error'] = 'ОШИБКА заполните поле';
    redirect("/clients/customers/show?id=$id>");
}