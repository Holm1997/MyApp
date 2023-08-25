<?php

if ($_SESSION['user']['roleid'] == 2) {

    redirect("/users");
}

if ($_SESSION['user']['id'] == 1) {

	$roles = db()->query("SELECT * FROM user_roles")->findAll();

}

$title = 'Добавить сотрудника';

require_once VIEWS . '/users/create.tpl.php';
