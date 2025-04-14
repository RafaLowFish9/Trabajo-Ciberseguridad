<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.php');
$con = conex();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar que el ID sea válido antes de hacer la consulta
if ($id <= 0) {
    die("ID inválido.");
}

$sql = "DELETE FROM eventos WHERE ID = '$id'";
$query = mysqli_query($con, $sql);

if($query) {
    Header("Location: index.php");
    exit;
} else {
    die("Error en la consulta: " . mysqli_error($con));
};


?>