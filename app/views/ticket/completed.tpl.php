<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/ticketsidebar.php';
?>


<div class="table-responsive">
<?php if ($c_tickets) : ?>
<?php if ($_SESSION['user']['roleid'] == 1) : ?>

  <table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Время завершения</th>
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
          <th scope="row"><i class="bi bi-check-lg" style="color: green;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
        </th>     
      <?php else : ?>
        <tr class="table-danger">
          <th scope="row"><i class="bi bi-x-lg" style="color: red;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
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
            <td><a href="/ticket/show?id=<?= $ticket['id']?>" ><i class="bi bi-box-arrow-in-up-right"></i></a></td>
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php else : ?>

  <table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата завершения</th>
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
          <th scope="row"><i class="bi bi-check-lg" style="color: green;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>     
      <?php else : ?>
        <tr class="table-danger">
          <th scope="row"><i class="bi bi-x-lg" style="color: red;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php endif;?>
            <td><?= elapsed_time_for_info($ticket['id']) ?></td>
            <td><?= $ticket['name'].' | '.departament($ticket['pid'])?></td>
            <td><?= ticket_device($ticket['id']) ?></td>
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
            <td><a href="/ticket/show?id=<?= $ticket['id']?>" ><i class="bi bi-box-arrow-in-up-right"></i></a></td>
    </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
<?php endif; ?>
</div>
<?php else : ?>
    <h1>Нет выполненных заявок</h1>
<?php endif; ?>
<?php
require VIEWS . '/includes/footer.php';