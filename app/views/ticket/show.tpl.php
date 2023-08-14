<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/ticketsidebar.php';
?>



<div class="container text-center">
  <div class="row border-bottom border-black bg-primary-subtle text-black">
    
    <div class="col-3">
      <p>Статус: </p>
      <?php if ($ticket['ticket_status'] == 'Выполнена успешно') : ?>
        <?php if ($ticket['previous']) : ?>
          <h5><a href="/ticket/show?id=<?= $ticket['previous'] ?>" style="text-decoration: none;">
          <font color="green"><?=$ticket['ticket_status'] . ' <= №'. $ticket['previous']?></font>
        </a></h5>
        <?php else : ?>
          <h5><font color="green"><?=$ticket['ticket_status']?></font></h5>
        <?php endif;?>
      <?php elseif ($ticket['ticket_status'] == 'Не выполнена') : ?>
        <?php if ($ticket['previous']) : ?>
          <h5><a href="/ticket/show?id=<?= $ticket['previous'] ?>" style="text-decoration: none;">
          <font color="red"><?=$ticket['ticket_status'] . ' <= №'. $ticket['previous']?></font>
          </a></h5>
        <?php else : ?>
          <h5><font color="red"><?=$ticket['ticket_status']?></font></h5>
        <?php endif;?>
      <?php elseif ($ticket['ticket_status'] == 'В работе') : ?>
        <?php if ($ticket['previous']) : ?>
          <h5><a href="/ticket/show?id=<?= $ticket['previous'] ?>" style="text-decoration: none;">
          <font color="orange"><?=$ticket['ticket_status'] . ' <= №'. $ticket['previous']?></font>
          </a></h5>
        <?php else : ?>
          <h5><font color="orange"><?=$ticket['ticket_status']?></font></h5>
        <?php endif;?>
      <?php elseif ($ticket['ticket_status'] == 'Повторная заявка') : ?>?>
        <h5><font color="blue">
          <a href="/ticket/show?id=<?= $ticket['previous'] ?>" style="text-decoration: none;"><?=$ticket['ticket_status'] . ' <= №'. $ticket['previous']?></a>
        </font></h5>
      <?php else : ?>
        <h5><font color="blue">
          <?=$ticket['ticket_status'] ?>
        </font></h5>
      <?php endif;?>
    </div>
    
    <div class="col-6">
      <h1><?='Заявка № ' . $ticket['id'] ?></h1>
    </div>

<?php if($_SESSION['user']['roleid'] == 1) : ?>

    <div class="col-3">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
      Удалить
    </button>

    </div>
<?php endif; ?>
  </div>
</div>



<div class="container text-left">
  <div class="row">
    <div class="col border-end border-black">
      <p>Кабинет/помещение:</p>
      <h4><?=$ticket['name']?></h4>
      <p>Подразделение:</p>
      <?php if (!$departament) : ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartament">
            Добавить подразделение
        </button>
      <?php else : ?>
        <h4><?= $departament['name'] ?></h4>
      <?php endif; ?>

      <p>Заявитель: </p>

      <?php if (!$ticket['client_id']) : ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClient">
            Добавить заявителя
        </button>
      <?php else : ?>
          <h4><?= $client_id['name']?></h4>
      <?php endif; ?>

    <p>Телефон: </p>
    <h4><?= $ticket['phone'] ?><h4>
    </div>
    <div class="col-6">
  <?php if ($device['name']) : ?>
    <p>Наименование оборудования: </p>
    <h3><?=$ticket['catname'] . ' ' . $device['name']?></h3>
  <?php else : ?>
    <p>Наименование оборудования: </p>
    <h3><?=$ticket['catname']?></h3>
  <?php endif; ?>
    <p>Причина обращения: </p>
    <h3><?=$ticket['subject']?></h3>
    </div>
    <div class="col border-start border-black"> 
    <p>Назначенные сотрудники: </p>
  <?php foreach ($users as $user) : ?>
    <h5><?= $user['last_name'] .' ' . $user['first_name'] ?></h5>
  <?php endforeach; ?>
    </div>
  </div>
 
  <div class="row border-top border-bottom border-black">
    <div class="col">
    <p>Дата и время создания заявки: </p>
    <h3><?=$ticket['creation_date']?></h3>
    </div>
    <div class="col-6">
    <p>Дата и время начала работ по заявке: </p>
    <h3><?=$ticket['working_date']?></h3>
    </div>
    <div class="col">  
    <p>Дата и время закрытия заявки: </p>
    <h3><?=$ticket['closing_date']?></h3>
    </div>
  </div>
  <?php if ($ticket['ticket_status'] == "Не выполнена" or $ticket['ticket_status'] == "Выполнена успешно") : ?>
  <div class="row border-bottom border-black">
    <div class="col">
    <p>Краткое описание причины обращения и выполненных работ: </p>
    <h4><?=$ticket['description']?></h4>
    </div>
  </div>
  <?php endif; ?>
