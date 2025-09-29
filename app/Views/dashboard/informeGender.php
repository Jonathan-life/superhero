<?php helper('url'); ?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informeh7 1</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


  </head>

  <body>
    <div class="container">
      <h1 class="mt-4">Gráfico de Alineación de Superhéroes</h1>
      
      <!-- Botón para obtener datos -->
      <button class="btn btn-primary my-3" id="obteener-datos">Obtener Datos</button>

      <!-- Canvases para gráficos -->
      <canvas id="lienzo"></canvas>
      <hr>
      <canvas id="otro-lienzo"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>

    <script>
  const lienzo = document.getElementById("lienzo");
  const btnDatos = document.getElementById("obteener-datos");
  let grafico = null;

  function renderGraphyc() {
    grafico = new Chart(lienzo, {
      type: 'bar',
      data: {
        labels: [],
        datasets: [{
          label: '',
          data: [],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(153, 102, 255, 0.2)'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  btnDatos.addEventListener("click", async () => {
    try {
      const response = await fetch('<?= base_url('public/api/getDataInformeGender') ?>');

      if (!response.ok) {
        throw new Error('No se pudo conectar al servidor');
      }

      const data = await response.json();

      if (data.success) {
        // Cambiamos alignment -> gender
        grafico.data.labels = data.resumen.map(row => row.gender);
        grafico.data.datasets[0].data = data.resumen.map(row => row.total_heroes);
        grafico.data.datasets[0].label = data.message;
        grafico.update();
      } else {
        alert("No se encontraron datos.");
      }
    } catch (error) {
      console.error('Error:', error);
      alert("Ocurrió un error al obtener los datos.");
    }
  });


  renderGraphyc();
</script>

  </body>
</html>
