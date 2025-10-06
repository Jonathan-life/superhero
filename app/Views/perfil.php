<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 text-center">
    <h2>Bienvenido, <?= esc($usuario_nombre) ?></h2>
    <p>Email: <?= esc($usuario_email) ?></p>

    <div class="my-3">
        <img src="<?= base_url('images/avatars/' . $avatar) ?>" alt="Avatar" class="rounded-circle" width="120" height="120">
    </div>

    <a href="<?= site_url('logout') ?>" class="btn btn-danger">Cerrar sesión</a>
</div>
</body>
</html>

