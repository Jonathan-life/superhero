<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ReporteAlignment;
use finfo;
 
class DashboardController extends BaseController{

  public function getInforme1(){
    return view('dashboard/informe1');
  }

  public function getInforme2(){
    return view('dashboard/informe2');

  }
public function getDataInforme2()
{
    $this->response->setContentType("application/json");

    $data = [
        ["superhero" => "Batman", "popularidad" => 50],
        ["superhero" => "Ben10", "popularidad" => 10],
        ["superhero" => "Goku", "popularidad" => 52],
        ["superhero" => "Spiderman", "popularidad" => 85],
        ["superhero" => "Ironman", "popularidad" => 45]
    ];

    if (empty($data)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se encontraron superhéroes',
            'resumen' => []
        ]);
    }

    sleep(3);
    return $this->response->setJSON([
        'success' => true,
        'message' => 'Popularidad de superhéroes',
        'resumen' => $data
    ]);
}
  public function getInforme3(){
    return view('dashboard/informe3');

  }

public function getDataInforme3()
{
    $this->response->setContentType("application/json");

    $reporteAlignment = new ReporteAlignment();
    $data = $reporteAlignment->findAll();

    if (empty($data)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se encontraron alineaciones',
            'resumen' => []
        ]);
    }

    sleep(1); // opcional para simular carga
    return $this->response->setJSON([
        'success' => true,
        'message' => 'Alineaciones',
        'resumen' => $data
    ]);
}
public function getDataInforme3Cache (){
    $this->response->setContentType("application/json");
    //idetificar al conjunto de datos
    $cachekey = 'resumenAlingment';

    //obtener los datos de la memoria cache
    $data = cache($cachekey);

    if($data == null){
      $reporteAlignment = new ReporteAlignment();
      $data = $reporteAlignment->findAll();

      cache()->save($cachekey, $data, 3600);
    }

    $reporteAlignment = new ReporteAlignment();
    $data = $reporteAlignment->findAll();

    if (empty($data)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se encontraron alineaciones',
            'resumen' => []
        ]);
    }

    sleep(1); // opcional para simular carga
    return $this->response->setJSON([
        'success' => true,
        'message' => 'Alineaciones',
        'resumen' => $data
    ]);
}

public function getDataInformeGender()
{
    $this->response->setContentType("application/json");

    $reporteGender = new \App\Models\ReporteGender();
    $data = $reporteGender->findAll();

    if (empty($data)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se encontraron géneros',
            'resumen' => []
        ]);
    }

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Distribución por género',
        'resumen' => $data
    ]);
}

public function getInformePublisherGender()
{
    // cargamos los publishers para el <select>
    $publisherModel = new \App\Models\Publisher();
    $publishers = $publisherModel->findAll();

    return view('dashboard/informe-publisher-gender', [
        'publishers' => $publishers
    ]);
}

public function getDataInformePublisherGender()
{
    $this->response->setContentType("application/json");

    $db = \Config\Database::connect();
    $builder = $db->table('superhero.superhero AS SH');
    $builder->select('P.publisher_name, G.gender, COUNT(SH.id) AS total');
    $builder->join('superhero.publisher AS P', 'P.id = SH.publisher_id', 'left');
    $builder->join('superhero.gender AS G', 'G.id = SH.gender_id', 'left');

    //  Capturamos lo que envía el <select multiple>
    $publisherIds = $this->request->getPost('publisher_ids');
    if (!empty($publisherIds) && is_array($publisherIds)) {
        $builder->whereIn('P.id', $publisherIds);
    }

    $builder->groupBy('P.publisher_name, G.gender');
    $builder->orderBy('P.publisher_name, total', 'DESC');

    $data = $builder->get()->getResultArray();

    if (empty($data)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'No se encontraron registros con los filtros seleccionados',
            'data' => []
        ]);
    }

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Distribución de géneros por editorial',
        'data' => $data
    ]);
}
    public function getInformePublisherWeight()
    {
        return view('dashboard/informe-publisher-weight');
    }

    
    public function getDataPublisherWeights()
    {
        $this->response->setContentType("application/json");

        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT 
                P.publisher_name,
                AVG(SH.weight_kg) AS promedio_peso
            FROM superhero.superhero SH
            INNER JOIN superhero.publisher P ON P.id = SH.publisher_id
            WHERE SH.weight_kg IS NOT NULL
              AND P.publisher_name IS NOT NULL
              AND P.publisher_name <> ''
            GROUP BY P.publisher_name
            HAVING AVG(SH.weight_kg) > 0
            ORDER BY promedio_peso ASC
        ");

        $data = $query->getResultArray();

        if (empty($data)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No se encontraron registros con peso',
                'data' => []
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Promedio de peso por publisher',
            'data' => $data
        ]);
    }

}