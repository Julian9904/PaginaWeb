<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
<h3>Lista del carrito</h3>

<?php if (!empty($_SESSION['CARRITO']))  {?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th widht="40%">Descripción</th>
            <th widht="15%" class="text-center">Cantidad</th>
            <th widht="20%" class="text-center">Precios</th>
            <th widht="20%" class="text-center">Total</th>
            <th widht="5%">--</th>
        </tr>
        <?php $total=0;?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto) {?>
        <tr>
            <td widht="40%"><?php echo $producto['NOMBRE'];?></td>
            <td widht="15%" class="text-center"><?php echo $producto['CANTIDAD'];?></td>
            <td widht="20%" class="text-center">$<?php echo $producto['PRECIO'];?></td>
            <td widht="20%" class="text-center">$<?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],0);?></td>
            <td widht="5%">
                
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">

            <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button> </td>

            </form>
            
        </tr>
        <?php  $total=$total+($producto['PRECIO']*$producto['CANTIDAD']); }?>
        <tr>
            <td colspan="3" align="rigth"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format($total,0) ;?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <form action="pagar.php" method="post">
                <div class="alert alert-sucess" role="alert">
                    <div class="form-group">
                    <label for="my-input">Nombre: </label>
                    <input id="nombre" name="nombre" Class="form-control" type="text" required>
                    <label for="my-input">Apellidos: </label>
                    <input id="apellidos" name="apellidos" Class="form-control" type="text" required>
                    <label for="my-input">Cedula: </label>
                    <input id="cedula" name="cedula" Class="form-control" type="text" required>
                    <label for="my-input">Celular: </label>
                    <input id="celular" name="celular" Class="form-control" type="text" required>
                    <label for="my-input">Correo de contacto: </label>
                    <input id="email" name="email" Class="form-control" type="email" required>
                    <label for="my-input">Dirección: </label>
                    <input id="direccion" name="direccion" Class="form-control" type="text" required>
                    </div>
                <small id="emailHelp" class="form-text text muted"> Los productos se enviarán a esta direccion</small>
                </div>
                <button class="btn btn-primary ntn-lg btn-block" type="submit" name="btnAccion" value="proceder">Proceder a pagar</button>
                
                </form>

            </td>

        </tr>
    </tbody>
</table>
<?php }else{?>
<div class="alert alert-sucess" role="alert">
    No hay productos en el carrito
</div>

    <?php }?>

<?php
include 'templates/pie.php';
?>