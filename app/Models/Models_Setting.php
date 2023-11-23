<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Setting extends Model{
    protected $table = 'tb_website';
    protected $primaryKey = 'id_website';
    protected $allowedFields = ['id_website','nama','konfirmasi'];
}