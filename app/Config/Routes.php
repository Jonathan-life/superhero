<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');   // segunda

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


//Grafico gender
$routes->get('/dashboard/informeGender', function () {
    echo view('dashboard/informeGender');
});

// =========================
// RUTAS DE REPORTES VISTA 1
// =========================
$routes->get('reportes/ui-gender', 'ReporteController::showUIReportGender');
$routes->post('reportes/getReportByGender', 'ReporteController::getReportByGender');

// =========================
// RUTAS DE GRAFICOS VISTA 2
// =========================
$routes->get('dashboard/informe-publisher-gender', 'DashboardController::getInformePublisherGender');
$routes->post('dashboard/getDataInformePublisherGender', 'DashboardController::getDataInformePublisherGender'); // 👈 POST
// ================================
// Dashboard - Reporte Promedio Peso vista 3
// ================================
$routes->get('dashboard/informe-publisher-weights', 'DashboardController::getInformePublisherWeight');
$routes->post('dashboard/getDataPublisherWeights', 'DashboardController::getDataPublisherWeights');






// Login 
$routes->match(['get','post'], 'login', 'AuthController::login');
$routes->get('perfil', 'AuthController::perfil');
$routes->get('logout', 'AuthController::logout');



// Usuarios
$routes->get('/usuario/crear', 'UsuarioController::formCrear');
$routes->post('/usuario/crear', 'UsuarioController::crear');