</div>




<div class="container text-center">
  <div class="row">

<form action="" method="post">

<?php if ($ticket['ticket_status'] == 'Новая заявка' or $ticket['ticket_status'] == 'Повторная заявка') :?>

<input type="hidden" name="accept" value="ok">
<button type="submit" class="btn btn-primary">Принять заявку</button>

<?php elseif ($ticket['ticket_status'] == 'В работе') :?>

<div class="input-group">
  <span class="input-group-text">Введите название модель оборудования ( необязательно )</span>
  <input name="device" type="text" class="form-control" aria-label="Username">
</div>

<div class="input-group">
  <span class="input-group-text">Краткое описание проблемы и выполненных работ</span>
  <textarea name="description" class="form-control" aria-label="With textarea"></textarea>
</div>

<input name="place_id" type="hidden" value="<?= $ticket['pid'] ?>">
<input name="cid" type="hidden" value="<?= $ticket['cid'] ?>">
<input name="catid" type="hidden" value="<?= $ticket['catid'] ?>">
<input name="close" value="Выполнена успешно" type="submit" class="btn btn-primary">
<input name="close" value="Не выполнена" type="submit" class="btn btn-danger">

<?php elseif ($ticket['ticket_status'] == 'Не выполнена') :?>
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#repeat">
      Создать повторную заявку
  </button>

<?php endif; ?>

</form>
</div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">№ Заявки</th>
            <th scope="col">Дата закрытия заявки</th>
            <th scope="col">Статус заявки</th>
            <th scope="col">Помещение</th>
            <th scope="col">Наименование оборудование</th>
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

      <?php if ($ticket['closing_date']) : ?>
            <td><?= $ticket['closing_date'] ?></td>
      <?php else : ?>
            <td>-----</td>
      <?php endif; ?>

      <?php if ($ticket['ticket_status'] == 'В работе') : ?>
            <td><font color="orange"><?= $ticket['ticket_status'] ?></font></td>
      <?php else :?>
            <td><?= $ticket['ticket_status'] ?></td>
      <?php endif;?>
            <td><?= $ticket['name'] ?></td>
            <td><?= $ticket['catname'] ?></td>

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
            <td><a href="/ticket/show?id=<?= $ticket['id']?>" >Detail</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>

</table>



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
            <input name='cname' class="form-check-input" type="radio" value="<?= $item['id']?>" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              <p><?= $item['name']?></p>
            </label>
          </div>
        <?php endforeach; ?>
            <input type="hidden" name="place_id" value="<?= $place ?>">
            <input name="cname_write" type="text" class="form-control border border-primary" placeholder="Введите имя заявителя">
        </div>
        <div class="modal-footer">
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
            <input name='departament' class="form-check-input" type="radio" value="<?= $dep['id']?>" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              <p><?= $dep['name']?></p>
            </label>
          </div>
        <?php endforeach; ?>

            <input type="hidden" name="place_id" value="<?= $place ?>">
            <input name="dname_write" type="text" class="form-control border border-primary" placeholder="Введите название департамента">
      </div>
      <div class="modal-footer">
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