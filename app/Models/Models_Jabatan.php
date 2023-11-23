<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Jabatan extends Model{
    protected $table = 'tb_jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $allowedFields = ['id_jabatan','nama'];
}