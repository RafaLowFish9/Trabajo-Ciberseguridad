<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.php');
session_start(); // Inicia la sesión para verificar al usuario autenticado

$con = conex();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['ID_usuario'])) {
    die("Error: No has iniciado sesión.");
}

// Obtener el ID del evento desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar que el ID sea válido antes de hacer la consulta
if ($id <= 0) {
    die("ID inválido.");
}

// Obtener el ID del usuario desde la sesión
$usuario = $_SESSION['ID_usuario'];

// Usar una consulta preparada para evitar inyección SQL
$sql = "DELETE FROM eventos WHERE ID = ? AND ID_usuario = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $con->error);
}

$stmt->bind_param("ii", $id, $usuario);

if ($stmt->execute()) {
    // Redirigir al usuario después de eliminar el evento
    header("Location: eventos.php");
    exit;
} else {
    die("Error al eliminar el evento: " . $stmt->error);
}

$stmt->close();
$con->close();
?>