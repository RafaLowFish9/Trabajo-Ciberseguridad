<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.php');
session_start(); // Inicia la sesión para acceder al ID del usuario

$con = conex();

if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['ID_usuario'])) {
    die("Error: No has iniciado sesión.");
}

// Obtener el ID del usuario desde la sesión
$usuario = $_SESSION['ID_usuario'];

// Obtener y validar los datos del formulario
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$lugar = filter_input(INPUT_POST, 'lugar', FILTER_SANITIZE_STRING);
$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
$fecha_creacion = filter_input(INPUT_POST, 'fecha_creacion', FILTER_SANITIZE_STRING);

// Verificar que todos los campos estén completos
if (empty($nombre) || empty($lugar) || empty($fecha) || empty($descripcion) || empty($fecha_creacion)) {
    die("Error: Todos los campos son obligatorios.");
}

// Insertar el evento en la base de datos usando consultas preparadas
$sql = "INSERT INTO eventos (ID_usuario, Nombre, Lugar, Fecha, Descripcion, Fecha_creacion) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $con->error);
}

$stmt->bind_param("isssss", $usuario, $nombre, $lugar, $fecha, $descripcion, $fecha_creacion);

if ($stmt->execute()) {
    // Redirigir al usuario después de insertar el evento
    header("Location: eventos.php");
    exit;
} else {
    die("Error al insertar el evento: " . $stmt->error);
}

$stmt->close();
$con->close();
?>