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



}