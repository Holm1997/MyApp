<?php

$id = $_GET['id'] ?? 0;





if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['place_id']){

        $dep = $_POST['dep'];
        $pl = $_POST['place_id'];

        if (db()->query("INSERT INTO departament_place (`departament_id`, `place_id`)
                        values ('$dep', '$pl')")) {
                $_SESSION['success'] = 'Кабинет добавлен'; 
        }


    } else {
        $_SESSION['error'] = 'ОШИБКА вы не выбрали кабинет. Попробуйте еще раз';
    }
}




$dep = db()->query("SELECT * FROM departament WHERE id = '$id'")->find();

$places = db()->query("SELECT p.id, p.name, p.phone  FROM place p 
                    INNER JOIN departament_place dp ON dp.place_id = p.id 
                    WHERE dp.departament_id = '$id'")->findAll();

$alone_places = db()->query("SELECT p.id, p.name FROM place p 
                            WHERE p.id NOT IN 
                            (SELECT place_id FROM departament_place)")->findAll();




if (!$dep) {
    abort();
}




$title = "Подразделение {$dep['name']}";

require_once VIEWS . '/client/info-dep.tpl.php';