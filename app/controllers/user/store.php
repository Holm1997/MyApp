<?php


use myfrm\Validator;


//$db = \myfrm\App::get('\myfrm\Db');


    //dd($_POST);


    $fillable = ['login', 'password', 'last_name', 'first_name', 'phone'];

    $data = load($fillable);

    // Validator

    $validator = new Validator();

    $validation = $validator->validate($data, [
        'login' => [
            'required' => true,
            'min' => 8,
            'max' => 20,    
        ],

        'password' => [
            'required' => true,
            'min' => 8,
            'max' => 20,
        ],

        'first_name' => [
            'required' => true,
            'min' => 3,
            'max' => 30,
        ],

        'last_name' => [
            'required' => true,
            'min' => 2,
            'max' => 30,
        ],

        'phone' => [
            'required' => true,
            'min' => 10,
            'max' => 20,
        ],
    ]);

    
    if (!$validation->hasErrors()) {

        if (db()->query("insert into user (`user_roles_id`,`login`, `password`, `last_name`, `first_name`, `phone`) 
        values (2, :login, :password, :last_name, :first_name, :phone)", $data)) {

            $_SESSION['success'] = 'OK';

        } else {

            $_SESSION['error'] = 'DB Error';

        }

        redirect('/user/create');
    } else {
        require VIEWS . '/user/create.tpl.php';
    }


