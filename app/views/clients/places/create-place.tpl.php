<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>
<form action="clients/places/create-place" method="post">

<div class="row mt-3 mb-3">
<label for="place" class="col-sm-3 col-form-label"><h5>Кабинет</h5></label>
<div class="col-sm-5">
<input name="name" type="text" class="form-control border-primary" id="place" placeholder="Прим. ГЗ, аудитория 01">
</div>
</div>

<div class="row mt-3 mb-3">
<label for="phone" class="col-sm-3 col-form-label"><h5>Телефон</h5></label>
<div class="col-sm-5">
<input name="phone" type="text" class="form-control border-primary" id="phone" placeholder="Прим. 12-34">
</div>
</div>


<div class="row text-center">
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Добавить</button>
  </div>
</div>

</form>

<?php
require VIEWS . '/includes/footer.php';