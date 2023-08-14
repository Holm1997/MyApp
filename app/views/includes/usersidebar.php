
<ul class="nav nav-tabs border-black">
  <li class="nav-item border-bottom-0">
    <?php if ($_SERVER['REQUEST_URI'] == '/user') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="user">Все сотрудники</a>
    <?php else :?>
      <a class="nav-link" href="user">Все сотрудники</a>
    <?php endif;?>
  </li>
  <?php if ($_SESSION['user']['roleid'] == 1) :?>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/user/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="user/create">Добавить нового сотрудника</a>
    <?php else :?>
      <a class="nav-link" href="user/create">Добавить нового сотрудника</a>
    <?php endif;?>
  </li>
  <?php endif;?>
</ul>
<?php get_alerts(); ?>
