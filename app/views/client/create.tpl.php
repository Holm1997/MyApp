<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>

<div class="row mt-3 mb-3 text-center">
<div class="col-4">
<a class="btn btn-primary" href="client/create-dep" role="button">Добавить подразделение</a>
</div>

<div class="col-4">
<a class="btn btn-primary" href="client/create-place" role="button">Добавить кабинет</a>
</div>

<div class="col-4">
<a class="btn btn-primary" href="client/create-client" role="button">Добавить заявителя</a>
</div>
</div>



<?php
require VIEWS . '/includes/footer.php';