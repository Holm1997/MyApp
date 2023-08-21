<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';
?>


<div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded">
  <div class="card-header">
    <div class="row justify-content-around">
      <div class="col-auto d-flex me-auto">
        <p class="mt-2">Подразделение</p>
        <h3 class="ms-3"><?=$dep['name']?></h3>
        
      </div>
      <div class="col-auto d-flex">
            <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#add">Добавить кабинет</button>
      
      <?php if($_SESSION['user']['roleid'] == 1) : ?>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete"><i class="bi bi-trash3-fill"></i></button>
      <?php endif; ?>
      </div>
    </div>

  </div>
  <div class="card-body">
    <p class="card-text">Кабинеты и помещения подразделения:</p>
    
    <div>
    <?php if ($places) :?>
      <?php foreach ($places as $place) : ?>
      <a class="btn btn-outline-primary mx-2 my-2" href="clients/places/show?id=<?=$place['id']?>" role="button"><?= $place['name'] ?></a>
      <?php endforeach;?>
    <?php else : ?>
        <h4 style="color: red;">Здесь пока нет кабинетов и помещений</h4>
    <?php endif; ?>
    </div>

  


  </div>
</div>










<!-- Modal DELETE -->

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?='Подразделение ' . $dep['name']?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Точно хотите удалить подразделение из базы данных?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>

    <form action="/clients/departaments" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $dep['id']?>">
        <button type="submit" class="btn btn-danger">Да</button>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal ADD ROOM -->

<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить кабинет к подразделению</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <?php if (!$alone_places) :?>
        Нет помещений, которые вы можете добавить.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Выйти</button>
      </div>
      <?php else : ?>
        <form action="" method="post">
        <?php foreach ($alone_places as $pl) :?>
          <div class="form-check">
              <input name='place_id' value="<?= $pl['id'] ?>" class="form-check-input border border-primary" type="radio" id="place">
              <label class="form-check-label" for="place">
                <?= $pl['name'] ?>
              </label>
          </div>

        <?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="dep" value="<?= $id ?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
        <button type="submit" class="btn btn-success">Да</button>
    </form>
      </div>
    <?php endif; ?>
    </div>
  </div>
</div>


<?php
require_once VIEWS . '/includes/footer.php';