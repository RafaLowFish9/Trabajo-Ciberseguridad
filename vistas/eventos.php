<!DOCTYPE html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conex.php');
session_start(); // Inicia la sesión para acceder al ID del usuario

$con = conex();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['ID_usuario'])) {
    die("Error: No has iniciado sesión.");
}

// Obtener el ID del usuario desde la sesión
$usuario = $_SESSION['ID_usuario'];

// Consultar los eventos del usuario autenticado
$sql = "SELECT * FROM eventos WHERE ID_usuario = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario);
$stmt->execute();
$query = $stmt->get_result();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de eventos</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <!-- Botón para cerrar sesión -->
    <form action="logout.php" method="POST" style="text-align: right; margin: 10px;">
        <button type="submit" class="cerrar-sesion">Cerrar sesión</button>
    </form>
    
    <form action="insertar_evento.php" method="POST">
        <h1>Gestión de eventos</h1>

        <input type="hidden" name="id">
        <input type="text" name="nombre" placeholder="Nombre evento" required>
        <input type="text" name="lugar" placeholder="Lugar" required>
        <input type="date" name="fecha" placeholder="Fecha" required>
        <textarea name="descripcion" placeholder="Descripción" required></textarea>
        <input type="date" name="fecha_creacion" required>

        <input type="submit" value="Agregar evento" class="guardar">
    </form>

    <div>
        <h2>Eventos registrados</h2>
        <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Lugar</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            
            <tbody>
                <?php while ($row = $query->fetch_assoc()): ?>
              <tr>
                <th><?= $row['ID'] ?></th>
                <th><?= $row['Nombre'] ?></th>
                <th><?= $row['Lugar'] ?></th>
                <th><?= $row['Fecha'] ?></th>
                <th><?= $row['Descripcion'] ?></th>
                <th><?= $row['Fecha_creacion'] ?></th>

                <th><a class="editar" href="editar.php?id=<?= $row['ID'] ?>">Editar</a></th>
                <th><a class="eliminar" href="eliminar.php?id=<?= $row['ID'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">Eliminar</a></th>
              </tr> 
              <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>