<!DOCTYPE html>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
 include('conex.php');

 $con = conex();

 $sql = "SELECT * FROM eventos";
 $query = mysqli_query($con, $sql);
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
  <form action="insertar_evento.php" method = "POST">
        <h1>Gestión de eventos</h1>

        <input type="hidden" name = "id">
        <input type="text" name = "usuario" placeholder = "Encargado">
        <input type="text" name = "nombre" placeholder = "Nombre evento">
        <input type="text" name = "lugar" placeholder = "Lugar">
        <input type="date" name = "fecha" placeholder = "Fecha">
        <textarea  name = "descripcion" placeholder = "Descripción"></textarea>
        <input type="date" name = "fecha_creacion">

        <input type="submit" value = "Agregar evento" class = "guardar">
    </form>

    <div>
        <h2>Eventos registrados</h2>
        <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Usuario</th>
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
                <?php while($row = mysqli_fetch_array($query)): ?>
              <tr>
                <th><?= $row['ID'] ?></th>
                <th><?= $row['Usuario'] ?></th>
                <th><?= $row['Nombre'] ?></th>
                <th><?= $row['Lugar'] ?></th>
                <th><?= $row['Fecha'] ?></th>
                <th><?= $row['Descripcion'] ?></th>
                <th><?= $row['Fecha_creacion'] ?></th>

                <th><a class = "editar" href="editar.php?id=<?=$row['ID']?>">Editar</a></th>
                <th><a class = "eliminar" href="eliminar.php?id=<?=$row['ID']?>">Eliminar</a></th> 
              </tr> 
              <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>