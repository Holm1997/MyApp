<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>

<div class="row mt-3 mb-3 text-center">
<div class="col-4">
<a class="btn btn-primary" href="clients/departaments/create-dep" role="button"><i class="bi bi-diagram-2-fill me-2"></i>Добавить подразделение</a>
</div>

<div class="col-4">
<a class="btn btn-primary" href="clients/places/create-place" role="button"><i class="bi bi-house-add-fill me-2"></i>Добавить кабинет</a>
</div>

<div class="col-4">
<a class="btn btn-primary" href="clients/customers/create-customer" role="button"><i class="bi bi-person-fill-add me-2"></i>Добавить заявителя</a>
</div>
</div>



<?php
require VIEWS . '/includes/footer.php';