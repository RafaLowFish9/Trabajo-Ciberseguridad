<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>



<?php
// Incluir el archivo de conexión
require_once 'conex.php';

// Obtener la conexión
$conn = conex();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $repetir_password = filter_input(INPUT_POST, 'repetir-password', FILTER_SANITIZE_STRING);

    // Verificar que las contraseñas coincidan
    if ($password !== $repetir_password) {
        die("Las contraseñas no coinciden.");
    }

    // Verificar si el correo ya existe
    $sql_check = "SELECT ID_usuario FROM Usuario WHERE Correo = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        die("El correo ya está registrado. Por favor, utiliza otro.");
    }
    $stmt_check->close();

    // Encriptar la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Usuario (Nombre, Contrase_a, Correo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $password_hash, $email);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
        header("Location: login.php"); // Redirigir al login después del registro
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>