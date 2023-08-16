<?php

$deps = db()->query("SELECT * from departament")->findAll();


$title = 'Подразделения';


require_once VIEWS . '/client/departament.tpl.php';