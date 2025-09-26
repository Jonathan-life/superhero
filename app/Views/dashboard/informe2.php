<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Informe 1</title>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container mt-5">
      <button class="btn btn-outline-primary mb-3" type="button" id="obtener-datos">
        Obtener datos
      </button>
      <canvas id="lienzo" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const lienzo = document.getElementById("lienzo");
        const btnDatos = document.getElementById("obtener-datos");
        let grafico = null;

        // Función para crear gráfico vacío
        function renderGraphic() {
          const backgroundColor = [
            "rgba(46, 204, 113, 0.5)",
            "rgba(52, 152, 219, 0.5)",
            "rgba(26, 188, 156, 0.5)",
            "rgba(230, 126, 34, 0.5)",
            "rgba(211, 84, 0, 0.5)",
          ];

          const borderColor = [
            "rgba(46, 204, 113, 1.0)",
            "rgba(52, 152, 219, 1.0)",
            "rgba(26, 188, 156, 1.0)",
            "rgba(230, 126, 34, 1.0)",
            "rgba(211, 84, 0, 1.0)",
          ];

          const borderWidth = 2;

          grafico = new Chart(lienzo, {
            type: "bar",
            data: {
              labels: [],
              datasets: [
                {
                  label: "Popularidad de superhéroes",
                  data: [],
                  backgroundColor: backgroundColor,
                  borderColor: borderColor,
                  borderWidth: borderWidth,
                },
              ],
            },
            options: {
              responsive: true,
              scales: {
                y: {
                  beginAtZero: true,
                },
              },
            },
          });
        }

        // Función para obtener datos y actualizar gráfico
        btnDatos.addEventListener("click", async () => {
          try {
            const response = await fetch(
              "http://superhero.test/public/api/getdatainforme2",
              { method: "GET" }
            );

            if (!response.ok) {
              throw new Error("No se pudo lograr la comunicación con la API.");
            }

            const data = await response.json();

            if (data.success) {
              console.log(data.resumen.map((row) => row.superhero));
              console.log(data.resumen.map((row) => row.popularidad));

              grafico.data.labels = data.resumen.map((row) => row.superhero);
              grafico.data.datasets[0].data = data.resumen.map(
                (row) => row.popularidad
              );

              grafico.update();
            }
          } catch (error) {
            console.error("Error al obtener datos:", error);
          }
        });

        // Inicializar gráfico vacío
        renderGraphic();

        // Ejemplo de manejo de datos con array amigos
        const amigos = [
          { nombre: "luis", edad: 25, ciudad: "Lima" },
          { nombre: "juan", edad: 32, ciudad: "Ica" },
          { nombre: "pedro", edad: 20, ciudad: "Trujillo" },
          { nombre: "lucas", edad: 15, ciudad: "Arequipa" },
          { nombre: "Hugo", edad: 64, ciudad: "Tacna" },
        ];

        let nombres = amigos.map((element) => element.nombre);
        const edades = amigos.map((row) => row.edad);

        console.log("Nombres:", nombres);
        console.log("Edades:", edades);
      });
    </script>
  </body>
</html>
