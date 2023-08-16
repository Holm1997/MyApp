<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/usersidebar.php';
?>



<div class="container text-left">
    <div class="row border-bottom border-white bg-black text-white">
        <div class="col">
        <h1><?=$user['last_name'] .' '. $user['first_name'] ?></h1>

        <p><?=$user['phone']?></p>

        </div>
        <div class="col"> 
            
        </div>
        <div class="col">
            <h4><?= $user['role'] ?></h4>
            <?php if($_SESSION['user']['roleid'] == 1) : ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
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



<!-- Modal -->

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

    <form action="/user" method="post">
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