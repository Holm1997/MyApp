
<ul class="nav nav-tabs mb-2 shadow bg-body-rounded">
  <li class="nav-item border-bottom-0">
    <?php if ($_SERVER['REQUEST_URI'] == '/user') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="user"><i class="bi bi-people-fill me-2"></i>Все сотрудники</a>
    <?php else :?>
      <a class="nav-link" href="user"><i class="bi bi-people-fill me-2"></i>Все сотрудники</a>
    <?php endif;?>
  </li>
  <?php if ($_SESSION['user']['roleid'] == 1) :?>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/user/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="user/create"><i class="bi bi-person-fill-add me-2"></i>Добавить нового сотрудника</a>
    <?php else :?>
      <a class="nav-link" href="user/create"><i class="bi bi-person-fill-add me-2"></i>Добавить нового сотрудника</a>
    <?php endif;?>
  </li>
  <?php endif;?>
</ul>
<?php get_alerts(); ?>
