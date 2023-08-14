<?php

require_once VIEWS . '/includes/header.php';
?>




<h1><?= 'Привет, '.$_SESSION['user']['fname'].'!' ?></h1>
<h4>Добро пожаловать в систему учета заявок участка ВТ ДИЭ МГУ. Скоро здесь появится краткая инструкция по использованию данного приложения, но пока ее нет советую разобраться самому.</h4>

<label for="exampleDataList" class="form-label">Datalist example</label>
<input class="form-control border border-primary" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
<datalist class="border border-primary" id="datalistOptions">
    <?php foreach ($places as $place) : ?>
        <option value="<?= $place['name'] ?>">
    <?php endforeach;?>
</datalist>

<?php
require_once VIEWS . '/includes/footer.php';