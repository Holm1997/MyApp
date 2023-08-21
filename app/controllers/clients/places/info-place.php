<?php

$id = $_GET['id'] ?? 0;

$place = db()->query("SELECT * FROM place WHERE id = '$id'")->find();
$place_id = $place['id'];
$clients = db()->query("SELECT * FROM client WHERE place_id = '$id'")->findAll();
$dep = db()->query("SELECT d.name FROM departament d
                INNER JOIN departament_place dp ON dp.departament_id = d.id
                INNER JOIN place p ON dp.place_id = p.id
                WHERE p.id = '$id'")->find();

$ticket_user = db()->query("SELECT t.id as tid, u.id, u.last_name, u.first_name FROM user u
                            INNER JOIN ticket_user tu On tu.user_id = u.id
                            INNER JOIN ticket t ON tu.ticket_id = t.id")->findAll();

$tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.previous, t.description,
                        t.closing_date, t.working_date, t.creation_date, t.client_id, t.place_id,
                        cat.name as catname, p.id as pid, p.name, p.phone
                        FROM ticket t INNER JOIN category cat ON t.category_id = cat.id 
                        INNER JOIN place p ON t.place_id = p.id
                        WHERE t.place_id = '$place_id'")->findAll();

if (!$place) {
    abort();
}




$title = "Помещение {$place['name']}";

require_once VIEWS . '/clients/places/info-place.tpl.php';