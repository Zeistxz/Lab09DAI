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

    $url = 'https://api.green-api.com/waInstance1101816192/sendFileByUpload/43ef54db231444f58acb4d675714627fbfb356b4fa0245a383';
    $data = [
        "chatId" => "51".$vehiculo->telefono."@c.us",
        "caption" => "> Cupón válido por un estacionamiento libre (1 día), deberá presentarlo al momento de ingresar."
    ];
    $files = array(
        'file' => new CURLFile('./css/img/disc.png', 'image/png', 'disc.png')
        );
    $headers = array(
    );
        
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array_merge($data, $files));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    header('Location: afterlog.php?');
?> 
