<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.5">
    <meta name="referrer">
    <base href="<?= PATH ?>/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href='assets/main.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title><?= "СУЗ :: " . $title ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary text-white" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="">СУЗ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?php if (explode("/", $_SERVER['REQUEST_URI'])[1] == 'tickets' or explode("?", $_SERVER['REQUEST_URI'])[0] == '/tickets') : ?>
            <a class="nav-link active position-relative" aria-current="page" href="/tickets">Заявки
            <?php if (numbers_of_new_tickets($_SESSION['user']['id']) != 0) :?>
              <span class="position-absolute top-25 start-75 translate-middle badge rounded-pill bg-danger">
                <?= numbers_of_new_tickets($_SESSION['user']['id']) ?>
              <span class="visually-hidden">unread messages</span>
              </span>
            <?php endif; ?>
            </a>
          <?php else : ?>
            <a class="nav-link" href="/tickets">Заявки
            <?php if (numbers_of_new_tickets($_SESSION['user']['id']) != 0) :?>
              <span class="position-absolute top-25 start-75 translate-middle badge rounded-pill bg-danger">
                <?= numbers_of_new_tickets($_SESSION['user']['id']) ?>
              <span class="visually-hidden">unread messages</span>
              </span>
            <?php endif; ?>
            </a>
          <?php endif; ?>
        </li>




        
        <li class="nav-item">
        <?php if (explode("/", $_SERVER['REQUEST_URI'])[1] == 'clients') :?>
          <a class="nav-link active" aria-current="page" href="/clients/customers">Клиенты</a>
        <?php else : ?>
          <a class="nav-link" href="/clients/customers">Клиенты</a>
        <?php endif; ?>
        </li>

        <li class="nav-item">
        <?php if (explode("/", $_SERVER['REQUEST_URI'])[1] == 'users'):?>
          <a class="nav-link active" href="/users">Сотрудники</a>
        <?php else : ?>
          <a class="nav-link" href="/users">Сотрудники</a>
        <?php endif; ?>
        </li>
        
      </ul>
     
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (check_auth()):?>
        <li class="nav-item dropdown border-end border-white">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= $_SESSION['user']['login'] .' (' .$_SESSION['user']['lname'].' '. $_SESSION['user']['fname'].')'?>
          </a>
          <ul class="dropdown-menu">
	<?php if ($_SESSION['user']['id'] != 1) : ?>
            <li><a class="dropdown-item" href="/users/show?id=<?= $_SESSION['user']['id']?>">Статистика</a></li>
        <?php endif; ?>   
	    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Сменить пароль</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout">Выйти</a>
        </li>

       <?php endif; ?>
      </ul>
      </div>
    </div>
  </div>
</nav>

<!-- Modal CHANGE PASSWORD-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-bottom border-secondary">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Смена пароля</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/users/change-password" method="post">
      <div class="modal-body">
        <label for="inputOldPassword" class="form-label">Введите старый пароль</label>
        <input name="oldpassword" type="password" id="inputOldPassword" class="form-control mb-3 border-primary" aria-describedby="passwordHelpBlock">
        
        
        <label for="inputPassword1" class="form-label">Введите новый пароль</label>
        <input name="password1" type="password" id="inputPassword1" class="form-control mb-3 border-primary" aria-describedby="passwordHelpBlock">
        

        <label for="inputPassword2" class="form-label">Повторно введите новый пароль</label>
        <input name="password2" type="password" id="inputPassword2" class="form-control border-primary" aria-describedby="passwordHelpBlock">
        
      </div>
      <div class="modal-footer border-bottom border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-success">Изменить</button>
      </div>
        </form>
    </div>
  </div>
</div>



<div class="container">
