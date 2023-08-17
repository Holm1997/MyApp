
<ul class="nav nav-tabs mb-2 shadow bg-body-rounded">
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/ticket') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="ticket"><i class="bi bi-reception-4 me-2"></i>Текущие</a>
    <?php else :?>
      <a class="nav-link" href="ticket"><i class="bi bi-reception-4 me-2"></i>Текущие</a>
    <?php endif;?>
  </li>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/ticket/completed') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="ticket/completed"><i class="bi bi-check2-all me-2"></i>Выполненные</a>
    <?php else :?>
      <a class="nav-link" href="ticket/completed"><i class="bi bi-check2-all me-2"></i>Выполненные</a>
    <?php endif;?>
  </li>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/ticket/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="ticket/create"><i class="bi bi-send-plus-fill me-2"></i>Создать</a>
    <?php else :?>
      <a class="nav-link" href="ticket/create"><i class="bi bi-send-plus-fill me-2"></i>Создать</a>
    <?php endif;?>
  </li>
</ul>
<?php get_alerts();?>

