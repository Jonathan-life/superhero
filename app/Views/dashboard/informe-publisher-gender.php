<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte Publisher - Género</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Gráfico de Género por Editorial</h2>

  <form id="formulario" class="mb-3">
    <label class="form-label">Seleccione Editorial(es):</label>
    <div class="row">
      <?php foreach ($publishers as $p): ?>
        <div class="col-md-4 mb-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" 
                   name="publisher_ids[]" 
                   value="<?= esc($p['id']) ?>" 
                   id="publisher_<?= esc($p['id']) ?>">
            <label class="form-check-label" for="publisher_<?= esc($p['id']) ?>">
              <?= esc($p['publisher_name']) ?>
            </label>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Generar Gráfico</button>
    </div>
  </form>

  <canvas id="chartCanvas"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
<script>
const form = document.getElementById('formulario');
const ctx = document.getElementById('chartCanvas');
let grafico = null;

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(form);

  try {
    const response = await fetch("<?= base_url('dashboard/getDataInformePublisherGender') ?>", {
      method: "POST",
      body: formData
    });
    const data = await response.json();

    console.log("Respuesta del servidor:", data); 

    if (data.success) {
      // agrupamos por publisher y gender
      const publishers = [...new Set(data.data.map(r => r.publisher_name))];
      const genders = [...new Set(data.data.map(r => r.gender))];

      const datasets = genders.map(g => {
        return {
          label: g,
          data: publishers.map(pub => {
            const row = data.data.find(r => r.publisher_name === pub && r.gender === g);
            return row ? row.total : 0;
          }),
          backgroundColor: `rgba(${Math.floor(Math.random()*255)}, ${Math.floor(Math.random()*255)}, 200, 0.5)`
        }
      });

      if (grafico) grafico.destroy();

      grafico = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: publishers,
          datasets: datasets
        },
        options: {
          responsive: true,
          plugins: {
            title: {
              display: true,
              text: data.message
            }
          }
        }
      });
    } else {
      alert(data.message);
    }
  } catch (err) {
    console.error(err);
    alert("Error al obtener los datos.");
  }
});
</script>
</body>
</html>

