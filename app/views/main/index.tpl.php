<?php

require_once VIEWS . '/includes/header.php';
?>



<?= get_alerts(); ?>
<?php if ($_SESSION['user']['id'] == 1) :?>
<h1><?= 'Привет, '.$_SESSION['user']['lname'].'!' ?></h1>
<?php else :?>
<h1><?= 'Привет, '.$_SESSION['user']['fname'].'!' ?></h1>
<?php endif;?>
<h4>Добро пожаловать в систему учета заявок участка ВТ ДИЭ МГУ. Скоро здесь появится краткая инструкция по использованию данного приложения, но пока ее нет советую разобраться самому.</h4>

<button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>

<?php
require_once VIEWS . '/includes/footer.php';
