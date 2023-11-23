<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_WPH extends Model{
    protected $table = 'id_wph';
    protected $primaryKey = 'id_wph';
    protected $allowedFields = ['id_wph','id_user','tanggal','foto','lokasi','jam_absen','nama_absen','status'];
}

