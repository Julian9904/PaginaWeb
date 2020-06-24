<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {

    if ($_POST['password'] != $_POST['confirm_password']) {
      $pass_message = 'Las contraseñas no coinciden, intente de nuevo.';
  }else{
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>

    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/signup.css">

  </head>
  <body>


    <?php if(!empty($message)): ?>
      <p class="text-center"> <?= $message ?></p>
    <?php endif; ?>

    <div class="container">
        <div class="logo-container text-center">
            <!-- <a href="../index.html" class="logo">
                <img src="../img/logo-windsor1.png" class="img-fluid" alt="logo - wix">
            </a> -->
        </div>
        <div class="registro-container">
            <div class="registro-details">
                <form action="signup.php" method="POST">
                  <h1>Crear cuenta</h1>
                  <div class="reg email">
                      <label for="">Correo electrónico</label>
                      <input type="email" name="email" class="form-control form-control-sm">
                      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  
                  </div>
                  <div class="reg password">
                      <label for="password">Contraseña</label>
                      <input type="password" name="password" class="form-control form-control-sm">
                      <div class="info">
                          <i class="fas fa-info-circle"></i>
                          <p>
                              La contraseña debe tener 6 caracteres como mínimo.
                          </p>
                      </div>
                  </div>
                  <div class="reg confirm-password">
                      <label for="confirm-pass">Confirma tu contraseña</label>
                      <input type="password" name="confirm_password" class="form-control form-control-sm">
                  </div>
  
                  <div class="reg create-account">
                  <input type="submit" value="Crear cuenta" class="btn btn-success p-1">
                  </div>
                </form>

                <div class="legal">
                    <p>
                        Al identificarte aceptas nuestras <a href="#">Condiciones de uso</a> y el <a href="#">Aviso de privacidad</a> de Windsor.com
                    </p>
                </div>

                <div class="divide-line">

                </div>

                <div class="inicio-sesion">
                    <p>
                        ¿Ya tiene una cuenta? <a href="login.php">Iniciar sesión</a>
                    </p>
                </div>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="divide-line">

        </div>
        <div class="footer">
            <ul class="list-inline text-center">
                <li class="list-inline-item">
                    <a href="#"> Condiciones de uso </a>
                </li>
                <li class="list-inline-item">
                    <a href="#"> Aviso de privacidad </a>
                </li>
                <li class="list-inline-item">
                    <a href="#"> Ayuda </a>
                </li>
            </ul>
            
        </div>

        <footer>
            <p class="text-center">
                <!-- <a href="https://www.freepik.es/fotos-vectores-gratis/diseno">Vector de Diseño creado por freepik - www.freepik.es</a> -->
            </p>
            <p class="text-center text-muted">
                © 2015-2020, Windsor.com, Inc. Todos los derechos reservados.
            </p>
        </footer>
    </div>












    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

  </body>
</html>
