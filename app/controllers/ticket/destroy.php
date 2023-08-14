<?php

$api_data = json_decode(file_get_contents('php://input'), 1);

$data = $api_data ?? $_POST;

$id = $data['id'] ?? 0;



if (db()->query("DELETE FROM ticket WHERE id = ?", [$id])){

    $_SESSION['success'] = "Заявка №$id успешно удалена.";

} else {

    $_SESSION['error'] = "ОШИБКА при удалении заявки №$id. Попробуйте еще раз.";
    redirect("/ticket/show?id=$id");

}
redirect('/ticket');