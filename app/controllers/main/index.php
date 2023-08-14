<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['place'];
    $place = db()->query("SELECT id FROM place WHERE name = '$name'")->find();
    dd($place);
}
$places = db()->query("SELECT * FROM place")->findAll();



$title = "Главная";

require_once VIEWS . '/main/index.tpl.php';