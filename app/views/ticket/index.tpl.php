<?php


require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/ticketsidebar.php';




?>
<?php if ($tickets) : ?>
<?php if ($_SESSION['user']['roleid'] == 1) : ?>
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата обращения</th>
            <th scope="col">Статус заявки</th>
            <th scope="col">Кабинет | Подразделение</th>
            <th scope="col">Оборудование</th>
            <th scope="col">Причина обращения</th>
            <th scope="col">Назначенные сотрудники</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($tickets as $ticket) : ?>
      <?php if ($ticket['ticket_status'] == "Выполнена успешно") : ?>
        <tr class="table-success">
      <?php elseif ($ticket['ticket_status'] == "Не выполнена") : ?>
        <tr class="table-danger">
      <?php elseif ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
      <?php elseif ($ticket['ticket_status'] == "Повторная заявка") : ?>
        <tr class="table-danger">
      <?php else : ?>
        <tr>
      <?php endif;?>

            <th scope="row">
            <?php if ($ticket['ticket_status'] == 'В работе') : ?>
  
                <div class="spinner-border spinner-border-sm text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>

            <?php elseif (($ticket['ticket_status'] == 'Новая заявка') or ($ticket['ticket_status'] == 'Повторная заявка')) : ?>
              <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            <?php endif; ?>
              <?= $ticket['id'] ?>
 
            </th>
            <td><?= $ticket['creation_date'] ?></td>

      <?php if ($ticket['ticket_status'] == 'В работе') : ?>
            <td><font color="orange"><?= $ticket['ticket_status'] ?></font></td>
      <?php else :?>
            <td><?= $ticket['ticket_status'] ?></td>
      <?php endif;?>
      
            <td><?= $ticket['name'].' | '.departament($ticket['pid'])?></td>
            <td><?= $ticket['catname'] ?></td>
            <td><?= $ticket['subject'] ?></td>
            <td>
              <?php foreach ($users as $user) : ?>
                <?php if ($user['ticket_id'] == $ticket['id']) :?>
                <?= $user['last_name'] .' ' .$user['first_name'] . '</br>'?>
                <?php endif;?>
              <?php endforeach; ?>
            </td>
            <td><a href="/ticket/show?id=<?= $ticket['id']?>" >Detail</a></td>
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php else : ?>

  <table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата обращения</th>
            <th scope="col">Статус заявки</th>
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
      <?php if ($ticket['ticket_status'] == "Выполнена успешно") : ?>
        <tr class="table-success">
      <?php elseif ($ticket['ticket_status'] == "Не выполнена") : ?>
        <tr class="table-danger">
      <?php elseif ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
      <?php elseif ($ticket['ticket_status'] == "Повторная заявка") : ?>
        <tr class="table-danger">
      <?php else : ?>
        <tr>
      <?php endif;?>

            <th scope="row">
            <?php if ($ticket['ticket_status'] == 'В работе') : ?>
  
              <div class="spinner-border spinner-border-sm text-warning" role="status">
                  <span class="visually-hidden">Loading...</span>
              </div>

            <?php elseif (($ticket['ticket_status'] == 'Новая заявка') or ($ticket['ticket_status'] == 'Повторная заявка')) : ?>
              <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                  <span class="visually-hidden">Loading...</span>
              </div>
            <?php endif; ?>
            <?= $ticket['id'] ?>
            </th>
            <td><?= $ticket['creation_date'] ?></td>

      <?php if ($ticket['ticket_status'] == 'В работе') : ?>
            <td><font color="orange"><?= $ticket['ticket_status'] ?></font></td>
      <?php else :?>
            <td><?= $ticket['ticket_status'] ?></td>
      <?php endif;?>

          <td><?= $ticket['name'].' | '.departament($ticket['pid'])?></td>
          <td><?= $ticket['catname'] ?></td>
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
    

            <td><a href="/ticket/show?id=<?= $ticket['id']?>" >Detail</a></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
<?php endif; ?>
<?php else : ?>
<h1>Нет активных заявок</h1>
<?php endif; ?>

<?php

require_once VIEWS . '/includes/footer.php';