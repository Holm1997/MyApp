<?php

if ($_SESSION['user']['roleid'] == 1) {

        $id = $_GET['id'] ?? 0;

} else {
        $id = $_SESSION['user']['id'];
        
}

$user = db()->query("SELECT u.id, u.last_name, u.first_name, u.login, u.phone, ur.role, ur.id as roleid 
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


$tickets = db()->query("SELECT t.id, t.subject,t.description, t.ticket_status, t.creation_date, t.working_date, t.closing_date, t.previous,
                        p.name, p.phone, cat.name as catname,p.id as pid, t.client_id, count(ticket_id) users 
                        FROM ticket t inner join ticket_user tu ON tu.ticket_id = t.id
                        inner join place p on t.place_id = p.id
                        inner join category cat on t.category_id = cat.id               
                        WHERE tu.user_id = $id
                        GROUP BY t.id 
                        ORDER BY t.ticket_status = 'Повторная заявка' DESC, t.ticket_status = 'Новая заявка' DESC,
                        t.working_date DESC, t.creation_date DESC")->findAll();


$clients = db()->query("SELECT t.client_id, c.name from client c
                        INNER JOIN ticket t ON t.client_id = c.id")->findAll();

$users= db()->query("select tu.ticket_id, u.last_name, u.first_name FROM ticket_user tu INNER JOIN user u ON tu.user_id = u.id")->findAll();



$title = "Сотрудник {$user['last_name']}";

require_once VIEWS . '/users/user.tpl.php';
