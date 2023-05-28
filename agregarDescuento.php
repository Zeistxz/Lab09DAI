<?php include 'info/header.php' ?>

<?php
include_once "conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from vehiculos where id = ?;");
$sentencia->execute([$codigo]);
$vehiculo = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_descuento = $bd->prepare("select * from descuentos where id_vehiculo = ?;");
$sentencia_descuento->execute([$codigo]);
$descuento = $sentencia_descuento->fetchAll(PDO::FETCH_OBJ); 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card text-white bg-dark">
                <div class="card-header">
                    Ingresar datos para Descuento : <br><?php echo $vehiculo->modelo.' '.$vehiculo->telefono.' '.$vehiculo->placa; ?>
                </div>
                <form class="p-4" method="POST" action="registrarDescuento.php">
                    <div class="mb-3">
                        <label class="form-label">Descuento: </label>
                        <input type="text" class="form-control" name="txtDescuento" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duración del Descuento: </label>
                        <input type="text" class="form-control" name="txtDuracion" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $vehiculo->id; ?>"><P></P>
                        <input type="submit" class="btn btn-primary" value="Agregar Descuento">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card text-white bg-dark">
                <div class="card-header">
                    Lista de Descuentos
                </div>
                <div class="col-12">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Duracion</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($descuento as $dsc) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dsc->id; ?></td>
                                    <td><?php echo $dsc->descuento; ?></td>
                                    <td><?php echo $dsc->duracion; ?></td>
                                    <td><a class="text-primary" href="enviarDescuento.php?codigo=<?php echo $dsc->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                    <td><a class="text-white" href="enviarCupon.php?codigo=<?php echo $dsc->id; ?>"><i class="bi bi-images"></i></a></td>
                                    <td><a onclick="return confirm('Está seguro de eliminar?');" class="text-danger" href="eliminarDescuento.php?codigo=<?php echo $dsc->id; ?>"><i class="bi bi-trash"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
