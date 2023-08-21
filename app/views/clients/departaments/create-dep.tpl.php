<?php


require_once VIEWS . '/includes/header.php';
require_once VIEWS . '/includes/clientsidebar.php';

?>
<?php get_alerts(); ?>


<form action="" method="post">

<div class="row mt-3 mb-3">
<label for="abbr" class="col-sm-3 col-form-label"><h5>Название подразделения (аббревиатура) </h5></label>
<div class="col-sm-5">
<input name="name" type="text" class="form-control border-primary" id="abbr" placeholder="Введите...">
</div>
</div>




<?= isset($validation) ? $validation->listErrors('name') : '' ?>



<div class="row text-center">
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Добавить</button>
  </div>
</div>


</form>


<?php

require_once VIEWS . '/includes/footer.php';