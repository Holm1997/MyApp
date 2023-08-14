<?php

$fillable = ['name', 'place_id'];

$data = load($fillable);




if (db()->query("insert into client (`name`, `place_id`) 
        values (:name, :place_id)", $data)) {
                redirect('/client');
        }else{
                echo "FAIL";
        }