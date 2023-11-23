<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Libur extends Model{
    protected $table = 'tb_libur';
    protected $primaryKey = 'id_libur';
    protected $allowedFields = ['id_libur','nama','waktu'];
}

    
   

