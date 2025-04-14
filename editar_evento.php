<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.php');
$con = conex();

$id = $_POST['id'];
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$lugar = $_POST['lugar'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];
$fecha_creacion = $_POST['fecha_creacion'];

$sql = "UPDATE eventos SET Usuario = '$usuario', Nombre = '$nombre', Lugar = '$lugar', Fecha = '$fecha', Descripcion = '$descripcion', Fecha_creacion = '$fecha_creacion'
 WHERE ID = '$id'"; 


//print_r($_POST);

$query = mysqli_query($con, $sql);

if($query) {
    Header("Location: index.php");
    exit;
} else {
    die("Error en la consulta: " . mysqli_error($con));
};

?>