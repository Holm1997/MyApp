<?php



require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/usersidebar.php';
?>

<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Фамилия/Имя</th>
            <th scope="col">Телефон</th>
            <th scope="col">Должность</th>
            <th scope="col"></th>
        </tr>
    </thead>

  <tbody class="table-group-divider">
    <?php foreach ($users as $user) : ?>
      <?php if ($user['urid'] == 1) : ?>
      <tr class="table-primary">
      <?php else : ?>
      <tr class="table-info">
      <?php endif;?>
            <td><?= $user['last_name'] .' ' . $user['first_name']?></td>
            <td><?= $user['phone'] ?></td>
            <td scope="row"><?= $user['role'] ?></td>
      <?php if ($_SESSION['user']['roleid'] == 1) : ?>
            <td><a href='user/show?id=<?=$user['id']?>'>Detail</a></td>
      <?php endif; ?>
      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php
require_once VIEWS . '/includes/footer.php';

