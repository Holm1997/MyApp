<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>


<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Название подразделения</th>
            <th scope="col">Кол-во помещений</th>
            <th scope="col">Кол-во заявителей</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($deps as $dep) : ?>
      <tr>
            <td><?= $dep['name'] ?></td>
  
            <td><?= numbers_of_rooms_in_departament($dep['id']) ?></td>

            <td><?= numbers_of_clients_in_departament($dep['id']) ?></td>
  
            <td><a href='client/departament/show?id=<?=$dep['id']?>'>Detail</a></td>
      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>




<?php
require VIEWS . '/includes/footer.php';