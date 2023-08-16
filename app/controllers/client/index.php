<?php



$clients = db()->query("SELECT c.id, c.name, c.phone,p.id as pid, p.name as pname, p.phone as placephone
                        FROM client c 
                        inner join place p on c.place_id = p.id")->findAll();


$title = 'Клиенты';


require_once VIEWS . '/client/index.tpl.php';