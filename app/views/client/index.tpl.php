<?php


require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';




?>


<?php if ($clients) : ?>

<table class="table">
    <thead>
        <tr class='table-secondary'>
            <th scope="col">Клиент</th>
            <th scope="col">Телефон</th>
            <th scope="col">Место</th>
            <th scope="col">Подразделение</th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($clients as $client) : ?>
        <tr>
            <th scope="row"><?= $client['name'] ?></th>

            <?php if ($client['phone']) : ?> 
              <td><?= $client['phone'] ?></td>
            <?php else : ?>
              <td><?= $client['placephone'] ?></td>
            <?php endif;?>
            <td><?= $client['pname']?></td>
            <td><a href="client/show?id=<?=$client['id']?>">Detail</a></td>
    </tr>
    
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php else :  ?>
<h1>Нет заявителей в базе данных<h2>
<?php endif;?>

<?php

require_once VIEWS . '/includes/footer.php';