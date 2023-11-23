<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_JamKerja extends Model{
    protected $table = 'tb_jamkerja';
    protected $primaryKey = 'id_jamkerja';
    protected $allowedFields = ['id_jamkerja','nama','jam1','jam2'];
}

    
   

