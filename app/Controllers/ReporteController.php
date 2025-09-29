<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Alignment;
use App\Models\Publisher;
use App\Models\Race;
use App\Models\Superhero;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class ReporteController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); //Acceso BD
    }

    public function showUIReport()
    {
        $publisher = new Publisher();
        $race      = new Race();
        $alignment = new Alignment();

        $datos = [
            'publishers' => $publisher->findAll(),
            'race'       => $race->findAll(),
            'alignment'  => $alignment->findAll()
        ];
        return view('reportes/rpt-ui', $datos); //Devuelve la interfaz grafica (FORM HTML)
    }

    public function getReportByPublisher()
    {
        $superhero    = new Superhero();
        $publisher_id = $this->request->getVar('publisher_id');

        $data = [
            'estilos'     => view('reportes/estilos'),
            'superheroes' => $superhero->getSuperHeroByPublisher($publisher_id)
        ];

        $html     = view('reportes/rpt-superhero-pu', $data);
        $html2PDF = null;

        try {
            $html2PDF = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', [20, 10, 10, 10]);
            $html2PDF->writeHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');
            $html2PDF->output('Reporte-superhero-publisher.pdf');
            exit(); //Opcional
        } catch (Html2PdfException $e) {
            if ($html2PDF) {
                $html2PDF->clean();
            }
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getMessage();
        }
    }

    public function getReportByRaceAlignment()
    {
        $superhero    = new Superhero();
        $race_id      = (int)$this->request->getVar('race_id');
        $alignment_id = (int)$this->request->getVar('alignment_id');

        $datos = [
            'estilos'    => view('reportes/estilos'),
            'superheros' => $superhero->getSuperHeroByRaceAlignment($race_id, $alignment_id)
        ];

        $html     = view('reportes/rpt-superhero-ra', $datos);
        $html2PDF = null;

        try {
            $html2PDF = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', [20, 10, 10, 10]);
            $html2PDF->writeHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');
            $html2PDF->output('Reporte-superhero-ra.pdf');
            exit(); //Opcional
        } catch (Html2PdfException $e) {
            if ($html2PDF) {
                $html2PDF->clean();
            }
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getMessage();
        }
    }

    public function getReport1()
    {
        $html     = view('reportes/reporte1');
        $html2PDF = new Html2Pdf();
        $html2PDF->writeHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $html2PDF->output();
    }

    public function getReport2()
    {
        $data = [
            "area"      => "Sistemas",
            "autor"     => "Jhon Francia Minaya",
            "productos" => [
                ["id" => 1, "descripcion" => "Monitor", "precio" => 750],
                ["id" => 2, "descripcion" => "Impresora", "precio" => 500],
                ["id" => 3, "descripcion" => "WebCam", "precio" => 220]
            ],
            "estilos"   => view('reportes/estilos')
        ];

        $html     = view('reportes/reporte2', $data);
        $html2PDF = null;

        try {
            $html2PDF = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [20, 10, 10, 10]);
            $html2PDF->writeHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');
            $html2PDF->output('Reporte-Finanzas.pdf');
        } catch (Html2PdfException $e) {
            if ($html2PDF) {
                $html2PDF->clean();
            }
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getMessage();
        }
    }

    public function getReport3()
    {
        $query = "
        SELECT
          SH.id,
          SH.superhero_name,
          SH.full_name,
          PB.publisher_name,
          AL.alignment
        FROM superhero SH 
          LEFT JOIN publisher PB ON SH.publisher_id = PB.id
          LEFT JOIN alignment AL ON SH.alignment_id = AL.id
        ORDER BY 4
        LIMIT 150;
        ";

        $rows = $this->db->query($query);
        $data = [
            "rows"    => $rows->getResultArray(),
            "estilos" => view('reportes/estilos')
        ];

        $html     = view('reportes/reporte3', $data);
        $html2PDF = null;

        try {
            $html2PDF = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', [20, 10, 10, 10]);
            $html2PDF->writeHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');
            $html2PDF->output('Reporte-superhero.pdf');
            exit();
        } catch (Html2PdfException $e) {
            if ($html2PDF) {
                $html2PDF->clean();
            }
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getMessage();
        }
    }
    public function showUIReportGender()
{
    // Obtener géneros desde la BD
    $query = $this->db->query("SELECT id, gender FROM gender ORDER BY gender");
    $datos = [
        'genders' => $query->getResultArray()
    ];

    return view('reportes/rpt-ui-gender', $datos);
}

public function getReportByGender()
{
    $gender_id = (int)$this->request->getVar('gender_id');
    $limit     = (int)$this->request->getVar('limit');

    if ($limit <= 0) {
        $limit = 50; 
    }

    $query = "
        SELECT SH.id, SH.superhero_name, SH.full_name, G.gender
        FROM superhero SH
        LEFT JOIN gender G ON SH.gender_id = G.id
        WHERE SH.gender_id = ?
        ORDER BY SH.superhero_name
        LIMIT ?
    ";

    $rows = $this->db->query($query, [$gender_id, $limit]);

    $data = [
        "rows"    => $rows->getResultArray(),
        "estilos" => view('reportes/estilos')
    ];

    $html     = view('reportes/rpt-superhero-gender', $data);
    $html2PDF = null;

    try {
        $html2PDF = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [20, 10, 10, 10]);
        $html2PDF->writeHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $html2PDF->output('Reporte-superhero-gender.pdf');
        exit();
    } catch (\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
        if ($html2PDF) {
            $html2PDF->clean();
        }
        $formatter = new \Spipu\Html2Pdf\Exception\ExceptionFormatter($e);
        echo $formatter->getMessage();

    }
}


}

