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


function numbers_of_new_tickets($user_id) {
        $nums = db()->query("SELECT count(tu.ticket_id) nums FROM ticket_user tu
                        INNER JOIN ticket t ON tu.ticket_id = t.id
                        WHERE tu.user_id = '$user_id' and (t.ticket_status = 'Новая заявка' or t.ticket_status = 'Повторная заявка')
                        GROUP BY user_id")->find();
        if ($nums) {
                return $nums['nums'];
        } else {
                return 0;
        }
}

function numbers_of_rooms_in_departament($dep_id) {
        $nums = db()->query("SELECT d.id, count(*) nums FROM departament d 
                        INNER JOIN departament_place dp ON dp.departament_id = d.id 
                        WHERE d.id = '$dep_id'
                        GROUP BY d.id")->find();

        if ($nums) {
                return $nums['nums'];
        } else {
                return 0;
        }
}


function numbers_of_clients_in_departament($dep_id) {
        $nums = db()->query("SELECT d.id, count(c.place_id) nums FROM client c
                        INNER JOIN place p ON c.place_id = p.id
                        INNER JOIN departament_place dp ON dp.place_id = p.id
                        INNER JOIN departament d ON dp.departament_id = d.id
                        WHERE d.id = '$dep_id'
                        GROUP BY d.id")->find();
        if ($nums) {
                return $nums['nums'];
        } else {
                return 0;
        }
}

function place_departament($place_id) {
        $name = db()->query("SELECT d.name FROM departament d
                        INNER JOIN departament_place dp ON dp.departament_id = d.id
                        INNER JOIN place p ON dp.place_id = p.id
                        WHERE p.id = '$place_id'")->find();
        if ($name) {
                return $name['name'];
        } else {
                return '-----';
        }
}

function ticket_device($ticket_id) {
        $category = db()->query("SELECT cat.id, cat.name FROM category cat
                                INNER JOIN ticket t ON t.category_id = cat.id
                                WHERE t.id = '$ticket_id'")->find();

        $name = db()->query("SELECT d.name FROM device d
                        INNER JOIN ticket_device td ON td.device_id = d.id
                        INNER JOIN ticket t ON td.ticket_id = t.id
                        WHERE t.id = '$ticket_id'")->find();
        if ($name) {
                return $category['name'] . ' ' . $name['name'];
        } else {
                return $category['name'];
        }
}

function elapsed_time_for_info($ticket_id) {
        $ticket = db()->query("SELECT id, creation_date, working_date, closing_date FROM ticket
                WHERE id = '$ticket_id'")->find();
        if ($ticket['closing_date']) {
                $t_date = $ticket['closing_date'];
                
        } elseif ($ticket['working_date']) {
                $t_date = $ticket['working_date'];
        } else {
                $t_date = $ticket['creation_date'];
        } 

        $year = db()->query("SELECT TIMESTAMPDIFF(YEAR, '$t_date', now()) as clock")->find();

        $res = '';

        if ($year['clock'] == 0) {
                $month = db()->query("SELECT TIMESTAMPDIFF(MONTH, '$t_date', now()) as clock")->find();
                if ($month['clock'] == 0) {
                        $week = db()->query("SELECT TIMESTAMPDIFF(WEEK, '$t_date', now()) as clock")->find();
                        if ($week['clock'] == 0) {
                                $days = db()->query("SELECT TIMESTAMPDIFF(DAY, '$t_date', now()) as clock")->find();
                                if ($days['clock'] == 0) {
                                        $hours = db()->query("SELECT TIMESTAMPDIFF(HOUR, '$t_date', now()) as clock")->find();
                                        if ($hours['clock'] == 0) {
                                                $mins = db()->query("SELECT TIMESTAMPDIFF(MINUTE, '$t_date', now()) as clock")->find();
                                                if ($mins['clock'] == 0) {
                                                        $sec = db()->query("SELECT TIMESTAMPDIFF(SECOND, '$t_date', now()) as clock")->find();
                                                        if ($sec['clock'] < 60) {
                                                                $res .= $sec['clock'] . ' сек. назад';
                                                        }
                                                } elseif ($mins['clock'] < 60) {
                                                        $res .= $mins['clock'] . ' мин. назад';
                                                }
                                        } elseif ($hours['clock'] < 25 ) {
                                                $res .= $hours['clock'];
                                                if ($hours['clock'] == 1 or $hours['clock'] == 21) {
                                                        $res .= ' час назад';
                                                } elseif ($hours['clock'] == 2 or $hours['clock'] == 3 or $hours['clock'] == 4
                                                        or $hours['clock'] == 22 or $hours['clock'] == 23 or $hours['clock'] == 24) {
                                                        $res .= ' часа назад';
                                                } else  {
                                                        $res .= ' часов назад';
                                                }
                                        }
                                } elseif ($days['clock'] < 28) {
                                        $res .= $days['clock'];
                                        if ($days['clock'] == 1) {
                                                $res .= ' день назад';
                                        } elseif ($days['clock'] == 2 or $days['clock'] == 3 or $days['clock'] == 4) {
                                                $res .= ' дня назад';
                                        } else {
                                                $res .= ' дней назад';
                                        }
                                }
                        } elseif ($week['clock'] < 6) {
                                $res .= $week['clock'];
                                        if ($week['clock'] == 1) {
                                                $res .= ' неделю назад';
                                        } elseif ($week['clock'] == 2 or $week['clock'] == 3 or $week['clock'] == 4) {
                                                $res .= ' недели назад';
                                        } else {
                                                $res .= ' недель назад';
                                        }
                        }
                } elseif ($month['clock'] < 13) {
                        $res .= $month['clock'] . ' месяцев назад';
                }
        } else {
                $res .= $year['clock'];
                if ($year['clock'] == 1) {
                        $res .= ' год назад';
                } elseif ($year['clock'] == 2 or $year['clock'] == 3 or $year['clock'] == 4) {
                        $res .= ' года назад';
                } else {
                        $res .= ' лет назад';
                }
        }
        return $res;
        
}

function format_date_from_sql($date_and_time) {
        $res = '';
        $date_ticket = db()->query("SELECT DATE_FORMAT('$date_and_time', '%d %M %Y') as clock")->find();
        $time_ticket = db()->query("SELECT TIME_FORMAT('$date_and_time',  '%k:%i') as clock")->find();
        $res .= $date_ticket['clock'] . ' ' . $time_ticket['clock'];
        return $res;

}