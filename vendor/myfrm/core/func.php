<?php




function dump($data)
{
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
}

function print_arr($data)
{
        echo '<pre>';
        print_r($data);
        echo '</pre>';
}


function dd($data)
{
        dump($data);
        die;

}

function abort($code = 404) 
{
        http_response_code($code);
        require VIEWS . "/errors/{$code}.php";
        die;
}

function load($fillable = [])
{
        $data = [];
        
        foreach ($_POST as $k => $v)
                if (in_array($k, $fillable)) {

                        $data[$k] = trim($v);
                }

        return $data;

}

function old($fieldname)
{
        return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
}

function h($str)
{
        return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($url = '')
{
        if ($url) {
                $redirect = $url;
        } else {
                $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        }

        header("Location: {$redirect}");
        die;
}

function get_alerts()
{
        if (!empty($_SESSION['success'])) {
                require_once VIEWS . '/includes/alert_success.php';
                unset($_SESSION['success']);
        }

        if (!empty($_SESSION['error'])) {
                require_once VIEWS . '/includes/alert_error.php';
                unset($_SESSION['error']);
        }
}


function db()
{
        return \myfrm\App::get('\myfrm\Db');
}


function check_auth()
{
        return isset($_SESSION['user']['id']);
}


function departament($place) {

        $dep = db()->query("SELECT d.name FROM departament d
                            INNER JOIN departament_place dp ON dp.departament_id = d.id
                            INNER JOIN place p ON dp.place_id = p.id
                            WHERE p.id = '$place'")->find();
        if ($dep['name']) {
            return $dep['name'];
        } else {
            return '-----';
        }
    
}

function clients_for_place($place) {
        $count_clients = db()->query("SELECT count(c.place_id) nums FROM place p
                            INNER JOIN client c ON c.place_id = p.id
                            WHERE p.id = '$place'
                            GROUP BY p.id")->find();
        if ($count_clients['nums']){
                return $count_clients['nums'];
        } else {
                return '0';
        }

}

function dep_for_place($place) {

        $departament = db()->query("SELECT d.name FROM departament d 
                            INNER JOIN departament_place dp ON dp.departament_id = d.id
                            WHERE dp.place_id = '$place'")->find();
        if ($departament['name']) {
                return $departament['name'];
        } else {
                return '-----';
        }
}

