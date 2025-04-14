<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/iniciosesion.css">
    <title>Iniciar sesión</title>
</head>
<body>
<section class="iniciarsesion">
    <div class="formulario-content">
        <div class="imgform">
            <a href="index.html">
                <img src="../img/de.png" alt="">
            </a>
        </div>
        <form id="login-form" action="procesar_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Ingresa tu correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Ingresa tu contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="politicas" name="politicas" required>
                <label class="form-check-label" for="politicas">Acepto las políticas de privacidad</label>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
        <div class="text-center mt-3">
            <!-- Contenedor para el botón de Google -->
            <div id="googleSignInDiv"></div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>