<?php



use myfrm\Validator;



$fillable = ['name'];

$data = load($fillable);



$validator = new Validator();

$validation = $validator->validate($data, [
        'name' => [
            'required' => true,
            'min' => 2,
            'max' => 20,    
        ],
]);




if (!$validation->hasErrors()) {

if (db()->query("insert into departament (`name`) 
                values (:name)", $data)) {

                    $_SESSION['success'] = 'OK';
                
                } else {

                    $_SESSION['error'] = 'DB Error';

                }

                redirect('/client/create-dep');

} else {
    require VIEWS . '/client/create-dep.tpl.php';
}