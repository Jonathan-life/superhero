<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Acceso al sistema</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row">
    <div class="col-md-5 mx-auto">
      <div class="card shadow-lg rounded-3">
        <div class="card-body p-4">
          <h3 class="mb-4 text-center">Acceso al sistema</h3>

          <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>
          <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
          <?php endif; ?>

          <form action="<?= base_url('/login') ?>" method="post">
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="email" required>
              <label>Email</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" name="password" required>
              <label>Contraseña</label>
            </div>

            <!-- Checkbox Recordar -->
            <div class="form-check form-switch mb-3">
              <input type="checkbox" class="form-check-input" name="recordar" id="recordar">
              <label class="form-check-label" for="recordar">Recordar</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            <a href="<?= base_url('/usuario/crear') ?>" class="btn btn-outline-secondary w-100 mt-2">Crear Usuario</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
