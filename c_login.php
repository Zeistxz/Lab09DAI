 <!-- Conexion a la base de datos hacia la pagina del login -->
<?php
if (!empty($_POST["btnlogin"])){
    if (empty($_POST["email"]) and empty($_POST["pass"])){
        #Se cambio el tipo de login, esto es obsoleto pero mejor no lo borramos 
    }
    else{
        $usuario=$_POST["usuario"];
        $pass=$_POST["pass"];
        $sql=$bd->query("SELECT * FROM usuario where usuario='$usuario' AND clave='$pass'" );
        if($datos=$sql->fetch()){
            header("location:afterlog.php");
        } 
        else {
            header("location:login.php");
        }
    }
}
?>