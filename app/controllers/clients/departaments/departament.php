<?php

$deps = db()->query("SELECT * from departament")->findAll();


$title = 'Подразделения';


require_once VIEWS . '/clients/departaments/departament.tpl.php';