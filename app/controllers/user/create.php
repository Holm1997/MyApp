<?php

if ($_SESSION['user']['roleid'] == 2) {

    redirect("/user");
}


$title = 'Добавить сотрудника';

require_once VIEWS . '/user/create.tpl.php';