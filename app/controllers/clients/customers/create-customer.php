<?php


$rooms = db()->query("SELECT `id`, `name`, `phone` FROM place")->findAll();

$title = 'Добавить заявителя';

require_once VIEWS . '/clients/customers/create-customer.tpl.php';