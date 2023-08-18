<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';
?>


<div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded">
  <div class="card-header">
    <div class="row">
      <div class="col-6 d-flex">
        <p class="mt-2">Кабинет/помещение</p>
        <h3 class="ms-3"><?= $place['name'] ?></h3>
        
      </div>
      <div class="col-4">
        <?php if ($dep) : ?>
          <h4><?= $dep['name'] ?></h4>
        <?php else : ?>
          <h4 style="color: red;">нет подразделения</h4>
        <?php endif; ?>
      </div>
      <div class="col-2">
      
      <?php if($_SESSION['user']['roleid'] == 1) : ?>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">Удалить</button>
      <?php endif; ?>
      </div>
    </div>

  </div>
  <div class="card-body">
    <p class="card-text">Заявители, которые работают в данном кабинете/помещении:</p>
    
    <div>
    <?php if ($clients) :?>
      <?php foreach ($clients as $client) : ?>
      <a class="btn btn-outline-primary mx-2 my-2" href="client/show?id=<?=$client['id']?>" role="button"><?= $client['name'] ?></a>
      <?php endforeach;?>
    <?php else : ?>
        <h4 style="color: red;">Здесь пока нет заявителей</h4>
    <?php endif; ?>
    </div>




  </div>
</div>

<div class="table-responsive">
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата закрытия заявки</th>
            <th scope="col">Заявитель</th>
            <th scope="col">Наименование оборудование</th>
            <th scope="col">Краткое описание проблемы и выполненных работ</th>
            <th scope="col">Назначенные сотрудники</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($tickets as $ticket) : ?>
      <?php if ($ticket['ticket_status'] == "Выполнена успешно") : ?>
        <tr class="table-success">
          <th scope="row"><i class="bi bi-check-lg me-2" style="color: green;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php elseif ($ticket['ticket_status'] == "Не выполнена") : ?>
        <tr class="table-danger">
          <th scope="row"><i class="bi bi-x-lg me-2" style="color: red;"></i>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php elseif ($ticket['ticket_status'] == "Новая заявка") : ?>
        <tr class="table-warning">
          <th scope="row">
          <div class="spinner-grow spinner-grow-sm text-primary me-1" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php elseif ($ticket['ticket_status'] == "Повторная заявка") :?>
        <tr class="table-warning">
          <th scope="row">
          <div class="spinner-grow spinner-grow-sm text-primary me-1" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php else : ?>
        <tr>
        <th scope="row">
          <div class="spinner-border spinner-border-sm text-warning me-1" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
            <?php if ($ticket['previous']) : ?>
              <?= $ticket['id'] ?>
              <i class="bi bi-arrow-left"></i><?=' (' . $ticket['previous'] . ')'?>
            <?php else : ?>
              <?= $ticket['id']?>
            <?php endif; ?>
          </th>
      <?php endif;?>


      <?php if ($ticket['closing_date']) : ?>
            <td><?= format_date_from_sql($ticket['closing_date']) ?></td>
      <?php else : ?>
            <td>-----</td>
      <?php endif; ?>

      <?php foreach ($clients as $client) :?>
        <?php if ($client['id'] == $ticket['client_id']) : ?>
            <td><?= $client['name']?></td>
        <?php else : ?>
            <td>-----</td>
        <?php endif; ?>
      <?php endforeach;?>
            <td><?= ticket_device($ticket['id']) ?></td>

      <?php if ($ticket['description']) : ?>
            <td><?= $ticket['description'] ?></td>
      <?php else : ?>
            <td>-----</td>
      <?php endif; ?>

            <td>
            <?php foreach ($ticket_user as $user) : ?>
              <?php if ($user['tid'] == $ticket['id']) : ?>
              <?= $user['last_name'] . ' ' . $user['first_name']?></br>
              <?php endif;?>
            <?php endforeach; ?>
            </td>
            <td><a href="/ticket/show?id=<?= $ticket['id']?>" ><i class="bi bi-box-arrow-in-up-right"></i></a></td>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?='Кабинет ' . $place['name']?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Точно хотите удалить кабинет из базы данных?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>

    <form action="/client/place" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $place_id?>">
        <button type="submit" class="btn btn-danger">Да</button>
    </form>
      </div>
    </div>
  </div>
</div>





<?php
require_once VIEWS . '/includes/footer.php';