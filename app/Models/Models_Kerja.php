<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Kerja extends Model{
    protected $table = 'tb_kerja';
    protected $primaryKey = 'id_kerja';
    protected $allowedFields = ['id_kerja','nama','status'];
}

    
   

