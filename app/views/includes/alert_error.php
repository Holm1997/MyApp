<?php if ($_SERVER['REQUEST_URI'] != '/login') : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?= isset($_SESSION['error']) ? $_SESSION['error'] : ''?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php else : ?>
<div class="d-flex flex-row align-items-center form-floating mb-5">
    <input name="login" type="login" class="form-control is-invalid" id="floatingInput" placeholder="">
    <label for="floatingInput">Логин</label>
</div>

<div class="d-flex flex-row align-items-center form-floating mb-5">
    <input name="password" type="password" class="form-control is-invalid" id="floatingInput" placeholder="">
    <label for="floatingInput">Пароль</label>
</div>
<?php endif;?>