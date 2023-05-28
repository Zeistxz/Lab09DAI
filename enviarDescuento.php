<?php
if (!isset($_GET['codigo'])) {
    header('Location: afterlog.php?mensaje=error');
    exit();
}
include 'conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT dsc.descuento, dsc.duracion , dsc.id_vehiculo, veh.marca, veh.modelo, veh.telefono,veh.fecha_ingreso ,veh.placa
  FROM descuentos dsc
  INNER JOIN vehiculos veh ON veh.id = dsc.id_vehiculo
  WHERE dsc.id = ?");
$sentencia->execute([$codigo]);
$vehiculo = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101816192/SendMessage/43ef54db231444f58acb4d675714627fbfb356b4fa0245a383';
    $data = [
        "chatId" => "51".$vehiculo->telefono."@c.us",
        "message" =>  'Estimado(a) Señor del vehiculo *'.strtoupper($vehiculo->marca).' '.strtoupper($vehiculo->modelo).'* de placa: *'.strtoupper($vehiculo->placa).'*; Por ser un cliente regular, no se pierda el descuento del: *'.strtoupper($vehiculo->descuento).'*, válido solo *'.$vehiculo->duracion.'*',
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: afterlog.php?');
?> 
