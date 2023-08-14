<?php



require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/usersidebar.php';
?>



<form action="/user/create" method="post">


<div class="mb-3">
  <label for="login" class="form-label">Логин</label>
  <input name="login" type="text" class="form-control border-primary-subtle" id="login" placeholder="Задайте логин для входа в систему" value="<?= old('login') ?>">
  
  <?= isset($validation) ? $validation->listErrors('login') : '' ?>
  
</div>



<div class="row g-3 align-items-center">
  <div class="col-auto">
    <label for="password" class="col-form-label">Пароль</label>
  </div>
  <div class="col-auto">
    <input name="password" type="password" id="password" class="form-control border-primary-subtle" aria-labelledby="passwordHelpInline" value="<?= old('password') ?>">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
  </div>
</div>

<?= isset($validation) ? $validation->listErrors('password') : '' ?>



<div class="mb-3">
  <label for="first_name" class="form-label">Имя сотрудника</label>
  <input name="first_name" type="text" class="form-control border-primary-subtle" id="first_name" placeholder="Введите имя" value="<?= old('first_name') ?>">
  
  <?= isset($validation) ? $validation->listErrors('first_name') : '' ?>

</div>

<div class="mb-3">
  <label for="last_name" class="form-label">Фамилия сотрудника</label>
  <input name="last_name" type="text" class="form-control border-primary-subtle" id="last_name" placeholder="Введите фамилию" value="<?= old('last_name') ?>">
  
  <?= isset($validation) ? $validation->listErrors('last_name') : '' ?>

</div>

<div class="mb-3">
  <label for="phone" class="form-label">Телефон</label>
  <input name="phone" type="text" class="form-control border-primary-subtle" id="phone" placeholder="Прим. 8(9XX)XXX-XX-XX" value="<?= old('phone') ?>">
  
  <?= isset($validation) ? $validation->listErrors('phone') : '' ?>

</div>

<div class="mb-3">
<button ttype="submit" class="btn btn-primary">Добавить сотрудника</button>

</div>


</form>

<?php
require_once VIEWS . '/includes/footer.php';