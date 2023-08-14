<?php

require VIEWS . '/includes/header.php';
require VIEWS . '/includes/clientsidebar.php';
?>
<form action="client/create-place" method="post">

<div class="mb-3">
  <label for="place" class="form-label">Кабинет</label>
  <input name="name" type="text" class="form-control" id="place" placeholder="Прим. ГЗ, аудитория 01">
</div>

<div class="mb-3">
  <label for="phone" class="form-label">Телефон</label>
  <input name="phone" type="text" class="form-control" id="phone" placeholder="Прим. 12-34">
</div>


<button type="submit" class="btn btn-primary">Добавить</button>
</div>

</form>

<?php
require VIEWS . '/includes/footer.php';