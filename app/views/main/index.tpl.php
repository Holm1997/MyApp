<?php

require_once VIEWS . '/includes/header.php';
?>




<h1><?= 'Привет, '.$_SESSION['user']['fname'].'!' ?></h1>
<h4>Добро пожаловать в систему учета заявок участка ВТ ДИЭ МГУ. Скоро здесь появится краткая инструкция по использованию данного приложения, но пока ее нет советую разобраться самому.</h4>


<?php
require_once VIEWS . '/includes/footer.php';