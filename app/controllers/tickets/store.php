<?php

use myfrm\Validator;

if ($_POST['repeat']) {

    $fillable = ['place_id', 'subject', 'category_id','client_id','previous'];

    $data =load($fillable);
  

    $room = $data['place_id'];

    if (db()->query("INSERT INTO ticket (`subject`, `place_id`,`client_id`,`ticket_status`, `creation_date`, `category_id`, `previous`)
                values (:subject, :place_id, :client_id, 'Повторная заявка', now(), :category_id, :previous)", $data)) {

                $t_id = db()->query("SELECT id from ticket where place_id = '$room' order by id desc limit 1")->find();
                $t_id = $t_id['id'];
                

                $data1['ticket_id'] = $t_id;

                if ($_SESSION['user']['roleid'] == 1){

                    foreach ($_POST['user_id'] as $k => $v) {
    
                            $data1['user_id'] = trim($v);
    
                            if(db()->query("INSERT INTO ticket_user (`user_id`, `ticket_id`) 
                                    values (:user_id, :ticket_id)", $data1)) {
    
                                            echo "OK";
                                           
                                    } else {
                                        $_SESSION['error'] = "ОШИБКА записи в базу данных. Попробуйте снова.";
                                        db()->query("DELETE FROM ticket WHERE id = '$t_id'");
                                        redirect("/tickets/create");
                                    }
                    }
                        $_SESSION['success'] = "Заявка №$t_id успешно создана.";
                } else {
                        $data1['user_id'] = $_POST['user_id'];
                        

                        if (db()->query("INSERT INTO ticket_user (`user_id`, `ticket_id`)
                        values (:user_id, :ticket_id)", $data1)) {

                            $_SESSION['success'] = "Заявка №$t_id успешно создана.";
                            
        
                        } else {
                            $_SESSION['error'] = "ОШИБКА записи в базу данных. Попробуйте снова.";
                            db()->query("DELETE FROM ticket WHERE id = '$t_id'");
                            redirect("/ticket/create");
                        }
                }
                redirect('/tickets');
                
}




} else {

if (empty($_POST['subject']) or empty($_POST['category_id']) or empty($_POST['user_id']) or empty($_POST['place'])) {
        $_SESSION['error'] = "ОШИБКА какое-то поле или какие-то пустые";
        redirect("/tickets/create");
}

$room_name = $_POST['place'];
        
$room = db()->query("SELECT id FROM place where name = '$room_name'")->find();



$fillable = ['subject'];


$data = load($fillable);



$data['category_id'] = (int)$_POST['category_id'];

$room_name = $_POST['place'];

$room = db()->query("SELECT id FROM place where name = '$room_name'")->find();

$room = $room['id'];

$data['place_id'] = $room;




if (db()->query("INSERT INTO ticket (`subject`, `place_id`,`ticket_status`, `creation_date`, `category_id`)
                values (:subject, :place_id, 'Новая заявка', now(), :category_id)", $data)) {
                    
                    $t_id = db()->query("SELECT id from ticket where place_id = '$room' order by id desc limit 1")->find();
                    $t_id = $t_id['id'];
                    
                        
                    $data1['ticket_id'] = $t_id;

                    if ($_SESSION['user']['roleid'] == 1){

                            foreach ($_POST['user_id'] as $k => $v) {
        
                                $data1['user_id'] = trim($v);
        
                                if(db()->query("INSERT INTO ticket_user (`user_id`, `ticket_id`) 
                                        values (:user_id, :ticket_id)", $data1)) {
        
                                                echo "OK";
                                               
                                        } else {
                                                $_SESSION['error'] = "ОШИБКА записи в базу данных. Попрубйте снова";

                                                db()->query("DELETE FROM ticket WHERE id = '$t_id'");

                                                redirect('tickets/create');
                                        }
                            }
                            $_SESSION['success'] = "Заявка №$t_id успешно создана";
                            redirect('/tickets');
                    } else {
                            $data1['user_id'] = $_POST['user_id'];

                            if (db()->query("INSERT INTO ticket_user (`user_id`, `ticket_id`)
                            values (:user_id, :ticket_id)", $data1)) {

                                $_SESSION['succes'] = "Заявка №$t_id успешно создана";
                                
            
                            } else {
                                $_SESSION['error'] = "ОШИБКА записи в базу данных. Попрубйте снова";
                                
                                db()->query("DELETE FROM ticket WHERE id = '$t_id'");

                                redirect('tickets/create');
                            }
                    }

                    redirect('/tickets');
                    
} else {
        echo "FAIL";
}

}


