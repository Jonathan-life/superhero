<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte</title>
</head>
<body>
  
  <!-- Estilos CSS -->
  <?= $estilos ?>

  <div class="text-center mb-1">
    <h2>Reporte de ventas</h2>
    <h3>Área <?= $area ?></h3>
  </div>

  <table class="table mb-2">
    <colgroup>
      <col style="width: 10%;">
      <col style="width: 60%;">
      <col style="width: 30%;">
    </colgroup>
    <thead>
      <tr class="bg-primary text-light">
        <th>#</th>
        <th>Producto</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($productos as $producto): ?>
      <tr>
        <td><?= $producto['id'] ?></td>
        <td><?= $producto['descripcion'] ?></td>
        <td><?= $producto['precio'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <strong><?= $autor ?></strong>

</body>
</html>