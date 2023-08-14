<?php





$fillable = ['name', 'phone'];

$data = load($fillable);


if (db()->query("INSERT INTO place (`name`,`phone`) VALUES (:name, :phone)", $data)) {
        redirect('/client/create');
} else {
        echo "FAIL";
}