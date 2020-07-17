<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera-ppal.php';

?>
<?php
            $sentencia=$pdo->prepare("SELECT * FROM `tblproducots`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

        
        ?>
<br><br>
<div class="row bg-light">
<?php foreach($listaProductos as $producto){ ?>
    <?php if($producto['categoria']==2){ ?>
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



<br><br>

<?php
include 'templates/pie.php';
?>