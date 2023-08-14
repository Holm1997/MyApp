
<ul class="nav nav-tabs border-black">
  <li class="nav-item border-bottom-0">
    <?php if ($_SERVER['REQUEST_URI'] == '/ticket') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="ticket">Текущие</a>
    <?php else :?>
      <a class="nav-link" href="ticket">Текущие</a>
    <?php endif;?>
  </li>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/ticket/completed') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="ticket/completed">Выполненные</a>
    <?php else :?>
      <a class="nav-link" href="ticket/completed">Выполненные</a>
    <?php endif;?>
  </li>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/ticket/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="ticket/create">Создать</a>
    <?php else :?>
      <a class="nav-link" href="ticket/create">Создать</a>
    <?php endif;?>
  </li>
</ul>
<?php get_alerts();?>

