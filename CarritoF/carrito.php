<?php
session_start();
$mensaje="";


if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){

        case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
            }else{
                $mensaje.="Ups..ID Incorrecto".$ID;
                break;
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
            }else{
                $mensaje.="Ups..nombre Incorrecto".$NOMBRE;
                break;
            }
            if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
            }else{
                $mensaje.="Ups..precio Incorrecto".$PRECIO;
                break;
            }
            if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
            }else{
                $mensaje.="Ups..cantidad Incorrecto".$CANTIDAD;
                break;
            }

        if(!isset($_SESSION['CARRITO'])){
            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO
            );
            $_SESSION['CARRITO'][0]=$producto;
            $mensaje="Producto agregado al carrito";
        }else{
            $idProductos=array_column($_SESSION['CARRITO'],"ID");
            if(in_array($ID,$idProductos)){
                echo "<script>alert('El producto ya ha sido selecionado...')</script>";
            }else{
            $NumeroProductos=count($_SESSION['CARRITO']);
            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO
            );
            $_SESSION['CARRITO'][$NumeroProductos]=$producto;
            $mensaje="Producto agregado al carrito";
            }
        }
        break;
        case "Eliminar":
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                    if($producto['ID']==$ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado')</script>";                        
                    }
                }
            }else{
                $mensaje.="Ups..ID Incorrecto".$ID;
                break;
            }
        break;

    }
}


?>