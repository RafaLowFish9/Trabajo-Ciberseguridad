<!DOCTYPE html>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.php');
$con = conex();

if ($con->connect_error) {
    printf("Error");
    die("Error de conexión: " . $con->connect_error);
}


$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$lugar = $_POST['lugar'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$fecha_creacion = $_POST['fecha_creacion'];

$sql = "INSERT INTO eventos (Usuario, Nombre, Lugar, Fecha, Descripcion, Fecha_creacion) 
VALUES('$usuario', '$nombre', '$lugar', '$fecha', '$descripcion', '$fecha_creacion')";

//print_r($_POST);

$query = mysqli_query($con, $sql);

if($query) {
    Header("Location: index.php");
    exit;
} else {
    die("Error en la consulta: " . mysqli_error($con));
};

?>