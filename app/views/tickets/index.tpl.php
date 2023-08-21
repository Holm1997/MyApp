<?php


require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/ticketsidebar.php';




?>


<div class="table-responsive">
<?php if ($tickets) : ?>
<?php if ($_SESSION['user']['roleid'] == 1) : ?>
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Время изменения</th>
            <th scope="col">Кабинет | Подразделение</th>
            <th scope="col">Оборудование</th>
            <th scope="col">Причина обращения</th>
            <th scope="col">Назначенные сотрудники</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($tickets as $ticket) : ?>
      <?php if ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning table-responsive">
          <th scope="row">
            <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
            </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php elseif ($ticket['ticket_status'] == "Повторная заявка") : ?>
        <tr class="table-danger">
          <th scope="row">
            <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
            </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
            </th>
      <?php else : ?>
        <tr>
          <th scope="row">
            <div class="spinner-border spinner-border-sm text-warning" role="status">
                  <span class="visually-hidden">Loading...</span>
            </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php endif;?>
            <td><?= elapsed_time_for_info($ticket['id']) ?></td>      
            <td><?= $ticket['name'].' | '.departament($ticket['pid'])?></td>
            <td><?= ticket_device($ticket['id']) ?></td>
            <td><?= $ticket['subject'] ?></td>
            <td>
              <?php foreach ($users as $user) : ?>
                <?php if ($user['ticket_id'] == $ticket['id']) :?>
                <?= $user['last_name'] .' ' .$user['first_name'] . '</br>'?>
                <?php endif;?>
              <?php endforeach; ?>
            </td>
            <td><a href="/tickets/show?id=<?= $ticket['id']?>" ><i class="bi bi-box-arrow-in-up-right"></i></a></td>
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php else : ?>

  <table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата обращения</th>
            <th scope="col">Кабинет | Подразделение</th>
            <th scope="col">Оборудование</th>
            <th scope="col">Причина обращения</th>
            <th scope="col">Заявитель</th>
            <th scope="col">Телефон</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($tickets as $ticket) : ?>
      <?php if ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
          <th scope="row">
            <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
            </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php elseif ($ticket['ticket_status'] == "Повторная заявка") : ?>
        <tr class="table-danger">
          <th scope="row">
            <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
            </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
            </th>
      <?php else : ?>
        <tr>
          <th scope="row">
            <div class="spinner-border spinner-border-sm text-warning" role="status">
                  <span class="visually-hidden">Loading...</span>
            </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php endif;?>

          <td><?= elapsed_time_for_info($ticket['id']) ?></td>  
          <td><?= $ticket['name'].' | '.departament($ticket['pid'])?></td>
          <td><?= ticket_device($ticket['id']) ?></td>
          <td><?= $ticket['subject'] ?></td>

      <?php if ($ticket['client_id']) :?>
        <?php foreach ($clients as $client) :?>
          <?php if ($client['id'] == $ticket['client_id']) :?>
            <td><?= $client['name'] ?></td>
          <?php endif;?>
        <?php endforeach;?>
      <?php else :?>
            <td>-----</td>
      <?php endif;?>

            <td><?= $ticket['phone'] ?></td>
    

            <td><a href="/tickets/show?id=<?= $ticket['id']?>" ><i class="bi bi-box-arrow-in-up-right"></i></a></td>
      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php endif; ?>
</div>
<?php else : ?>
<h1>Нет активных заявок</h1>
<?php endif; ?>

<div class="row">
  <div class="col align-items-center">
<?= $pagination ?>
</div>
</div>



<?php

require_once VIEWS . '/includes/footer.php';