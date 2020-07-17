<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera-ppal.php';

?>
<br><br>
 <style>
        #map{
           height: 400px;
            width: 100%;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

        <br>
        <?php if($mensaje!=""){?>
        <div class="alert alert-sucess">
            <?php echo $mensaje; ?>

            <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
        </div>
        <?php }?>
        <div class="row bg-light">

        <?php
            $sentencia=$pdo->prepare("SELECT * FROM `tblproducots`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        
        ?>

        <div class="row">
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
            <div class="col-lg-6">
            <img
                 class="card-img-top w-100" src="archivos/prevencion.png" alt="Titulo" height="360px">
            </div>
             
        <div class="row bg-light">
        <?php foreach($listaProductos as $producto){ ?>
            <?php if($producto['categoria']==1){ ?>
            <div class="col-lg-3">
                <div class="card">
                <div class="card-head"> 
                        <img
                        
                        class="card-img-top w-100" src="<?php echo $producto['Imagen'];?>" alt="Titulo" height="200px">
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
        <?php } ?>
        </div>
        </div>

       
        </div>
    

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
             
             <!-- Ubicación -->
            <div class="col-lg-6">
                <div id='map'></div>
                <script type="text/javascript">
                    var map=L.map('map').setView([6.234270,-75.572955], 11);
                    L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=3TlKatxZhaWucjV8rAKW',{attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'}).addTo(map);
                    
                    var Latitud;
                    var Longitud;  

                navigator.geolocation.getCurrentPosition(function(position) {
                    Latitud =  position.coords.latitude;
                    Longitud = position.coords.longitude;
                
                    marker_actual = L.marker([Latitud,Longitud]).addTo(map);
                    marker_actual.bindPopup('<b>Hola </b><br>Tú estas aqui').openPopup();
                    map.setView([Latitud,Longitud], 12);  
                    
                    console.log(Latitud);
                    console.log(Longitud);
                    }, function(err) {
                        console.error(err);
                    });
                    var lat=6.177531;
                    var lon=-75.609892;
                    var marker1 = L.marker([lat,lon],{
                                color: 'red',
                                }).addTo(map);
                    var polig = L.polygon([
                                [lat+0.004,lon-0.004],
                                [lat+0.004,lon+0.004],
                                [lat-0.004,lon],
                                ]).addTo(map);
                    marker1.on('mouseover', function(e) {
                    //open popup;
                    var popup = L.popup()
                    .setLatLng(e.latlng) 
                    .setContent('<img  src="archivos/local.png" height="150px" width="150px">')
                    .openOn(map);
                    });
                </script>
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
    <br><br>

        <?php
include 'templates/pie.php';
?>

        
    

    

    
