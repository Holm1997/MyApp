<?php

$id = $_GET['id'] ?? 0;

$place = db()->query("SELECT * FROM place WHERE id = '$id'")->find();
$place_id = $place['id'];
$clients = db()->query("SELECT * FROM client WHERE place_id = '$id'")->findAll();
$dep = db()->query("SELECT d.name FROM departament d
                INNER JOIN departament_place dp ON dp.departament_id = d.id
                INNER JOIN place p ON dp.place_id = p.id
                WHERE p.id = '$id'")->find();

if (!$place) {
    abort();
}




$title = "Помещение {$place['name']}";

require_once VIEWS . '/client/info-place.tpl.php';