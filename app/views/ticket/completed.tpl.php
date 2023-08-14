<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/ticketsidebar.php';
?>

<?php if ($c_tickets) : ?>
<?php if ($_SESSION['user']['roleid'] == 1) : ?>

  <table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата завершения</th>
            <th scope="col">Статус заявки</th>
            <th scope="col">Кабинет | Подразделение</th>
            <th scope="col">Оборудование</th>
            <th scope="col">Причина обращения</th>
            <th scope="col">Назначенные сотрудники</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($c_tickets as $ticket) : ?>
      <?php if ($ticket['ticket_status'] == "Выполнена успешно") : ?>
        <tr class="table-success">
      <?php elseif ($ticket['ticket_status'] == "Не выполнена") : ?>
        <tr class="table-danger">
      <?php elseif ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
      <?php else : ?>
        <tr>
      <?php endif;?>
            <th scope="row"><?= $ticket['id'] ?></th>
            <td><?= $ticket['closing_date'] ?></td>
            <td><?= $ticket['ticket_status'] ?></td>
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
            <th scope="col">Дата завершения</th>
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
    <?php foreach ($c_tickets as $ticket) : ?>
      <?php if ($ticket['ticket_status'] == "Выполнена успешно") : ?>
        <tr class="table-success">
      <?php elseif ($ticket['ticket_status'] == "Не выполнена") : ?>
        <tr class="table-danger">
      <?php elseif ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
      <?php else : ?>
        <tr>
      <?php endif;?>
            <th scope="row"><?= $ticket['id'] ?></th>
            <td><?= $ticket['closing_date'] ?></td>
            <td><?= $ticket['ticket_status'] ?></td>
            <td><?= $ticket['name'].' | '.departament($ticket['pid'])?></td>
            <td><?= $ticket['catname'] ?></td>
            <td><?= $ticket['subject'] ?></td>
      <?php foreach ($clients as $client) :?>
        <?php if ($client['id'] == $ticket['client_id']) :?>
            <td><?= $client['name'] ?></td>
        <?php endif;?>
      <?php endforeach;?>
            
    <?php if ($ticket['phone']) :?>
            <td><?= $ticket['phone'] ?></td>
    <?php else :?>
            <td><?= $ticket['dphone'] ?></td>
    <?php endif; ?>
            <td><a href="/ticket/show?id=<?= $ticket['id']?>" >Detail</a></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
<?php endif; ?>
<?php else : ?>
    <h1>Нет выполненных заявок</h1>
<?php endif; ?>
<?php
require VIEWS . '/includes/footer.php';