<?php



$id = $_GET['id'] ?? 0;

$client = db()->query("SELECT id, name, phone
                        FROM client  
                        WHERE id = '$id'")->find();

$place = db()->query("SELECT p.id, p.name, p.phone
                        FROM place p
                        INNER JOIN client c on c.place_id = p.id
                        WHERE c.id = '$id'")->find();


$placeid =$place['id'];


$departament = db()->query("SELECT d.name 
                        FROM departament d 
                        INNER JOIN departament_place dp ON dp.departament_id = d.id
                        INNER JOIN place p ON dp.place_id = p.id
                        WHERE p.id = '$placeid'")->find();

$tickets = db()->query("SELECT t.id, t.subject, t.description, t.ticket_status, t.creation_date, t.working_date, client_id, category_id, cat.name as catname
                        from ticket t
                        INNER JOIN client c ON t.client_id = c.id
                        INNER JOIN category cat ON t.category_id = cat.id
                        WHERE c.id = '$id'")->findAll();

$devices = db()->query("SELECT d.id, d.name, d.inventory_number
                        FROM device d
                        INNER JOIN category cat ON d.category_id = cat.id
                        INNER JOIN client_device cd ON cd.device_id = d.id
                        INNER JOIN client c ON cd.client_id = c.id
                        WHERE c.id = '$id'")->findAll();

$users = db()->query("SELECT t.id, u.last_name, u.first_name
                    FROM user u
                    INNER JOIN ticket_user tu ON tu.user_id = u.id
                    INNER JOIN ticket t ON tu.ticket_id = t.id")->findAll();



if (!$client) {
    abort();
}




$title = "Заявитель {$client['name']}";

require_once VIEWS . '/clients/customers/info-customer.tpl.php';