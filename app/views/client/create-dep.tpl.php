<?php


require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';

?>
<?php get_alerts(); ?>

<form action="" method="post">
<div class="mb-3">
  <label for="abbr" class="form-label">Название подразделения (аббревиатура) </label>
  <input name="name"type="text" class="form-control" id="abbr" placeholder="Введите...">
</div>

<?= isset($validation) ? $validation->listErrors('name') : '' ?>


<button type="submit" class="btn btn-primary">Добавить</button>


</form>


<?php

require_once VIEWS . '/includes/footer.php';