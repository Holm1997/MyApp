<?php

use myfrm\Pagination;

$page = $_GET['page'] ?? 1;
$per_page = 10;



if ($_SESSION['user']['roleid'] == 1){

$total = db()->query("SELECT COUNT(*) FROM ticket
                    WHERE ticket_status = 'Новая заявка' 
                    or ticket_status = 'Повторная заявка' 
                    or ticket_status = 'В работе'")->getColumn();


$pagination = new Pagination((int)$page, $per_page, $total);


$start = $pagination->getStart();


/*$tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.creation_date, t.working_date, t.previous, p.name, p.phone, cat.name as catname,p.id as pid, count(ticket_id) users 
                        FROM ticket t inner join ticket_user tu ON tu.ticket_id = t.id
                        inner join place p on t.place_id = p.id
                        inner join category cat on t.category_id = cat.id               
                        WHERE t.ticket_status = 'Новая заявка' or t.ticket_status = 'В работе' or t.ticket_status='Повторная заявка'
                        group by t.id 
                        ORDER by t.ticket_status = 'Повторная заявка' DESC, t.ticket_status = 'Новая заявка' DESC, t.working_date DESC, t.creation_date DESC LIMIT $start, $per_page")->findAll();*/
$tickets = get_tickets(false , $sort_sql, $start, $per_page);

$users= db()->query("select tu.ticket_id, u.last_name, u.first_name FROM ticket_user tu INNER JOIN user u ON tu.user_id = u.id")->findAll();


} else {
    $user_id = $_SESSION['user']['id'];

    $total = db()->query("SELECT COUNT(*) FROM ticket t
                    INNER JOIN ticket_user tu ON tu.ticket_id = t.id
                    INNER JOIN user u ON tu.user_id = u.id
                    WHERE (ticket_status = 'Новая заявка' 
                    or ticket_status = 'Повторная заявка' 
                    or ticket_status = 'В работе') and u.id = $user_id")->getColumn();
    
$pagination = new Pagination((int)$page, $per_page, $total);


$start = $pagination->getStart();
    
$tickets = get_tickets(false, $sort_sql, $start, $per_page, 2, $user_id);
    /*$tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.creation_date, t.working_date,t.previous, p.name,p.id as pid, p.phone, t.client_id, cat.name as catname, count(ticket_id) users 
    FROM ticket t inner join ticket_user tu ON tu.ticket_id = t.id
    INNER JOIN place p ON t.place_id = p.id
    INNER JOIN category cat on t.category_id = cat.id            
    WHERE (t.ticket_status = 'Новая заявка' or t.ticket_status = 'В работе' or t.ticket_status='Повторная заявка') and tu.user_id = $user_id
    GROUP BY t.id
    ORDER by t.ticket_status = 'Повторная заявка' DESC, t.ticket_status = 'Новая заявка' DESC, t.working_date DESC, t.creation_date DESC LIMIT $start, $per_page")->findAll();*/

}





$departaments = db()->query("SELECT p.id as pid, d.id, d.name FROM departament d
                        INNER JOIN departament_place dp ON dp.departament_id = d.id
                        INNER JOIN place p ON dp.place_id = p.id")->findAll();







$title = 'Заявки';

require_once VIEWS . '/tickets/index.tpl.php';




