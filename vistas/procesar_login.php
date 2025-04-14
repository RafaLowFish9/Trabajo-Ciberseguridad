<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión
require_once 'conex.php';

// Obtener la conexión
$conn = conex();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Verificar si se aceptaron las políticas
    if (!isset($_POST['politicas'])) {
        die("Debes aceptar las políticas de privacidad.");
    }

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT ID_usuario, Contrase_a FROM usuario WHERE Correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $hashed_password);
        $stmt->fetch();

        // Depuración: Imprime los valores (solo para pruebas, elimina esto en producción)
        echo "Contraseña ingresada: " . $password . "<br>";
        echo "Hash almacenado: " . $hashed_password . "<br>";

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Guardar el ID del usuario en la sesión
            $_SESSION['ID_usuario'] = $id_usuario;
            $_SESSION['email'] = $email;

            // Redirigir al usuario a la página de eventos
            header("Location: eventos.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró una cuenta con ese correo.";
    }

    $stmt->close();
}

$conn->close();
?>