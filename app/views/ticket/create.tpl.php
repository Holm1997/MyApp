<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/ticketsidebar.php';
?>



<form action="ticket/create" method="post">


<h4>Выберите категорию оборудования</h4>
<?php foreach ($categories as $category) : ?>
<div class="form-check">
  <input name="category_id" class="form-check-input" type="checkbox" value="<?= $category['id'] ?>" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
  <?= $category['name'] ?>
  </label>
</div>
<?php endforeach; ?>




<div class="mb-3">
  <label for="subject" class="form-label">Причина обращения</label>
  <input name="subject" type="text" class="form-control" id="subject" placeholder="Введите причину обращения">
</div>


<label class="input-group-text" for="client">Заявитель</label>
<select id="client" class="form-select" size="3" name="place_id">
<?php foreach ($rooms as $room) : ?>
  <option value="<?= $room['id'] ?>"><?= $room['name'] .' ---------- '. $room['phone']?></option>
<?php endforeach; ?>
</select>




<?php if ($_SESSION['user']['roleid'] == 1) : ?>
<h4>Назначить сотрудника/сотрудников</h4>
<?php foreach ($users as $user) : ?>
<div class="form-check">
  <input name="user_id[<?=$user['id'] ?>]" class="form-check-input" type="checkbox" value="<?= $user['id'] ?>" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
  <?= $user['lname'] .' '. $user['fname'] ?>
  </label>
</div>
<?php endforeach; ?>
<?php else : ?>
  <input name="user_id" type="hidden" value="<?= $user ?>">
<?php endif; ?>








<button type="submit" class="btn btn-primary">Создать заявку</button>






</form>


<?php
require VIEWS . '/includes/footer.php';