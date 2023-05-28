 <!-- Conexion principal de la pagina principal hacia la base de datos -->
<?php 
$contrasena = "AVNS_kKSkflCp2xGgajXHnqB";
$usuario = "doadmin";
$nombre_bd = "park";
$host= "db-mysql-nyc1-28475-do-user-14089120-0.b.db.ondigitalocean.com";
$port= 25060;
$sslmode= "REQUIRED";

try {
	$bd = new PDO (
		"mysql:host=$host;
		port=$port;
		dbname=$nombre_bd;
		sslmode=$sslmode",
		$usuario,
		$contrasena,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>