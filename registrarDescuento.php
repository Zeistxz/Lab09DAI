<?php
if (empty($_POST["txtDescuento"]) || empty($_POST["txtDuracion"])) {
    header('Location: afterlog.php');
    exit();
}

include_once 'conexion.php';
$descuento = $_POST["txtDescuento"];
$duracion = $_POST["txtDuracion"];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO descuentos(descuento,duracion,id_vehiculo) VALUES (?,?,?);");
$resultado = $sentencia->execute([$descuento,$duracion, $codigo ]);

if ($resultado === TRUE) {
    header('Location: agregarDescuento.php?codigo='.$codigo);
} 
