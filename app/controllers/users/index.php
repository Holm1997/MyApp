<?php

//$db = \myfrm\App::get('\myfrm\Db');



$users = db()->query("SELECT ur.id as urid, ur.role, u.login,  u.last_name, u.first_name, u.phone, u.id 
                    FROM user u 
                    INNER JOIN user_roles ur ON u.user_roles_id = ur.id")->findAll();

$title = 'Сотрудники';

require_once VIEWS . '/users/index.tpl.php';
