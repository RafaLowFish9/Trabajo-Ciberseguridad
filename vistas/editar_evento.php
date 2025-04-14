<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.php');
session_start();

$con = conex();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['ID_usuario'])) {
    die("Error: No has iniciado sesión.");
}

// Obtener el ID del usuario desde la sesión
$usuario = $_SESSION['ID_usuario'];

// Obtener y validar los datos del formulario
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$lugar = filter_input(INPUT_POST, 'lugar', FILTER_SANITIZE_SPECIAL_CHARS);
$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_SPECIAL_CHARS);
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
$fecha_creacion = filter_input(INPUT_POST, 'fecha_creacion', FILTER_SANITIZE_SPECIAL_CHARS);

// Depuración: Verificar los valores recibidos
var_dump($_POST);

// Verificar que todos los campos estén completos
if (empty($id) || empty($nombre) || empty($lugar) || empty($fecha) || empty($descripcion) || empty($fecha_creacion)) {
    die("Error: Todos los campos son obligatorios. Fecha creación: " . $fecha_creacion);
}

// Validar el formato de las fechas
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
    die("Error: El formato de la fecha principal no es válido.");
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_creacion)) {
    die("Error: El formato de la fecha de creación no es válido: " . $fecha_creacion);
}

// Actualizar el evento en la base de datos
$sql = "UPDATE eventos SET Nombre = ?, Lugar = ?, Fecha = ?, Descripcion = ?, Fecha_creacion = ? 
        WHERE ID = ? AND ID_usuario = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $con->error);
}

// Cambiado el tercer 'i' por 's' para fecha_creacion
$stmt->bind_param("sssssii", $nombre, $lugar, $fecha, $descripcion, $fecha_creacion, $id, $usuario);

if ($stmt->execute()) {
    header("Location: eventos.php");
    exit;
} else {
    die("Error al actualizar el evento: " . $stmt->error);
}

$stmt->close();
$con->close();
?>