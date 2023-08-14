<?php



if ($_SESSION['user']['roleid'] == 1) {

    $c_tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.closing_date, p.name, p.phone, p.id as pid, cat.name as catname, count(ticket_id) users 
    FROM ticket t inner join ticket_user tu ON tu.ticket_id = t.id
    inner join place p on t.place_id = p.id
    inner join category cat on t.category_id = cat.id               
    WHERE t.ticket_status = 'Выполнена успешно' or t.ticket_status = 'Не выполнена'
    group by t.id
    ORDER by t.id desc")->findAll();

    $users= db()->query("select tu.ticket_id, u.last_name, u.first_name FROM ticket_user tu INNER JOIN user u ON tu.user_id = u.id")->findAll();

} else {

    $user_id = $_SESSION['user']['id'];

    $c_tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.closing_date, t.client_id, p.name, p.phone, p.id as pid, cat.name as catname, count(ticket_id) users
    FROM ticket t inner join ticket_user tu ON tu.ticket_id = t.id
    inner join place p on t.place_id = p.id
    inner join category cat on t.category_id = cat.id
    WHERE (t.ticket_status = 'Не выполнена' or t.ticket_status = 'Выполнена успешно') and tu.user_id = '$user_id'
    GROUP BY t.id
    ORDER by t.id desc")->findAll();


}

$clients = db()->query("SELECT `id`, `name` FROM client")->findAll();






$title = 'Выполненные заявки';

require_once VIEWS . '/ticket/completed.tpl.php';