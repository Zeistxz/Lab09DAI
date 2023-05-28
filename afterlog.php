 <!-- Pagina principal, donde esta la tabla, registro, etc-->
<?php include 'info/header.php' ?>

 <!-- Conexion query a la base de datos -->
<?php
    include_once "conexion.php";
    $sentencia = $bd -> query("select * from vehiculos");
    
    $vehiculo = $sentencia->fetchAll(PDO::FETCH_OBJ);
    ?>
 <!-- Campo de registro -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Ingresar datos:
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Marca: </label>
                        <input type="text" class="form-control" name="marca" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modelo: </label>
                        <input type="text" class="form-control" name="modelo" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefono: </label>
                        <input type="text" class="form-control" name="telefono" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Ingreso: </label>
                        <input type="date" class="form-control" name="fecha_ingreso" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Placa: </label>
                        <input type="text" class="form-control" name="placa" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
            <br>

        <div class="col-md-30">
            <!-- Campos para alertas -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se registró correctamente el vehículo.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- Campo tabla, obtencion de datos de la base de datos-->
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    Lista de vehículos
                </div>
                <div class="py-9">
                    <table class="table align-middle text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">F.Ingreso</th>
                                <th scope="col">Placa</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($vehiculo as $car){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $car->id; ?></td>
                                <td><?php echo $car->marca; ?></td>
                                <td><?php echo $car->modelo; ?></td>
                                <td><?php echo $car->telefono; ?></td> 
                                <td><?php echo $car->fecha_ingreso; ?></td>
                                <td><?php echo $car->placa; ?></td>
                                <td><a class="text-blue" href="editar.php?codigo=<?php echo $car->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a class="text-success" href="agregarDescuento.php?codigo=<?php echo $car->id; ?>"><i class="bi bi-percent"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $car->id; ?>"><i class="bi bi-trash"></i></a></td>
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
</div>
