<?php



$api_data = json_decode(file_get_contents('php://input'), 1);

$data = $api_data ?? $_POST;
$id = $data['id'] ?? 0;

db()->query("DELETE FROM user WHERE id = ?", [$id]);

redirect('/users');