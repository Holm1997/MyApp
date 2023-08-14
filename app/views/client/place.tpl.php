<?php
require_once VIEWS . "/includes/header.php";
require_once VIEWS . "/includes/clientsidebar.php";
?>





<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Кабинет/помещение</th>
            <th scope="col">Телефон</th>
            <th scope="col">Кол-во заявителей</th>
            <th scope="col">Подразделение</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($places as $place) : ?>
      <tr>
            <td><?= $place['name'] ?></td>
            <td><?= $place['phone'] ?></td>

            <td><?= clients_for_place($place['id']) ?></td>

            <td><?= dep_for_place($place['id']) ?></td>

            <td><a href='client/place/show?id=<?=$place['id']?>'>Detail</a></td>
        
      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>






<?php
require_once VIEWS . "/includes/footer.php";
