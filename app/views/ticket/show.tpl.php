<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/ticketsidebar.php';
?>

<div class="container-fluid">



  <div class="row mt-2">
    <div class="col-12 p-0">
      <div class="card m-0 p-0 shadow bg-body mb-2 rounded">
        <div class="card-body">

          <div class="row align-items-center">

            <div class ="col-4 d-flex align-items-center">

              <?php if ($ticket['ticket_status'] == 'В работе') : ?>
  
                <div class="spinner-border spinner-border text-warning me-3" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <h1 class="card-title"><?='Заявка № ' . $ticket['id'] ?></h1>

              <?php elseif (($ticket['ticket_status'] == 'Новая заявка')) : ?>
                <div class="spinner-grow spinner-grow text-primary me-3" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <h1 class="card-title"><?='Заявка № ' . $ticket['id'] ?></h1>
            
              <?php elseif (($ticket['ticket_status'] == 'Повторная заявка')) : ?>
                <div class="spinner-grow spinner-grow text-danger me-3" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <h1 class="card-title"><?='Заявка № ' . $ticket['id'] ?></h1>

              <?php elseif ($ticket['ticket_status'] == 'Выполнена успешно') : ?>
                <h1 class="card-title"><i class="bi bi-check-lg me-2" style="color: green;"></i><?='Заявка № ' . $ticket['id'] ?></h1>
              <?php else : ?>
                <h1 class="card-title"><i class="bi bi-x-lg me-2" style="color: red;"></i><?='Заявка № ' . $ticket['id'] ?></h1>
              <?php endif; ?>

            </div>
              <div class="col-4 text-center">
            <?php if ($ticket['previous']) : ?>
              <h5>Повторная заявка с заявки
                <a href="/ticket/show?id=<?= (int)$ticket['previous']?>" style="text-decoration: none;"><i class="bi bi-box-arrow-in-right me-2"></i><?=  $ticket['previous'] ?></a>
              </h5>
            <?php endif; ?>
            </div>
            <div class="col-4 text-end">
              <?php if($_SESSION['user']['roleid'] == 1) : ?>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
                  Удалить
                </button>

              <?php endif; ?>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-3 p-0">
      <div class="card m-0 p-0 shadow bg-body mb-2 rounded" style="height: 100%;">
        <div class="card-body">
          <div class="align-items-center">

            <p>Кабинет/помещение:</p>
            <h4><?=$ticket['name']?><a href="/client/place/show?id=<?= $ticket['pid']?>" style="decoration-border: none;"><i class="bi bi-house-gear ms-2"></i></a></h4>

            <p>Подразделение:</p>
              <?php if (!$departament) : ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartament">
                <i class="bi bi-diagram-2-fill me-2"></i>Добавить подразделение
                </button>
              <?php else : ?>
                <h4><?= $departament['name'] ?><a href="/client/departament/show?id=<?= $departament['id']?>" style="decoration-border: none;"><i class="bi bi-diagram-2 ms-2"></i></a></h4>
              <?php endif; ?>

            <p>Заявитель: </p>
              <?php if (!$ticket['client_id']) : ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClient">
                <i class="bi bi-person-plus-fill me-2"></i>Добавить заявителя
                </button>
              <?php else : ?>
                <h4><?= $client_id['name']?><a href="/client/show?id=<?= $client_id['id']?>" style="decoration-border: none;"><i class="bi bi-person-gear ms-2"></i></a></h4>
              <?php endif; ?>

            <p>Телефон: </p>
              <h4><?= $ticket['phone'] ?><h4>

          </div>
        </div>
      </div>
    </div>

    <div class="col-6 p-0">
      <div class="card m-0 p-0 shadow bg-body mb-2 rounded" style="height: 100%;">
        <div class="card-body">
          <div class="align-items-center">

            <?php if ($device['name']) : ?>
              <p>Наименование оборудования: </p>
              <h3><?=$ticket['catname'] . ' ' . $device['name']?></h3>
            <?php else : ?>
              <p>Наименование оборудования: </p>
              <h3><?=$ticket['catname']?></h3>
            <?php endif; ?>

            <p>Причина обращения: </p>
              <h3><?=$ticket['subject']?></h3>
            
            <hr>

            <?php if ($ticket['ticket_status'] == "Не выполнена" or $ticket['ticket_status'] == "Выполнена успешно") : ?>
              <p>Краткое описание:</p>
              <?php if ($ticket['ticket_status'] == "Выполнена успешно") : ?>
                <h4 style="color: green;"><?= $ticket['description']?></h4>
              <?php else : ?>
                <h4 style="color: red;"><?= $ticket['description']?></h4>
              <?php endif; ?>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>

    <div class="col-3 p-0">
      <div class="card m-0 p-0 shadow bg-body mb-2 rounded" style="height: 100%;">
        <div class="card-body">
          <div class="align-items-center">

            <p>Назначенные сотрудники: </p>
            <?php foreach ($users as $user) : ?>
              <h5><?= $user['last_name'] .' ' . $user['first_name'] ?></h5>
            <?php endforeach; ?>


          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-12 p-0">
      <div class="card m-0 p-0 shadow bg-body mb-2 rounded" style="height: 100%;">
        <div class="card-body">
            <div class="row">
            <div class="col-4">
                <p>Дата и время создания заявки: </p>
                <?php if ($ticket['ticket_status'] == 'Выполнена успешно') : ?>
                  <h3 style="color: green;"><?=format_date_from_sql($ticket['creation_date'])?></h3>
                <?php elseif ($ticket['ticket_status'] == 'Не выполнена' or $ticket['ticket_status'] == 'Повторная заявка') : ?>
                  <h3 style="color: red;"><?=format_date_from_sql($ticket['creation_date'])?></h3>
                <?php elseif ($ticket['ticket_status'] == 'Новая заявка') : ?>
                  <h3 style="color: blue;"><?=format_date_from_sql($ticket['creation_date'])?></h3>
                <?php else : ?>
                  <h3 style="color: orange;"><?=format_date_from_sql($ticket['creation_date'])?></h3>
                <?php endif;?>
            </div>
            <div class="col-4">
                <p>Дата и время начала работ по заявке: </p>
                <?php if ($ticket['ticket_status'] == 'Выполнена успешно') : ?>
                  <h3 style="color: green;"><?= format_date_from_sql($ticket['working_date'])?></h3>
                <?php elseif ($ticket['ticket_status'] == 'Не выполнена') : ?>
                  <h3 style="color: red;"><?=format_date_from_sql($ticket['working_date'])?></h3>
                <?php else : ?>
                  <h3 style="color: orange;"><?=format_date_from_sql($ticket['working_date'])?></h3>
                <?php endif;?>
            </div> 
            <div class="col-4">
                <p>Дата и время закрытия заявки: </p>
                <?php if ($ticket['ticket_status'] == 'Выполнена успешно') : ?>
                  <h3 style="color: green;"><?=format_date_from_sql($ticket['closing_date'])?></h3>
                <?php elseif ($ticket['ticket_status'] == 'Не выполнена') : ?>
                  <h3 style="color: red;"><?=format_date_from_sql($ticket['closing_date'])?></h3>
                <?php endif;?>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>




