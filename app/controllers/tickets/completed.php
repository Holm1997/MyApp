<?php



use myfrm\Pagination;

$page = $_GET['page'] ?? 1;
$sort = $_GET['sort'];

$sort_list = array(
    'date_asc'   => 't.closing_date',
    'date_desc'  => 't.closing_date DESC',
    'place_asc'  => 'p.name',
    'place_desc' => 'p.name DESC',
    'category_asc'   => 'cat.name',
    'category_desc'  => 'cat.name DESC',
);

if (array_key_exists($sort, $sort_list)) {
	$sort_sql = $sort_list[$sort];
} else {
	$sort_sql = 't.closing_date DESC';
}
$per_page = 10;



if ($_SESSION['user']['roleid'] == 1) {

    $total = db()->query("SELECT COUNT(*) FROM ticket
                    WHERE ticket_status = 'Выполнена успешно' 
                    or ticket_status = 'Не выполнена'")->getColumn();


    $pagination = new Pagination((int)$page, $per_page, $total);


    $start = $pagination->getStart();



    $c_tickets = get_tickets(true , $sort_sql, $start, $per_page);


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

    $c_tickets = get_tickets(true , $sort_sql, $start, $per_page, 2, $user_id);


}








$title = 'Выполненные заявки';

require_once VIEWS . '/tickets/completed.tpl.php';