 <!-- Conexion para la eliminacion de datos -->
<?php 
    if(!isset($_GET['codigo'])){
        header('Location: afterlog.php?mensaje=error');
        exit();
    }

    include 'conexion.php';
    $codigo = $_GET['codigo'];
    
    $sentencia = $bd->prepare("DELETE FROM descuentos where id = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE){
        header('Location: afterlog.php?mensaje=eliminado');
    } else {
        header('Location: afterlog.php?mensaje=error');
    }
?>