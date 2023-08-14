<?php

$id = $_GET['id'] ?? 0;

$place = db()->query("SELECT * FROM place WHERE id = '$id'")->find();

$clients = db()->query("SELECT * FROM client WHERE place_id = '$id'")->findAll();

if (!$place) {
    abort();
}




$title = "Помещение {$place['name']}";

require_once VIEWS . '/client/info-place.tpl.php';