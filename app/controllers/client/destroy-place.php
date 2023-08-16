<?php

$api_data = json_decode(file_get_contents('php://input'), 1);

$data = $api_data ?? $_POST;
$id = (int)$data['id'] ?? 0;

if (db()->query("DELETE FROM ticket WHERE place_id = ?", [$id])) {

if (db()->query("DELETE FROM place WHERE id = ?", [$id])){
    $_SESSION['success'] = "Кабинет удален";
    redirect('/client/place');
} else {
    $_SESSION['error'] = "ОШИБКА при удалении записи из базы данных. Попробуйте еще раз.";
    redirect("/client/place/show?id=$id");
}
} else {
    $_SESSION['error'] = "ОШИБКА при удалении ззаявки из базы данных. Попробуйте еще раз.";
    redirect("/client/place/show?id=$id");
}