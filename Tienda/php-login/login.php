<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: index-log.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: index-log.php");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>

    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/login.css">

  </head>
  <body>
    

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="container">
        <div class="logo-container text-center">
            <!-- <a href="../index.html" class="logo">
                <img src="../img/logo-windsor1.png" class="img-fluid" alt="logo - wix">
            </a> -->
        </div>

        <div class="sesion-container">
            <div class="sesion-details">
                <form action="login.php" method="POST">
                  <h1>Iniciar Sesión</h1>
                  <div class="sesion email">
                      <label for="">Correo electrónico</label>
                      <input type="email" name="email" class="form-control form-control-sm">
  
                  </div>
                  <div class="sesion password">
                      <label for="password">Contraseña</label>
                      <input type="password" name="password" class="form-control form-control-sm">
                  </div>
              </div>
              <div class="sesion iniciar-sesion">
                  <input type="submit" value="Ingresar" class="btn btn-success p-1">
              </div>
                </form>

            <div class="legal">
                <p>
                    Al identificarte aceptas nuestras <a href="#">Condiciones de uso</a> y el <a href="#">Aviso de privacidad</a> de Windsor.com.
                </p>
            </div>

            <div class="divide-line">
            </div>

            <div class="sesion help">
                <details>
                    <summary>
                        <a href="#">¿Necesitas ayuda?</a>
                    </summary>
                    <a href="#">¿Has olvidado la contraseña?</a><br>
                    <!-- <a href="#">Otros problemas al iniciar sesión</a> -->
                </details>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="line">

        </div>
        <p class="text-center text-muted">
            ¿Eres nuevo en Windsor?
        </p>
        <div class="sesion crear-cuenta">
            <a href="signup.php" class="btn btn-success">Crear una cuenta Windsor</a>
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
