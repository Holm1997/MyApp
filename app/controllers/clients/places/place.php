<?php


$places = db()->query("SELECT id, name, phone
                    FROM place
                    ORDER BY name DESC")->findAll();

$count_clients = db()->query("SELECT p.id, count(c.place_id) nums FROM place p
                            INNER JOIN client c ON c.place_id = p.id
                            GROUP BY p.id")->findAll();



$departaments = db()->query("SELECT d.id, d.name, dp.place_id
                            FROM departament d 
                            INNER JOIN departament_place dp ON dp.departament_id = d.id")->findAll();





$title = "Кабинеты/помещения";
require_once  VIEWS . "/clients/places/place.tpl.php";