<h2>Reporte por Razas y Alineaciones</h2>
<?= $estilos ?>
<table class="table">
  <colgroup>
  <col style="width: 10%">
  <col style="width: 25%">
  <col style="width: 25%">
  <col style="width: 20%">
  <col style="width: 20%">
  </colgroup>
  <thead>
    <tr>
      <th>ID</th>
      <th>Super Heroe</th>
      <th>Nombre Completo</th>
      <th>Raza</th>
      <th>Publisher</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($superheros as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['superhero_name'] ?></td>
        <td><?= $row['full_name'] ?></td>
        <td><?= $row['race'] ?></td>
        <td><?= $row['publisher_name'] ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
