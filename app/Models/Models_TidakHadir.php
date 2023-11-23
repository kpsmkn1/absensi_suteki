<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_TidakHadir extends Model{
    protected $table = 'tb_tidakhadir';
    protected $primaryKey = 'id_tidakhadir';
    protected $allowedFields = ['id_tidakhadir','id_user','tanggal','foto','ket','alasan','waktu_absen','status'];
}


 
