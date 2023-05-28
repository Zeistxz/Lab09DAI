 <!-- Conexion para la edicion de los datos -->
<?php
    print_r($_POST);
    if(!isset($_POST["codigo"])){
        header('location: afterlog.php?mensaje=error');
    }

    include_once 'conexion.php';
    $codigo=$_POST["codigo"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $telefono = $_POST["telefono"];
    $fecha_ingreso = $_POST["fecha_ingreso"];
    $placa = $_POST["placa"];
    

    $sentencia = $bd->prepare("UPDATE vehiculos SET marca = ?, modelo = ?,telefono =?,fecha_ingreso = ?,placa = ? WHERE id = ?;");
    $resultado = $sentencia->execute([$marca,$modelo,$telefono,$fecha_ingreso,$placa,$codigo]);

    if ($resultado === TRUE) {
        header('Location: afterlog.php?mensaje=editado');
    } else {
        header('Location: afterlog.php?mensaje=error');
        exit();
    }
