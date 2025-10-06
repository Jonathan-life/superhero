<h1>Bienvenido <?= esc($usuario_nombre) ?></h1>
<p>Email: <?= esc($usuario_email) ?></p>
<img src="<?= base_url('uploads/' . $avatar) ?>" alt="Avatar">
<a href="<?= base_url('logout') ?>">Cerrar sesión</a>
