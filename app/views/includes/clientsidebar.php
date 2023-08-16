
<ul class="nav nav-tabs border-black">
  <li class="nav-item border-bottom-0">
  <?php if ($_SERVER['REQUEST_URI'] == '/client') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client">Все заявители</a>
    <?php else :?>
      <a class="nav-link text-primary" href="client">Все заявители</a>
    <?php endif;?>
  </li>

  <li class="nav-item">
  <?php if ($_SERVER['REQUEST_URI'] == '/client/departament') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client/departament">Подразделения</a>
    <?php else :?>
      <a class="nav-link" href="client/departament">Подразделения</a>
    <?php endif;?>
  </li>

  <li class="nav-item">
  <?php if ($_SERVER['REQUEST_URI'] == '/client/place') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client/departament">Кабинеты/помещения</a>
    <?php else :?>
      <a class="nav-link" href="client/place">Кабинеты/помещения</a>
    <?php endif;?>
  </li>


<?php if ($_SESSION['user']['roleid'] == 1) : ?>

  <?php if ($_SERVER['REQUEST_URI'] == '/client/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client/create">Добавить</a>
    <?php else :?>
      <a class="nav-link" href="client/create">Добавить</a>
    <?php endif;?>
  </li>
<?php endif; ?>
</ul>
<?= get_alerts(); ?>