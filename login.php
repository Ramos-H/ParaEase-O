<!doctype html>
<html lang="en">
  <head>
    <title>ParaEase'O | Admin Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="shortcut icon" href="assets/icon.jpg" type="image/x-icon">
    <script src="scripts/forms.js"></script>
  </head>

  <body>
    <main>
      <?php require_once 'php/logic_login.php'; ?>
      <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-5">
          <img src="assets/icon_big.jpg" class="img-fluid mb-2" alt="ParaEase'O Logo">
          <h3 class="text-center">Log In</h3>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" onchange="check_field_empty(this, 'username')">
              <label for="username">Username</label>
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-floating mb-3">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" onchange="check_field_empty(this, 'password')">
              <label for="password">Password</label>
              <div class="invalid-feedback"></div>
            </div>
            
            <?php if(!empty($errors)): ?>
              <div class="text-danger mb-3">
                <?php echo $errors[0]; ?>
              </div>
            <?php endif; ?>

            <div class="d-grid"><button type="submit" class="btn btn-primary" name="submit" value="log in">Log In</button></div>
          </form>
        </div>
      </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  </body>
</html>