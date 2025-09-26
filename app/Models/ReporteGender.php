<?php
namespace App\Models;
use CodeIgniter\Model;

class ReporteGender extends Model {
    protected $table = 'view_superhero_gender';
    protected $primaryKey = 'gender';
    protected $returnType = 'array';
    protected $allowedFields = [];
}
