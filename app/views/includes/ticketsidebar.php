
<ul class="nav nav-tabs mb-2 shadow bg-body-rounded">
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/tickets' or explode('?', $_SERVER['REQUEST_URI'])[0] == '/tickets') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="tickets"><i class="bi bi-reception-4 me-2"></i>Текущие</a>
    <?php else :?>
      <a class="nav-link" href="tickets"><i class="bi bi-reception-4 me-2"></i>Текущие</a>
    <?php endif;?>
  </li>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/tickets/completed' or explode('?', $_SERVER['REQUEST_URI'])[0] == '/tickets/completed') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="tickets/completed"><i class="bi bi-check2-all me-2"></i>Выполненные</a>
    <?php else :?>
      <a class="nav-link" href="tickets/completed"><i class="bi bi-check2-all me-2"></i>Выполненные</a>
    <?php endif;?>
  </li>
  <li class="nav-item">
    <?php if ($_SERVER['REQUEST_URI'] == '/tickets/create') :?>
      <a class="nav-link active bg-secondary text-white" aria-current="page" href="tickets/create"><i class="bi bi-send-plus-fill me-2"></i>Создать</a>
    <?php else :?>
      <a class="nav-link" href="tickets/create"><i class="bi bi-send-plus-fill me-2"></i>Создать</a>
    <?php endif;?>
  </li>
</ul>
<?php get_alerts();?>

