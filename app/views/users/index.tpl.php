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
	<?php if ($user['id'] != 1) :?>
      <?php if ($user['urid'] == 1) : ?>
      <tr class="table-primary">
      <?php else : ?>
      <tr>
      <?php endif;?>
            <td><?= $user['last_name'] .' ' . $user['first_name']?></td>
            <td><?= $user['phone'] ?></td>
            <td scope="row"><?= $user['role'] ?></td>
      <?php if ($_SESSION['user']['roleid'] == 1) : ?>
            <td><a href='users/show?id=<?=$user['id']?>'><i class="bi bi-box-arrow-in-up-right"></i></a></td>
      <?php endif; ?>
      </tr>
	<?php endif; ?>
    <?php endforeach; ?>
    
  </tbody>
</table>

<?php
require_once VIEWS . '/includes/footer.php';

