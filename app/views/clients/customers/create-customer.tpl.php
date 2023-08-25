<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>

<form action="clients/customers/create-customer" method="post">

<div class="row mt-3 mb-3">
<label for="name" class="col-sm-3 col-form-label"><h5>ФИО заявителя</h5></label>
<div class="col-sm-5">
<input name="name" type="text" class="form-control border-primary" id="name" placeholder="Прим. Иванов И.И.">
</div>
</div>

<div class="row mb-3">
<label for="phone" class="col-sm-3 col-form-label"><h5>Телефон (необязательно)</h5></label>
<div class="col-sm-5">
<input name="phone" type="text" class="form-control border-primary" id="phone" placeholder="89XXXXXXXXX">
</div>
</div>

<div class="row mb-3">
<label for="exampleDataList" class="col-sm-3 col-form-label"><h5>Кабинет/помещение</h5></label>
<div class="col-sm-5">
<input name="place" type="text" class="form-control border-primary" list="datalistOptions" id="exampleDataList" placeholder="Введите кабинет...">
<datalist id="datalistOptions">
    <?php foreach ($rooms as $room) : ?>
        <option value="<?= $room['name']?>"><?= $room['phone']?>
    <?php endforeach;?>
</datalist>
</div>
</div>



<div class="row mb-3 text-center">
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Добавить</button>
  </div>
</div>

</form>
<?php
require VIEWS . '/includes/footer.php';
