<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Gol extends Model{
    protected $table = 'tb_gol';
    protected $primaryKey = 'id_gol';
    protected $allowedFields = ['id_gol','nama'];
}