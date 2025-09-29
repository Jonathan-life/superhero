<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte por Género</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Generar Reporte por Género</h2>
  
  <form action="<?= base_url('reportes/getReportByGender') ?>" method="post" target="_blank" class="row g-3">

    <div class="col-md-6">
      <label for="gender_id" class="form-label">Seleccione Género:</label>
      <select name="gender_id" id="gender_id" class="form-select" required>
        <option value="">-- Seleccione --</option>
        <?php foreach ($genders as $g): ?>
          <option value="<?= esc($g['id']) ?>"><?= esc($g['gender']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-6">
      <label for="limit" class="form-label">Cantidad de personajes:</label>
      <input type="number" name="limit" id="limit" class="form-control" min="10" max="200" value="10">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Generar PDF</button>
    </div>
  </form>
</div>
</body>
</html>