</div>














<div class="container-fluid">

<form action="" method="post">

<?php if ($ticket['ticket_status'] == 'Новая заявка' or $ticket['ticket_status'] == 'Повторная заявка') :?>
  <div class="row mb-2 mb-3 text-center">
    <div class="col">

<input type="hidden" name="accept" value="ok">
<button type="submit" class="btn btn-primary">Принять заявку</button>
</div>
</div>
<?php elseif ($ticket['ticket_status'] == 'В работе') :?>

  <div class="row mt-2 mb-3">
    <div class="col-12 p-0">
  <div class="card m-0 p-0 shadow bg-body mb-2 rounded" style="height: 100%;">
        <div class="card-body">
        <div class="row mt-3">
    <label for="device" class="col-sm-4 mb-0">Введите название модель оборудования (необязательно)</label>
    <div class="col-sm-5">
      <input name="device" type="text" class="form-control border border-primary" id="subject" placeholder="Введите...">
    </div>
</div>

<hr>

<div class="row mb-3">
    <label for="description" class="col-sm-4">Краткое описание проблемы и выполненных работ</label>
    <div class="col-6">
      <textarea name="description" type="text" class="form-control border border-primary" id="description" placeholder="Введите..."></textarea>
    </div>
</div>

    </div>
</div>  
</div>
</div>




