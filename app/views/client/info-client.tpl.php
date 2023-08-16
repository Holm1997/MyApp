<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';
?>


<div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded">
  <div class="card-header bg-white">
    <div class="row bg-white">
      <div class="col-3">
        
        <h1><?=$client['name']?></h1>
        <?php if ($client['phone']) : ?>
    <p><?='Телефон: ' . $client['phone']?></p>
<?php else : ?>
    <p>Телефон: --- </p>
<?php endif; ?>
        
      </div>
      <div class="col-4 text-center">
        <?php if ($departament['name']) : ?>
          <h3><?= $departament['name'] ?></h3>
        <?php else : ?>
          <h3>---</h3>
        <?php endif; ?>
      </div>
      <div class="col-4">
        <h3><?= $place['name'] ?></h3>
        <p><?='Телефон: ' . $place['phone']?></p>
    </div>
      <div class="col-1">
      
      <?php if($_SESSION['user']['roleid'] == 1) : ?>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">Удалить</button>
      <?php endif; ?>
      </div>
    </div>

  </div>
  <div class="card-body">
    <p class="card-text">Кабинеты и помещения подразделения:</p>
    




  </div>
</div>








<table class="table">

  <thead>
    <tr>
      <th scope="col">№ Заявки</th>
      <th scope="col">Статус заявки</th>
      <th scope="col">Причина обращения</th>
      <th scope="col">Наименование оборудования</th>
      <th scope="col">Краткое описание проблемы и выполненных работ</th>
      <th scope="col">Назначенные сотрудники</th>
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
  <?php else : ?>
    <tr>
  <?php endif;?>
      <th scope="row"><?= $ticket['id'] ?></th>
      <td><?= $ticket['ticket_status'] ?></td>
      <td><?= $ticket['subject'] ?></td>
      <td><?= $ticket['catname'] ?></td>
      <td><?= $ticket['description'] ?></td>
      <td>

<?php foreach ($users as $user) : ?>
  <?php if ($user['id'] == $ticket['id']) : ?>

      <?= $user['last_name'] . ' ' . $user['first_name'] ?></br>
  <?php endif; ?>
<?php endforeach; ?>

      </td>
      <td><a href="/ticket/show?id=<?= $ticket['id'] ?>">Detail</a></td>
    </tr>
<?php endforeach; ?>
  </tbody>

</table>




<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?='Заявитель ' . $client['name']?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Точно хотите удалить заявителя из базы данных?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>

    <form action="/client" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $client['id']?>">
        <button type="submit" class="btn btn-danger">Да</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once VIEWS . '/includes/footer.php';