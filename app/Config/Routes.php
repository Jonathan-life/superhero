<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Reportes
$routes->get('/reportes/r1', 'ReporteController::getReport1');
$routes->get('/reportes/r2', 'ReporteController::getReport2');
$routes->get('/reportes/r3', 'ReporteController::getReport3');

//Muestra un interfaz web (Form) para que el usuario seleccine un "tipo de reporte" a generar
$routes->get('/reportes/showui', 'ReporteController::showUIReport');

//El formulario <select>Enviara los datos
$routes->post('/reportes/publisher', 'ReporteController::getReportByPublisher');
$routes->post('/reportes/raceAlignment', 'ReporteController::getReportByRaceAlignment');

//Dashboard
$routes->get('/dashboard/informe1', 'DashboardController::getInforme1');  
$routes->get('/dashboard/informe2', 'DashboardController::getInforme2');
$routes->get('/dashboard/informe3', 'DashboardController::getInforme3');

//public
$routes->get('public/api/getdatainforme2','DashboardController::getDataInforme2');
$routes->get('public/api/getdatainforme3','DashboardController::getDataInforme3');
$routes->get('public/api/getdatainforme3cache','DashboardController::getDataInforme3cache');
$routes->get('public/api/getDataInformeGender', 'DashboardController::getDataInformeGender');
$routes->get('/dashboard/informeGender', function () {
    echo view('dashboard/informeGender');
});
