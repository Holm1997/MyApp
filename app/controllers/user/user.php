<?php

if ($_SESSION['user']['roleid'] == 1) {

        $id = $_GET['id'] ?? 0;

} else {
        $id = $_SESSION['user']['id'];
        
}

$user = db()->query("SELECT u.last_name, u.first_name, u.phone, ur.role 
                    FROM user u INNER JOIN user_roles ur ON u.user_roles_id = ur.id WHERE u.id = '$id'")->find();

$all = db()->query("SELECT count(*) nums FROM ticket_user WHERE user_id = '$id'")->find();

$completed = db()->query("SELECT count(*) nums 
                        FROM ticket_user tu 
                        INNER JOIN ticket t ON tu.ticket_id = t.id 
                        WHERE tu.user_id = '$id' and t.ticket_status = 'Выполнена успешно'")->find();

$notcompleted = db()->query("SELECT count(*) nums 
                        FROM ticket_user tu 
                        INNER JOIN ticket t ON tu.ticket_id = t.id 
                        WHERE tu.user_id = '$id' and t.ticket_status = 'Не выполнена'")->find();

$injob = db()->query("SELECT count(*) nums 
                        FROM ticket_user tu 
                        INNER JOIN ticket t ON tu.ticket_id = t.id 
                        WHERE tu.user_id = '$id' and t.ticket_status = 'В работе'")->find();



if (!$user) {
    abort();
}




$title = "Сотрудник {$user['last_name']}";

require_once VIEWS . '/user/user.tpl.php';