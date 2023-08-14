<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>

<form action="client/create-client" method="post">

<div class="mb-3">
  <label for="name" class="form-label">ФИО заявителя</label>
  <input name="name"type="text" class="form-control" id="name" placeholder="Прим. Иванов И.И.">
</div>

<div class="mb-3">
  <label for="phone" class="form-label">Мобильный телефон (если есть)</label>
  <input name="phone"type="text" class="form-control" id="phone" placeholder="89XXXXXXXXX">
</div>


<label class="input-group-text" for="departament">Кабинет/помещение</label>
<select id="departament" class="form-select" size="3" name="place_id">
<?php foreach ($rooms as $room) : ?>
  <option value="<?= $room['id'] ?>"><?=$room['name'].'---------'.$room['phone'] ?></option>
<?php endforeach; ?>
</select>




<button type="submit" class="btn btn-primary">Добавить</button>

</from>
<?php
require VIEWS . '/includes/footer.php';