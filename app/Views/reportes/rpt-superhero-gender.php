<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte por Género</title>
  <?= $estilos ?>
</head>
<body>
  <h2>Reporte de Superhéroes por Género</h2>
  <table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre Superhéroe</th>
        <th>Nombre Completo</th>
        <th>Género</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
      <tr>
        <td><?= esc($row['id']) ?></td>
        <td><?= esc($row['superhero_name']) ?></td>
        <td><?= esc($row['full_name']) ?></td>
        <td><?= esc($row['gender']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
