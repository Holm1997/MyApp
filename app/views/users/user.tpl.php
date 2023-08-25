<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/usersidebar.php';
?>



<div class="container text-left">
    <div class="row border-bottom border-white bg-black text-white">
        <div class="col">
        <h1><?=$user['last_name'] .' '. $user['first_name'] ?></h1>
	<?php if ($user['id'] != 1) :?>
        <p><?=$user['phone']?></p>
	<?php endif; ?>
        </div>
        <div class="col">
	<?php if ($_SESSION['user']['id'] == 1) : ?>

	<p>Логин:</p>
	<h4><?= $user['login']?></h4>
	<?php endif;?> 
            
        </div>
        <div class="col">
	<?php if ($user['id'] != 1) : ?>
            <h4><?= $user['role'] ?></h4>
	<?php endif; ?>
            <?php if(($_SESSION['user']['roleid'] == 1 and $_SESSION['user']['id'] == 1) and ($user['id'] != $_SESSION['user']['id'])) : ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <p>Удалить</p>
                </button>
	    <?php elseif (($_SESSION['user']['roleid'] == 1 and $user['roleid'] != 1)) : ?>
            
		<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-targer"#exampleModal">
		<p>Удалить</p>
		</button>
	    <?php endif; ?>
        
        </div>
    </div>
    <div class="row border-bottom shadow-lg bg-body-tertiary rounded">
        <div class="col border-end">
            <p>Всего заявок:</p>
            <h3><font color="blue"><?= $all['nums']?></font></h3>
      
        </div>
        <div class="col border-end">
            <p>В работе:</p>
            <h3><font color="orange"><?= $injob['nums']?></font></h3>
        </div>
        <div class="col border-end">
            <p>Выполненные:</p>
            <h3><font color="green"><?= $completed['nums']?></font></h3>
        </div>
        <div class="col">
            <p>Не выполненные:</p>
            <h3><font color="red"><?= $notcompleted['nums']?></font></h3>
        </div>
  </div>
</div>


<!-- TABLE TICKETS -->
<div class="table-responsive">


<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Время изменения</th>
            <th scope="col">Кабинет | Подразделение | Заявитель</th>
            <th scope="col">Оборудование</th>
            <th scope="col">Причина обращения</th>
            <th scope="col">проведенные работы</th>
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
      <?php elseif ($ticket['ticket_status'] == "В работе") :?>
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
      <?php elseif ($ticket['ticket_status'] == "Выполнена успешно") :?>
        <tr class="table-success">
          <th scope="row"><i class="bi bi-check-lg" style="color: green;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php else : ?>
        <tr class="table-danger">
          <th scope="row"><i class="bi bi-x-lg" style="color: red;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><a style="text-decoration: none;" href="/tickets/show?id=<?= $ticket['previous']?>"><?=' (' . $ticket['previous'] . ')'?></a>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>     
      <?php endif;?>
            <td><?= elapsed_time_for_info($ticket['id']) ?></td>      
            <td><?= $ticket['name'].' | '.departament($ticket['pid']) .' | ' . get_client_for_ticket($ticket['client_id'])?></td>
            <td><?= ticket_device($ticket['id']) ?></td>
            <td><?= $ticket['subject'] ?></td>
            <th><?= $ticket['description'] ?></th>
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
</div>



<!-- Modal DELETE-->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?='Сотрудник ' . $user['last_name'] . ' ' . $user['first_name'] ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Точно хотите удалить сотрудника из базы данных?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>

    <form action="/users" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $user['id']?>">
        <button type="submit" class="btn btn-danger">Да</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once VIEWS . '/includes/footer.php';
