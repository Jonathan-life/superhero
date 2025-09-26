<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informe 1</title>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
      <canvas id="lienzo"></canvas>
      <hr>
      <canvas id="otro-lienzo"></canvas>
    </div>
  </body>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () =>{

      //Objeto referenciar lienzo 
      const lienzo = document.getElementById('lienzo') 
      const otrolienzo = document.getElementById('otro-lienzo')
      const grafico1 = new Chart(lienzo, {
       type: 'bar',
       data: {
          labels: ['Rock','Baladas','Metal'],
          datasets: [
            { data: [15, 20, 4], label: '2023'}, 
            {data: [50, 10, 8], label: '2024'}
          ] 
        } 
      })
      
      //Paquete de datos recibido por un servicio
      const data = [
        { year:2010, total:420 },
        { year:2011, total:492 },
        { year:2012, total:470 },
        { year:2015, total:510 },
        { year:2018, total:610 },
        { year:2013, total:610 },
        { year:2011, total:110 },
        { year:2010, total:810 },
      ]

      const grafico2 = new Chart(otrolienzo,{
        type: 'line',
        data: {
          labels: data.map(row => row.year),
          datasets:[
            {
              data: data.map(row => row.total),
              label: 'Egresados Ing. Software'
            }
          ]
        }
      })

    })
  </script>
</html>