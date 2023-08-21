<?php

if ($_SESSION['user']['roleid'] == 2) {

    redirect("/users");
}


$title = 'Добавить сотрудника';

require_once VIEWS . '/users/create.tpl.php';