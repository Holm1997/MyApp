<?php

$deps=db()->query("SELECT * from departament")->findAll();

$rooms = db()->query("SELECT d.id, count(*) nums FROM departament d INNER JOIN departament_place dp ON dp.departament_id = d.id GROUP BY d.id")->findAll();


$title = 'Подразделения';


require_once VIEWS . '/client/departament.tpl.php';