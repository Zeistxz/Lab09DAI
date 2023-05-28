 <!-- Verificacion de los datos, antes de registrar el dato a la base de datos -->
<?php
if (empty($_POST["oculto"]) || empty($_POST["marca"]) || empty($_POST["modelo"]) || empty($_POST["telefono"]) || empty($_POST["fecha_ingreso"]) || empty($_POST["placa"])) {
    header('Location: afterlog.php?mensaje=falta');
    exit();
}

include_once 'conexion.php';
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$telefono = $_POST["telefono"];
$fecha_ingreso = $_POST["fecha_ingreso"];
$placa = $_POST["placa"];

$sentencia = $bd->prepare("INSERT INTO vehiculos(marca,modelo,telefono,fecha_ingreso,placa) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$marca, $modelo,$telefono,$fecha_ingreso, $placa]);

if ($resultado === TRUE) {
    header('Location: afterlog.php?mensaje=registrado');
} else {
    header('Location: afterlog.php?mensaje=error');
    exit();
}

