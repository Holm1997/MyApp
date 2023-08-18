<?php



use myfrm\Pagination;

$page = $_GET['page'] ?? 1;
$per_page = 10;



if ($_SESSION['user']['roleid'] == 1) {
    $total = db()->query("SELECT COUNT(*) FROM ticket
                    WHERE ticket_status = 'Выполнена успешно' 
                    or ticket_status = 'Не выполнена'")->getColumn();


    $pagination = new Pagination((int)$page, $per_page, $total);


    $start = $pagination->getStart();

    $c_tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.closing_date,t.previous, p.name, p.phone, p.id as pid, cat.name as catname, count(ticket_id) users 
    FROM ticket t inner join ticket_user tu ON tu.ticket_id = t.id
    inner join place p on t.place_id = p.id
    inner join category cat on t.category_id = cat.id               
    WHERE t.ticket_status = 'Выполнена успешно' or t.ticket_status = 'Не выполнена'
    GROUP BY t.id
    ORDER by t.id DESC LIMIT $start, $per_page")->findAll();

    $users= db()->query("select tu.ticket_id, u.last_name, u.first_name FROM ticket_user tu INNER JOIN user u ON tu.user_id = u.id")->findAll();

} else {

    $user_id = $_SESSION['user']['id'];

    $total = db()->query("SELECT COUNT(*) FROM ticket t
                    INNER JOIN ticket_user tu ON tu.ticket_id = t.id
                    INNER JOIN user u ON tu.user_id = u.id
                    WHERE (ticket_status = 'Выполнена успешно' 
                    or ticket_status = 'Не выполнена') and u.id = $user_id")->getColumn();


    $pagination = new Pagination((int)$page, $per_page, $total);


    $start = $pagination->getStart();

    $c_tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.closing_date, t.previous, t.client_id, p.name, p.phone, p.id as pid, cat.name as catname, count(ticket_id) users
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