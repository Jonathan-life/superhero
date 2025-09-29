<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Promedio de Peso por Publisher</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-4">
  <h2 class="mb-3">Promedio de Peso por Publisher</h2>

  <canvas id="pesoChart" height="120"></canvas>

  <div class="mt-4">
    <button id="verPromedios" class="btn btn-primary">Mostrar promedios de peso</button>
  </div>
</div>

<script>
const ctx = document.getElementById("pesoChart").getContext("2d");
let grafico = null;
let dataGlobal = [];

document.addEventListener("DOMContentLoaded", async () => {
    try {
        
        const response = await fetch("<?= site_url('dashboard/getDataPublisherWeights') ?>", { method: "POST" });
        const result = await response.json();

        if (!result.success) {
            alert(result.message);
            return;
        }

        // Guardamos datos globalmente
        dataGlobal = result.data.filter(r => r.publisher_name && r.publisher_name.trim() !== '');
        // Ordenar por promedio ascendente
        dataGlobal.sort((a,b) => parseFloat(a.promedio_peso) - parseFloat(b.promedio_peso));

    } catch(err) {
        console.error(err);
        alert("Error al cargar los datos");
    }
});


document.getElementById("verPromedios").addEventListener("click", () => {
    if (dataGlobal.length === 0) {
        alert("No hay datos para mostrar.");
        return;
    }

    const labels = dataGlobal.map(r => r.publisher_name);
    const valores = dataGlobal.map(r => parseFloat(r.promedio_peso));
    const colores = dataGlobal.map(() => `rgba(${Math.floor(Math.random()*255)}, ${Math.floor(Math.random()*255)}, 200, 0.7)`);

    if (grafico) grafico.destroy();

    grafico = new Chart(ctx, {
        type: 'line', 
        data: {
            labels,
            datasets: [{
                label: 'Peso promedio (kg)',
                data: valores,
                borderColor: 'rgba(54, 162, 235, 0.8)',
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                fill: true,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: { display: true, text: 'Promedio de peso por editorial' },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Peso (kg)' }
                },
                x: {
                    title: { display: true, text: 'Editorial' }
                }
            }
        }
    });
});
</script>
</body>
</html>
