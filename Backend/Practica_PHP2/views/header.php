<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo Practico PHP2</title>
    <link rel="stylesheet" href="./public/css/Practica_PHP2.css">
</head>

<body>
    <header>
        <h1>Trabajo Practico PHP2</h1>
<?php 
//si no se inicio sesion entonces que no se muestre la navegacion
    if($_SESSION['ok']){
        print('
        <nav>
            <ul>
                <li><a href="./">Inicio</a></li>
                <li><a href="empresa">Empresa</a></li>
                <li><a href="personas">Personas</a></li>
                <li><a href="empleados">Empleados</a></li>
                <li><a href="contactos">Contactos</a></li>
                <li><a href="usuarios">Usuarios</a></li>
                <li><a href="permisos">Permisos</a></li>
            </ul>
        </nav>');
    }
?>
    </header>
    <main>