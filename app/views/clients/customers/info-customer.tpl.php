<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';
?>


<div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded">
  <div class="card-header bg-white">
    <div class="row bg-white">
    <?php if ($client['phone']) : ?>
      <div class="col-4">
        <h1><?=$client['name']?></h1>
        <p><?='Телефон: +7 ' . $client['phone']?></p>
    <?php else : ?>
      <div class="col-4">
        <h1><?=$client['name']?></h1>
        <button type="button" class="btn btn-outline-success m-0" data-bs-toggle="modal" data-bs-target="#add_phone"><i class="bi bi-telephone-plus-fill"></i></button>
    <?php endif; ?>
        
      </div>
      <div class="col-3 text-center">
        <?php if ($departament['name']) : ?>
          <h3><?= $departament['name'] ?></h3>
        <?php else : ?>
          <h3>---</h3>
        <?php endif; ?>
      </div>
      <div class="col-3">
        <h3><?= $place['name'] ?></h3>
        <p><?='Телефон: ' . $place['phone']?></p>
    </div>
      <div class="col-1">
      
      <?php if($_SESSION['user']['roleid'] == 1) : ?>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete"><i class="bi bi-trash3-fill"></i></button>
      <?php endif; ?>
      </div>
    </div>

  </div>
  <div class="card-body">
    <p class="card-text">Кабинеты и помещения подразделения:</p>
    




  </div>
</div>






<div class="table-responsive">

<table class="table">

  <thead>
    <tr>
      <th scope="col">№ Заявки</th>
      <th scope="col">Время изменения</th>
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
          <th scope="row"><i class="bi bi-check-lg me-2" style="color: green;"></i><?= $ticket['id'] ?></th>
      <?php elseif ($ticket['ticket_status'] == "Не выполнена") : ?>
        <tr class="table-danger">
          <th scope="row"><i class="bi bi-x-lg me-2" style="color: red;"></i></i><?= $ticket['id'] ?></th>
      <?php elseif ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
          <th scope="row">
          <div class="spinner-grow spinner-grow-sm text-primary me-1" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <?= $ticket['id'] ?>
          </th>
      <?php elseif ($ticket['ticket_status'] == "Повторная заявка") :?>
        <tr class="table-warning">
          <th scope="row">
          <div class="spinner-grow spinner-grow-sm text-primary me-1" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <?= $ticket['id'] ?>
          </th>
      <?php else : ?>
        <tr>
        <th scope="row">
          <div class="spinner-border spinner-border-sm text-warning me-1" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <?= $ticket['id'] ?>
          </th>
      <?php endif;?>

      <td><?= elapsed_time_for_info($ticket['id']) ?></td>
      <td><?= $ticket['subject'] ?></td>
      <td><?= ticket_device($ticket['id']) ?></td>
      <td><?= $ticket['description'] ?></td>
      <td>

<?php foreach ($users as $user) : ?>
  <?php if ($user['id'] == $ticket['id']) : ?>

      <?= $user['last_name'] . ' ' . $user['first_name'] ?></br>
  <?php endif; ?>
<?php endforeach; ?>

      </td>
      <td><a href="/tickets/show?id=<?= $ticket['id'] ?>"><i class="bi bi-box-arrow-in-up-right"></i></a></td>
    </tr>
<?php endforeach; ?>
  </tbody>

</table>
</div>



<!-- Modal DELETE -->

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <form action="/clients/customers" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $client['id']?>">
        <button type="submit" class="btn btn-danger">Да</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal ADD PHONE-->

<div class="modal fade" id="add_phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить телефон</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action="/clients/customers/add-phone" method="post">
      <div class="modal-body d-flex align-items-center">
        <h6 class="mt-2">+7</h6>
        <div class="input-group ms-2">
          <input name="phone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" class="form-control border-primary" placeholder="9XX-XXX-XX-XX" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>

    
        <input type="hidden" name="id" value="<?= $client['id']?>">
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once VIEWS . '/includes/footer.php';