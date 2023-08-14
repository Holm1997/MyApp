<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>


<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">№</th>
            <th scope="col">Название подразделения</th>
            <th scope="col">Кол-во помещений</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($deps as $dep) : ?>
      <tr>
            <td scope="row"><?= $dep['id']?></td>
            <td><?= $dep['name'] ?></td>
      <?php foreach ($rooms as $room) : ?>
        <?php if ($room['id'] == $dep['id']) : ?>
            <td><?= $room['nums'] ?></td>
        <?php endif; ?>
      <?php endforeach;  ?>
            <td><a href='client/departament/show?id=<?=$dep['id']?>'>Detail</a></td>
        
      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>
<?php
require VIEWS . '/includes/footer.php';