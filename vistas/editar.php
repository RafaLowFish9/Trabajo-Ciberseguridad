<!DOCTYPE html>

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

$sql = "SELECT * FROM eventos WHERE ID = '$id'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

if (!$row) {
    die("No se encontró el evento.");
}

// Verificar si Fecha_creacion es '0000-00-00' y reemplazarla con una cadena vacía
$fecha_creacion = ($row['Fecha_creacion'] === '0000-00-00') ? '' : $row['Fecha_creacion'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar evento</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
   <form action="editar_evento.php" method="POST">
        <h1>Editar evento</h1>
        <input type="hidden" name="id" value="<?= $row['ID'] ?>">
        <input type="text" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($row['Nombre']) ?>" required>
        <input type="text" name="lugar" placeholder="Lugar" value="<?= htmlspecialchars($row['Lugar']) ?>" required>
        <input type="date" name="fecha" placeholder="Fecha" value="<?= $row['Fecha'] ?>" required>
        <textarea name="descripcion" placeholder="Descripción" required><?= htmlspecialchars($row['Descripcion']) ?></textarea>
        <input type="date" name="fecha_creacion" placeholder="Fecha de creación" value="<?= $row['Fecha_creacion'] ?>" required>

        <input type="submit" value="Actualizar evento" class="guardar">
   </form>    
</body>
</html>

