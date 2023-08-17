
<ul class="nav nav-tabs mb-2 shadow bg-body-rounded">
  <li class="nav-item border-bottom-0">
  <?php if ($_SERVER['REQUEST_URI'] == '/client') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client"><i class="bi bi-people-fill me-2"></i>Все заявители</a>
    <?php else :?>
      <a class="nav-link text-primary" href="client"><i class="bi bi-people-fill me-2"></i>Все заявители</a>
    <?php endif;?>
  </li>

  <li class="nav-item">
  <?php if ($_SERVER['REQUEST_URI'] == '/client/departament') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client/departament"><i class="bi bi-diagram-2-fill me-2"></i>Подразделения</a>
    <?php else :?>
      <a class="nav-link" href="client/departament"><i class="bi bi-diagram-2-fill me-2"></i>Подразделения</a>
    <?php endif;?>
  </li>

  <li class="nav-item">
  <?php if ($_SERVER['REQUEST_URI'] == '/client/place') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client/departament"><i class="bi bi-houses-fill me-2"></i>Кабинеты/помещения</a>
    <?php else :?>
      <a class="nav-link" href="client/place"><i class="bi bi-houses-fill me-2"></i>Кабинеты/помещения</a>
    <?php endif;?>
  </li>


<?php if ($_SESSION['user']['roleid'] == 1) : ?>

  <?php if ($_SERVER['REQUEST_URI'] == '/client/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="client/create"><i class="bi bi-pencil-square me-2"></i>Добавить</a>
    <?php else :?>
      <a class="nav-link" href="client/create"><i class="bi bi-pencil-square me-2"></i>Добавить</a>
    <?php endif;?>
  </li>
<?php endif; ?>
</ul>
<?= get_alerts(); ?>