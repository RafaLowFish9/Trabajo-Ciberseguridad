
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="iniciosesion.css">
    <title>Registro</title>
</head>
<body>
<section class="iniciarsesion">
        <div class="formulario-content">
            <div class="imgform">
                <a href="index.html">
                    <img src="img/logo Acreditaci¢n Institucional (1).png" alt="">
                </a>
            </div>
            <form id="registro-form">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="namehelp" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Ingresa tu correo electrónico</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="repetir-password" class="form-label">Repetir Contraseña</label>
                    <input type="password" class="form-control" id="repetir-password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="politicas" required>
                    <label class="form-check-label" for="politicas">Acepto las políticas de privacidad</label>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>