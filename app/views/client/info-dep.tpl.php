<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';
?>




<div class="container text-left">
    <div class="row border-bottom border-black">

        <div class="col-3 border-end border-black">
            <h1><?=$dep['name']?></h1>
        </div>

        <div class="col-8">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
            Добавить кабинет
        </button>
        </div>

        <div class="col-1">
<?php if($_SESSION['user']['roleid'] == 1) : ?>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
            Удалить
            </button>
<?php endif; ?>
        </div>

    </div>
</div>

<h5>Кабинеты и помещения подразделения: </h5>
<?php foreach ($places as $place) : ?>
  <div class="card" style="width: 18rem;">
  <a href="/client/place/show?id=<?= $place['id']?>" class="btn btn-secondary">
  <div class="card-body">
    <h5 class="card-title"><?= $place['name']?></h5>
  </div>
  </a>
</div>
<?php endforeach; ?>







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

    <form action="/client/departament" method="post">
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