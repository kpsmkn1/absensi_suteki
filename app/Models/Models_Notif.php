<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Notif extends Model{
    protected $table = 'tb_notif';
    protected $primaryKey = 'id_notif';
    protected $allowedFields = ['id_notif','nama','waktu','status'];
}