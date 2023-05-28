<?php include 'info/header.php' ?>
 <!-- Conexion con la base de datos para la obtencion para la posterior edicion -->
<?php
    if(!isset($_GET["codigo"])){
        header('Location: afterlog.php?mensaje=error');
        exit();
    }

    include_once 'conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from vehiculos where id = ?;");
    $sentencia->execute([$codigo]);
    $vehiculo = $sentencia->fetch(PDO::FETCH_OBJ);
?>

 <!-- Pagina de edicion, luego de haber obtenido los datos del elemento a editar -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombres: </label>
                        <input type="text" class="form-control" name="marca" required 
                        value="<?php echo $vehiculo->marca; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modelo: </label>
                        <input type="text" class="form-control" name="modelo" autofocus required
                        value="<?php echo $vehiculo->modelo; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono: </label>
                        <input type="text" class="form-control" name="telefono" autofocus required
                        value="<?php echo $vehiculo->telefono; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Ingreso: </label>
                        <input type="date" class="form-control" name="fecha_ingreso" autofocus required
                        value="<?php echo $vehiculo->fecha_ingreso; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Placa: </label>
                        <input type="text" class="form-control" name="placa" autofocus required
                        value="<?php echo $vehiculo->placa; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $vehiculo->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
