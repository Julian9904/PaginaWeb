<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    
    <style>
        #footer {
            background-color: #1a1a1a;
            padding: 40px 0 10px;
            text-align: center;
            color: #fff;
        }

        #footer a {
            color: #fff;
        }

        #footer a:hover {
            color: #f8f8f8;
            text-decoration: none;
        }

        #footer .list-inline .list-inline-item {
            padding: 10px 15px;
        }

        ul {
            list-style: none;
        }

        nav li a{
            background-color: #f8f8f8;
            text-decoration: none;
        }

        nav > li{
            float: left;
        }

        nav li ul{
            display:none;
            position:absolute;
            min-width: 140px;
        }

        nav li:hover > ul{
            display:block;
        }

    </style>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand">Logo de la empresa</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#categorias">Categorias </a>
                    <ul>
                        <li><a href="cama.php">Cama</a></li>
                        <li><a href="sala.php">Sala</a></li>
                        <li><a href="silla.php">Silla</a></li>
                        <li><a href="sofat.php">Sofat</a></li>
                        <li><a href="sofacama.php">Sofa cama</a></li>
                        <li><a href="productos.php">Todos los productos</a></li>
                    </ul>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="mostrarCarrito.php"><i class="fas fa-shopping-cart"></i> (<?php 
                        echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="mostrarCarrito.php">Contacto</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </nav>

    <!-- <br> -->
    <br>
    <div class="container">
