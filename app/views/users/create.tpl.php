<?php



require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/usersidebar.php';
?>



<form action="/users/create" method="post">

<div class="row mb-3">
    <label for="login" class="col-sm-3 col-form-label"><h5>Логин</h5></label>
    <div class="col-sm-3">
      <input name="login" type="text" class="form-control border border-primary" id="login" placeholder="Задайте логин для входа в систему" value="<?= old('login') ?>">
    </div>
    <?= isset($validation) ? $validation->listErrors('login') : '' ?>
</div>



<div class="row mb-3">
    <label for="password" class="col-sm-3 col-form-label"><h5>Пароль</h5></label>
    <div class="col-sm-2">
      <input name="password" type="password" class="form-control border border-primary" id="password" placeholder="Придумайте пароль" value="<?= old('password') ?>">
    </div>
    <?= isset($validation) ? $validation->listErrors('login') : '' ?>
</div>



<div class="row mb-3">
    <label for="last_name" class="col-sm-3 col-form-label"><h5>Фамилия сотрудника</h5></label>
    <div class="col-sm-3">
      <input name="last_name" type="text" class="form-control border border-primary" id="last_name" placeholder="Введите фамилию..." value="<?= old('last_name') ?>">
    </div>
    <?= isset($validation) ? $validation->listErrors('last_name') : '' ?>
</div>



<div class="row mb-3">
    <label for="first_name" class="col-sm-3 col-form-label"><h5>Имя сотрудника</h5></label>
    <div class="col-sm-3">
      <input name="first_name" type="text" class="form-control border border-primary" id="first_name" placeholder="Введите имя..." value="<?= old('first_name') ?>">
    </div>
    <?= isset($validation) ? $validation->listErrors('first_name') : '' ?>
</div>



<div class="row mb-3">
    <label for="phone" class="col-sm-3 col-form-label"><h5>Телефон</h5></label>
    <div class="col-sm-2">
      <input name="phone" type="text" class="form-control border border-primary" id="phone" placeholder="8(9XX)XXX-XX-XX" value="<?= old('phone') ?>">
    </div>
    <?= isset($validation) ? $validation->listErrors('phone') : '' ?>
</div>





<div class="mb-3 text-center">
<button ttype="submit" class="btn btn-primary">Добавить сотрудника</button>

</div>


</form>

<?php
require_once VIEWS . '/includes/footer.php';