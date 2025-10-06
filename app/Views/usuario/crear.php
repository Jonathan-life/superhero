<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro de Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card shadow-lg rounded-3">
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <h3 class="mb-0">Registro de Usuario</h3>
              <small class="text-muted">Crea tu cuenta en el sistema</small>
            </div>

            <!-- Mensajes de error -->
            <?php if(session()->getFlashdata('error')): ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>

            <!-- Mensajes de éxito -->
            <?php if(session()->getFlashdata('msg')): ?>
              <div class="alert alert-success">
                <?= session()->getFlashdata('msg') ?>
              </div>
            <?php endif; ?>

            <!-- Formulario con clases Bootstrap -->
            <form action="<?= base_url('/usuario/crear') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
              <?= csrf_field() ?>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                <label for="nombre">Nombre</label>
              </div>

              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                <label for="email">Correo electrónico</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                <label for="password">Contraseña</label>
              </div>

              <div class="mb-3">
                <label for="avatar" class="form-label">Avatar (opcional)</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                <div class="form-text">Si no subes un avatar, se usará el predeterminado.</div>
              </div>

              <div class="d-flex justify-content-between">
                <a href="<?= base_url('/login') ?>" class="btn btn-outline-secondary">Volver al Login</a>
                <button type="submit" class="btn btn-success">Registrar</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

