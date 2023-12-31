<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/ticketsidebar.php';
?>



<form action="tickets/create" method="post">


<fieldset class="row mb-3">
    <legend class="col-form-label col-sm-3 pt-0"><h5>Выберите категорию оборудования</h5></legend>
    <div class="col-sm-5">
    <?php foreach ($cats as $cat) : ?>
      <div class="form-check">
        <input name="category_id" class="form-check-input border-primary" type="radio"  id="category" value="<?= $cat['id'] ?>">
        <label class="form-check-label" for="category">
          <?= $cat['name'] ?>
        </label>
      </div>
      <?php endforeach; ?>
    </div>
</fieldset>
<?= isset($validation) ? $validation->listErrors('category_id') : '' ?>

<div class="row mb-3">
    <label for="subject" class="col-sm-3 col-form-label"><h5>Причина обращения</h5></label>
    <div class="col-sm-5">
      <input name="subject" type="text" class="form-control border border-primary" id="subject" placeholder="Введите...">
    </div>
    <?= isset($validation) ? $validation->listErrors('subject') : '' ?>
</div>

<div class="row mb-3">
<label for="exampleDataList" class="col-sm-3 col-form-label"><h5>Кабинет/помещение</h5></label>
<div class="col-sm-5">
<input name="place" type="text" class="form-control border border-primary" list="datalistOptions" id="exampleDataList" placeholder="Введите кабинет...">
<datalist id="datalistOptions">
    <?php foreach ($rooms as $room) : ?>
        <option value="<?= $room['name']?>"><?= $room['phone']?>
    <?php endforeach;?>
</datalist>
<?= isset($validation) ? $validation->listErrors('place') : '' ?>
</div>
<div class="col-sm-2">
  <a class="btn btn-outline-primary" href="clients/places/create-place" role="button">Добавить кабинет</a>
</div>
</div>






<?php if ($_SESSION['user']['roleid'] == 1) : ?>

<fieldset class="row mb-3">
<legend class="col-form-label col-sm-3 pt-0"><h5>Назначить сотрудника/сотрудников</h5></legend>
<div class="col-sm-5">
      <?php foreach ($users as $user) : ?>
      <div class="form-check">
        <input class="form-check-input border border-primary" type="checkbox" name="user_id[<?= $user['id'] ?>]" id="user" value="<?= $user['id'] ?>">
        <label class="form-check-label" for="user">
        <?= $user['lname'] .' '. $user['fname'] ?>
        </label>
      </div>
      <?php endforeach; ?>
    </div>
</fieldset>
<?php else : ?>
  <input name="user_id" type="hidden" value="<?= $user ?>">
<?php endif; ?>


<div class="row mb-3 text-center">
<div class="col-12">
<button type="submit" class="btn btn-primary">Создать заявку</button>
</div>
</div>





</form>


<?php
require VIEWS . '/includes/footer.php';