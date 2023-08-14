<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    dd($_POST);
}
$places = db()->query("SELECT * FROM place")->findAll();



$title = "Главная";

require_once VIEWS . '/main/index.tpl.php';