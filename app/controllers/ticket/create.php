<?php


$rooms = db()->query("SELECT * FROM place")->findAll();





/* $clients = db()->query("SELECT c.id, c.name, c.phone, p.name as pname, d.name as dname, d.phone as dphone, d.description
                        FROM client c
                        INNER JOIN place p
                        ON c.place_id = p.id
                        INNER JOIN departament d
                        ON p.departament_id = d.id")->findAll();*/

if ($_SESSION['user']['roleid'] == 1){
$users = db()->query("SELECT u.id, u.first_name as fname, u.last_name as lname, u.phone as uphone 
                    FROM user u
                    INNER JOIN user_roles ur
                    ON u.user_roles_id = ur.id
                    WHERE ur.id = 2")->findAll();
} else {
    $user = $_SESSION['user']['id'];
}

$categories = db()->query("SELECT * from category")->findAll();



$title = 'Создать заявку';

require_once VIEWS . '/ticket/create.tpl.php';