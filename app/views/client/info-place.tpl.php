<?php
require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';
?>


<div class="container text-left">
    <div class="row border-bottom border-black">
        <div class="col-4 border-end border-black">
        <h1><?=$place['name']?></h1>
        </div>
        <div class="col-6"></div>
        <div class="col-2">
   
        </div>
    </div>
</div>


<p>Заявители, которые работают в данном кабинете/помещении: </p>
<?php foreach ($clients as $client) : ?>
    <div class="card" style="width: 18rem;">
        <a href="/client/show?id=<?= $client['id'] ?>" class="btn btn-secondary">
            <div class="card-body">
                <h5 class="card-title"><?= $client['name']?></h5>
            </div>
        </a>
    </div>
<?php endforeach; ?>





<!-- Modal -->





<?php
require_once VIEWS . '/includes/footer.php';