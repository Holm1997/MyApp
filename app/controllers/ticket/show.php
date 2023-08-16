<?php




$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Добавление заявителя в БД //
// Если пользователь выбран из списка //

    if ($_POST['cname'] and !$_POST['cname_write']){

        $pl =$_POST['place_id'];

        $cl = $_POST['cname'];


        

        if (db()->query("UPDATE ticket SET client_id = '$cl' WHERE id = '$id'")) {

        } else {
                echo "NO";
        }
        $_SESSION['success'] = 'Заявитель успешно добавлен.';


    } elseif ($_POST['cname_write'] and !$_POST['cname']) {

        $pl =$_POST['place_id'];

        $cname = $_POST['cname_write'];

        if (db()->query("INSERT INTO client (`name`, `place_id`) VALUES ('$cname', '$pl')")) {

            $cl = db()->query("SELECT c.id FROM client c INNER JOIN place p WHERE p.id = '$pl' order by c.id DESC LIMIT 1")->find();

            $cl = $cl['id'];

            if($cl) {

                db()->query("UPDATE ticket SET client_id = '$cl' WHERE id = '$id'");

            }
            

        }
        $_SESSION['success'] = 'Заявитель успешно добавлен.';
        redirect("/ticket/show?id=$id");
        

    } elseif ($_POST['cname'] and $_POST['cname_write']) {
        $_SESSION['error'] = 'ОШИБКА: При добавлении заявителя нужно выбрать один пункт.';
        redirect("/ticket/show?id=$id");
    } else {
        $_SESSION['error'] = 'ОШИБКА: оба пункта не могут быть пустыми при добавлении заявителя';
        redirect("/ticket/show?id=$id");
    }


    if ($_POST['departament'] and !$_POST['dname_write']) {

        $pl = $_POST['place_id'];
        $dep = $_POST['departament'];
        if (db()->query("INSERT INTO departament_place (`departament_id`,`place_id`) VALUES ('$dep','$pl')")) {
                $_SESSION['succes'] = 'УСПЕШНО: подразделение добавлено';
        }
        redirect("/ticket/show?id=$id");

    } elseif ($_POST['dname_write'] and !$_POST['departament']) {
        $pl = $_POST['place_id'];
        $dep = $_POST['dname_write'];
        if (db()->query("INSERT INTO departament (`name`) VALUES ('$dep')")) {

            $dep_id = db()->query("SELECT id from departament WHERE name = '$dep'")->find();
            $dep_id = $dep_id['id'];

            if (db()->query("INSERT INTO departament_place (`departament_id`,`place_id`) VALUES ('$dep_id','$pl')")) {
                $_SESSION['succes'] = 'УСПЕШНО: подразделение добавлено';
                redirect("/ticket/show?id=$id");
            } else {
                $_SESSION['error'] = 'ОШИБКА записи в базу данных. Попробуйте снова.';
                redirect("/ticket/show?id=$id");
            }
        } else {
           $_SESSION['error'] = 'ОШИБКА записи в базу данных. Попробуйте снова.';
           redirect("/ticket/show?id=$id");
        }
        
    } elseif ($_POST['dname_write'] and $_POST['departament']) {
        $_SESSION['error'] = 'ОШИБКА: выберите один пункт при добавлении подразделения';
        redirect("/ticket/show?id=$id");
    } else {
        $_SESSION['error'] = 'ОШИБКА: оба пункта не могут быть пустыми при добавлении подразделения';
        redirect("/ticket/show?id=$id");
    }


    
    if ($_POST['accept'] == "ok") {

        db()->query("UPDATE `ticket` SET `ticket_status` = 'В работе', `working_date` = now() WHERE id = '$id'");

    } elseif ($_POST['close']) {
        if (!$_POST['description']) {
            $_SESSION['error'] = "ОШИБКА: не добавлено КРАТКОЕ ОПИСАНИЕ";
            redirect("/ticket/show?id=$id");

        } else {

        $desc = $_POST['description'];
        $dev = $_POST['device'];
        $client = $_POST['cid'];
        $category = $_POST['catid'];

   
        


        db()->query("INSERT INTO device (`name`, `category_id`)
                    values ('$dev', '$category')");

        $device = db()->query("SELECT id FROM device WHERE category_id = '$category'
                            ORDER BY id DESC LIMIT 1")->find();

        $devid = $device['id'];
        



        db()->query("INSERT INTO client_device (`client_id`, `device_id`)
                    values ('$client', '$devid')");
                
                
        db()->query("INSERT INTO `ticket_device` (`ticket_id`, `device_id`)
                    values ('$id', '$devid')");
                
        $check_client = db()->query("SELECT client_id FROM ticket WHERE id = '$id'")->find();
       
        if ($check_client['client_id']) {
                    $place_id = $_POST['place_id'];

                    $check_departament = db()->query("SELECT dp.departament_id FROM departament_place dp 
                    INNER JOIN place p ON dp.place_id = p.id 
                    INNER JOIN ticket t On t.place_id = p.id 
                    WHERE t.place_id =  '$place_id'")->find();
                    if ($check_departament['departament_id']) {

                            if ($_POST['close'] == 'Выполнена успешно') {

                                    db()->query("UPDATE `ticket` SET `ticket_status` = 'Выполнена успешно', `closing_date` = now(), `description` = '$desc' WHERE id = '$id'");
                                    
                            } else {
    
                                    db()->query("UPDATE `ticket` SET `ticket_status` = 'Не выполнена', `closing_date` = now(), `description` = '$desc' WHERE id = '$id'");

                            }
                            $_SESSION['success'] = "УСПЕШНО закрыта";
                            redirect("/ticket/show?id=$id");

                    } else {
                        $_SESSION['error'] = "ОШИБКА: не добавлено ПОДРАЗДЕЛЕНИЕ";
                        redirect("/ticket/show?id=$id");
                    }
        } else {
            $_SESSION['error'] = "ОШИБКА: не добавлен ЗАЯВИТЕЛЬ";
            redirect("/ticket/show?id=$id");
        }
    }
    }
} 

$ticket = db()->query("SELECT t.id, t.subject, t.ticket_status, t.description,
t.closing_date, t.working_date, t.creation_date, t.client_id, t.previous, cat.id as catid,
cat.name as catname, p.id as pid, p.name, p.phone
FROM ticket t INNER JOIN category cat ON t.category_id = cat.id 
INNER JOIN place p ON t.place_id = p.id
WHERE t.id = '$id'")->find();
$ticketid = $ticket['id'];

$catid = strval($ticket['catid']);

$client_id = db()->query("SELECT c.id,c.name, c.phone FROM client c INNER JOIN ticket t ON t.client_id = c.id WHERE t.id = '$id'")->find();

$place = $ticket['pid'];

$client = db()->query("SELECT c.id, c.name, c.phone FROM client c
                    INNER JOIN place p ON c.place_id = p.id
                    WHERE c.place_id = '$place'")->findAll();

$departament = db()->query("SELECT d.id, d.name FROM departament d 
                    INNER JOIN departament_place dp ON dp.departament_id = d.id
                    INNER JOIN place p ON dp.place_id = p.id
                    WHERE p.id = '$place'")->find();

$departaments = db()->query("SELECT `id`, `name` FROM departament")->findAll();



$users = db()->query("SELECT u.id, u.last_name, u.first_name FROM user u INNER JOIN ticket_user tu ON u.id = tu.user_id WHERE tu.ticket_id = '$id'")->findAll();

$td = db()->query("SELECT device_id FROM ticket_device WHERE ticket_id = '$id'")->find();

$tickets = db()->query("SELECT t.id, t.subject, t.ticket_status, t.description,
t.closing_date, t.working_date, t.creation_date, t.client_id, t.place_id,
cat.name as catname, p.id as pid, p.name, p.phone
FROM ticket t INNER JOIN category cat ON t.category_id = cat.id 
INNER JOIN place p ON t.place_id = p.id
WHERE t.place_id = '$place' and t.id != '$id'")->findAll();

$ticket_user = db()->query("SELECT t.id as tid, u.id, u.last_name, u.first_name FROM user u
                            INNER JOIN ticket_user tu On tu.user_id = u.id
                            INNER JOIN ticket t ON tu.ticket_id = t.id")->findAll();

if ($_SESSION['user']['roleid'] == 1){
    $repeat_users = db()->query("SELECT u.id, u.first_name as fname, u.last_name as lname, u.phone as uphone 
                        FROM user u
                        INNER JOIN user_roles ur
                        ON u.user_roles_id = ur.id
                        WHERE ur.id = 2")->findAll();
}
    

if ($td) {

    $td = $td['device_id'];

    $device = db()->query("SELECT * FROM device WHERE id = '$td'")->find();

}

if (!$ticket) {
    abort();
}





$title = "Заявка № {$ticket['id']}";

require_once VIEWS . '/ticket/show.tpl.php';