<div class="row mb-3 text-center">
  <div class="col">
<input name="place_id" type="hidden" value="<?= $ticket['pid'] ?>">
<input name="cid" type="hidden" value="<?= $ticket['cid'] ?>">
<input name="catid" type="hidden" value="<?= $ticket['catid'] ?>">
<input name="close" value="Выполнена успешно" type="submit" class="btn btn-primary">
<input name="close" value="Не выполнена" type="submit" class="btn btn-danger">

</div>
</div>
<?php elseif ($ticket['ticket_status'] == 'Не выполнена') :?>
  <div class="row mb-3 text-center">
  <div class="col">
  <button type="button" class="btn btn-danger mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#repeat">
      Создать повторную заявку
  </button>
  </div>
</div>

<?php endif; ?>

</form>
</div>

<div class="table-responsive">
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата закрытия заявки</th>
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
            <td><?= elapsed_time_for_info($ticket['id']) ?></td>
      <?php else : ?>
            <td>-----</td>
      <?php endif; ?>

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
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?='Заявка № ' . $ticketid ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          точно хотите удалить заявку из базы данных?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
    <form action="/ticket" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $ticketid?>">
        <button type="submit" class="btn btn-danger">Да</button>
    </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal ADD CLIENT-->
<div class="modal fade" id="addClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Выберите заявителя</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      
      <div class="modal-body">
      <form action="" method="post">

      <?php foreach ($client as $item) : ?>
          <div class="form-check">
            <input name='cname' class="form-check-input border-primary" type="radio" value="<?= $item['id']?>" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              <p><?= $item['name']?></p>
            </label>
          </div>
        <?php endforeach; ?>
            <input type="hidden" name="place_id" value="<?= $place ?>">
            <hr>
            <h5>Если нет в списке</h5>
            <input name="cname_write" type="text" class="form-control border border-primary" placeholder="Введите имя заявителя">
        </div>
        <div class="modal-footer">
              <input name="add_client" type="hidden" value="1">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
              <button type="submit" class="btn btn-success">Добавить</button>
        </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal ADD DEPARTAMENT-->
<div class="modal fade" id="addDepartament" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">



      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Выберите подразделение</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>



      <div class="modal-body">
      <form action="" method="post">

      <?php foreach ($departaments as $dep) : ?>
          <div class="form-check">
            <input name='departament' class="form-check-input border-primary" type="radio" value="<?= $dep['id']?>" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              <p><?= $dep['name']?></p>
            </label>
          </div>
        <?php endforeach; ?>
        <hr>
            <h5>Если нет в списке</h5>

            <input type="hidden" name="place_id" value="<?= $place ?>">
            <input name="dname_write" type="text" class="form-control border border-primary" placeholder="Введите название департамента">
      </div>
      <div class="modal-footer">
            <input name="add_dep" type="hidden" value="1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            <button type="submit" class="btn btn-success">Добавить</button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal REPEAT TICKET (Повторная заявка) -->

<div class="modal fade" id="repeat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание повторной заявки</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/ticket/create" method="post">
          <div class="mb-3">
            <label for="subject" class="form-label">Введите причину обращения:</label>
            <input name="subject" type="text" class="form-control border border-primary" id="subject">
          </div>
          <?php if ($_SESSION['user']['roleid'] == 1) : ?>
            <h4>Назначить сотрудника/сотрудников</h4>
          <?php foreach ($repeat_users as $user) : ?>
            <div class="form-check">
                <input name="user_id[<?=$user['id'] ?>]" class="form-check-input" type="checkbox" value="<?= $user['id'] ?>" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                <?= $user['lname'] .' '. $user['fname'] ?>
                </label>
            </div>
          <?php endforeach; ?>
          <?php else : ?>
                <input name="user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">
          <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
        <input type="hidden" name="repeat" value="1">
        <input type="hidden" name="category_id" value="<?= $catid ?>">
        <input type="hidden" name="client_id" value="<?= $client_id['id']?>">
        <input type="hidden" name="place_id" value="<?= $place?>">
        <input type="hidden" name="previous" value="<?= $id?>">
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
      </div>
    </div>
  </div>
</div>



<?php
require_once VIEWS . '/includes/footer.php';