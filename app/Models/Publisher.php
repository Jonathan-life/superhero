<?php

namespace App\Models;
use CodeIgniter\Model;

class Publisher extends Model{

  protected $table = 'publisher';

  protected $allowedFields = ['id', 'publiser_name'];
}