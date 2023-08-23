<?php


require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';




?>


<?php if ($clients) : ?>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr class='table-secondary'>
            <th scope="col">Клиент</th>
            <th scope="col">Телефон</th>
            <th scope="col">Место</th>
            <th scope="col">Подразделение</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($clients as $client) : ?>
        <tr>
            <th scope="row"><?= $client['name'] ?></th>

            <?php if ($client['phone']) : ?> 
              <td><?= '+7 ' . $client['phone'] ?></td>
            <?php else : ?>
              <td><?= $client['placephone'] ?></td>
            <?php endif;?>
            <td><?= $client['pname']?></td>
            <td><?= place_departament($client['pid']) ?></td>
            <td><a href="clients/customers/show?id=<?=$client['id']?>"><i class="bi bi-box-arrow-in-up-right"></i></a></td>
    </tr>
    
    <?php endforeach; ?>
    
  </tbody>
</table>
</div>
<?php else :  ?>
<h1>Нет заявителей в базе данных<h2>
<?php endif;?>

<?php

require_once VIEWS . '/includes/footer.php';