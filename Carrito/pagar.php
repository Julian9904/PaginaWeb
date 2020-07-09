<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php 
if($_POST){
    $total=0;
    $SID=session_id();
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $cedula=$_POST['cedula'];
    $celular=$_POST['celular'];
    $direccion=$_POST['direccion'];
    $correo=$_POST['email'];


    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }
    $sentencia=$pdo->prepare("INSERT INTO `tblventas`
     (`ID`, `Nombre`, `Apellidos`, `Cedula`, `Telefono`, `Direccion`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `Status`) 
     VALUES (NULL, :nombre, :apellidos, :cedula, :celular, :direccion, :clavetransaccion, '', NOW(), :correo, :total, 'Pendiente');");
    
    $sentencia->bindParam(":clavetransaccion",$SID);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":apellidos",$apellidos);
    $sentencia->bindParam(":cedula",$cedula);
    $sentencia->bindParam(":celular",$celular);
    $sentencia->bindParam(":direccion",$direccion);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":total",$total);
    
    $sentencia->execute();
    $idVenta=$pdo->lastInsertId();



    foreach($_SESSION['CARRITO'] as $indice=>$producto){

        $sentencia=$pdo->prepare("INSERT INTO `tbldetalleventas` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
        VALUES (NULL, :IDVENTA, :IDPRODUCTO, :IDPRECIOUNITARIO, :CANTIDAD, '0');");

        $sentencia->bindParam(":IDVENTA",$idVenta);
        $sentencia->bindParam(":IDPRODUCTO",$producto['ID']);
        $sentencia->bindParam(":IDPRECIOUNITARIO",$producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
        $sentencia->execute();


    }
   // echo "<h3>".$total."</h3>";
}

?>

<div class="jumbotron text-center">
    <h1 class="display-4">Paso Final</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con paypal la cantidad de: 
        <h4>$<?php echo number_format($total,0);?></h4>
    </p>

<div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total;?>'
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                alert('Transaction completed by ' + details.payer.name.given_name + '!');
            });
        }


    }).render('#paypal-button-container');
</script>
</div>
<?php
include 'templates/pie.php';
?>