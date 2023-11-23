<?php 

namespace App\Models;
 
use CodeIgniter\Model;
 
class Models_Users extends Model{
    protected $table = 'tb_users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user','nama','foto','email','password','nip','jabatan','golongan','grade','cookie','status','role'];


}