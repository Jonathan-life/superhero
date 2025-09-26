<?php

namespace App\Models;

use CodeIgniter\Model;

class Superhero extends Model{
  protected $table = 'superhero SH';
  protected $allowedFields = ['id', 'superhero_name', 'full_name', 'race', 'alignment', 'publisher_name'];

  //Definimos 
  public function getSuperHeroByPublisher($publisher_id){
    //Definimos el método de acceso a datos en el MODELO para poder REUTILIZARLO
    return $this->select('SH.id, SH.superhero_name, SH.full_name, RC.race, AL.alignment')
      ->join('race RC', 'RC.id = SH.race_id', 'left')
      ->join('alignment AL', 'AL.id = SH.alignment_id', 'left')
      ->orderBy('SH.superhero_name', 'ASC')
      ->where('SH.publisher_id', $publisher_id)
      ->findAll();
  }

  /**
   * Retorna una lista de super héroes a partir de la raza y la alineacion
   * @param mixed $race_id
   * @param mixed $alignment_id
   * @return array
   */
  public function getSuperHeroByRaceAlignment($race_id, $alignment_id){
    //Definimos el método de acceso a datos en el MODELO para poder REUTILIZARLO
    return $this->select('SH.id, SH.superhero_name, SH.full_name, RC.race, PL.publisher_name')
      ->join('race RC', 'RC.id = SH.race_id', 'left')
      ->join('publisher PL', 'PL.id = SH.publisher_id ', 'left')
      ->orderBy('SH.superhero_name', 'ASC')
      ->where('SH.race_id', $race_id)
      ->where('SH.alignment_id', $alignment_id)
      ->findAll();
  }

}