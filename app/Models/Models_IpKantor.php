<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_IpKantor extends Model{
    protected $table = 'tb_ipkantor';
    protected $primaryKey = 'id_list';
    protected $allowedFields = ['id_list','ip_name'];
}


