<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= PATH ?>/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href='public/assets/main.css'>
    <title>СУЗ :: Авторизация</title>
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
  <div class="container vh-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-4 col-xl-4">
        <div class="card text-black shadow p-3 mb-5 bg-body-tertiary rounde" >
          <div class="card-body p-md-1">
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-6 col-xl-10 order-2 order-lg-1">
           

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-0 mt-5">Авторизация</p>

                <form action="/login" method="post" class="mx-1 mx-md-2">

                <?php if (!$_SESSION['error']) :?>

                  <div class="d-flex flex-row align-items-center form-floating mb-5">
                      <input name="login" type="login" class="form-control border-secondary" id="floatingInput" placeholder="">
                      <label for="floatingInput">Логин</label>
                  </div>

                  <div class="d-flex flex-row align-items-center form-floating mb-5">
                      <input name="password" type="password" class="form-control border-secondary" id="floatingInput" placeholder="">
                      <label for="floatingInput">Пароль</label>
                  </div>
                <?php else : ?>
                  <?= get_alerts() ?>
                <?php endif;?>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Войти</button>
                  </div>

                </form>
                <div class="fw-bold text-center">
                    <p>&copy; Copyright <?= date("Y") ?> by <a style="text-decoration: none;" href="https://github.com/Holm1997">Holm1997</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>