<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';

?>

        <br>
        <?php if($mensaje!=""){?>
        <div class="alert alert-sucess">
            <?php echo $mensaje; ?>

            <a href="mostrarCarrito.php" class="badge badge-sucess">Ver carrito</a>
        </div>
        <?php }?>
        <div class="row">

        <?php
            $sentencia=$pdo->prepare("SELECT * FROM `tblproducots`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        
        ?>

        <?php foreach($listaProductos as $producto){ ?>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                            <img
                    title="Mueble1" 
                    class="card-img-top img-fluid" src="<?php echo $producto['Imagen'];?>" alt="Titulo" heigth="200px">
                        </div>
                    
                    <div class="card-body">
                        <span><?php echo $producto['Nombre'];?></span>
                        <h5 class="card-title">$<?php echo number_format($producto['Precio'],0) ;?></h5>
                        <p class="card-text"><?php echo $producto['Descripcion'];?></p>
                        
                    <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                        <button class="btn btn-primary" 
                            name="btnAccion"
                            value="Agregar"
                            type="submit">Agregar al carrito</button>
                    </form>

                    
                        
                    </div>

                </div>
            </div>

        <?php } ?>

       
        </div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Muebles el ángel</title>
</head>

<body>
    

    <div class="container">
        <div class="card text-white bg-success my-5 py-4 text-center">
            <div class="card-body">
                <p class="text-white m-0 ">
                    <strong class="lead font-weight-bold">#YOMEQUEDOENCASA</strong> Quédate en casa, <strong>nosotros te
                        lo llevamos.</strong>
                </p>

            </div>
        </div>

        <div class="row bg-light">
            <div class="col-lg-6">
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="archivos/mueble4.jpg" alt="First slide">
                            <div class="carousel-caption">

                                <!-- <p>Secondary text</p> -->
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="archivos/mueble2.jpg" alt="Second slide">
                            <div class="carousel-caption">
                                <!-- <p>Secondary text</p> -->
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="archivos/mueble3.jpg" alt="Third slide">
                            <div class="carousel-caption">
                                <!-- <p>Secondary text</p> -->
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- Contacto -->
            <div class="col-lg-6">
                <h2 class="text-center">Contáctanos</h2>
                <form action="enviar-correo.php" method="post">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="text" class="form-control" id="email" placeholder="example@mail.com" name="email">
                    </div>
                    <div class="form-group">
                        <label for="msg">Mensaje</label>
                        <textarea name="msg" id="msg" cols="30" rows="4" placeholder="Dejanos tu inquietud."
                            class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                            <button type="submit" class="btn btn-success w-50">Enviar</button>
                        </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>


        <?php
include 'templates/pie.php';
?>

        
     <script>
  $(window).bind('pageshow', function() { 
        $('#name').val(''); 
        $('#email').val(''); 
        $('#msg').val(''); 
    }); </script>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
    
