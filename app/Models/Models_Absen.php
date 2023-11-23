<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Absen extends Model{
    protected $table = 'tb_absen';
    protected $primaryKey = 'id_absen';
    protected $allowedFields = ['id_absen','id_user','tanggal','tanggal_time','absen_masuk','absen_siang','absen_pulang','jabsen'];
}

