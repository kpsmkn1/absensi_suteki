<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Models_Users;
use App\Models\Models_Notif;
use App\Models\Models_Setting;
use App\Models\Models_Jabatan;
use App\Models\Models_Gol;



class Auth extends BaseController
{   
    private $m_notif;
    private $m_setting;
    public function __construct(){
        $this->m_notif        = new Models_Notif();
        $this->m_setting      = new Models_Setting();
    }


    public function index()
    {
        $session = session();

        if ($this->request->getVar('email')) {
            $email      = $this->request->getVar('email');
            $password   = $this->request->getVar('password');

            $M_Users = new Models_Users();
            $cookie = md5($email.$password.time());

              $cek_login = $M_Users->where([
                    'email'     => $email,
                    'password'  => $password
                ])->first();

              if (!$cek_login) {
                  $session->setFlashdata('notif', "<p style='color:red'>Email Atau Password Salah</p>");
                    return redirect()->back()->withInput();
                }else {


                    if ($cek_login['status'] == "tidak aktif") {
                        $session->setFlashdata('notif', "<p style='color:orange'>Akun Kamu Belum Aktif, Hubungi Admin Untuk Mengaktifkan Akun !</p>");
                    return redirect()->back()->withInput();
                    }
                    $data = [
                        'id_user'   => $cek_login['id_user'],
                        'cookie'    => $cookie
                    ];
                    
                $session->set($cek_login);

                $M_Users->save($data);
                return redirect()->to('/');
            
                }      
}
        


        return view('login');
    }

    public function register()
    {  

        $session = session();
        

        if ($this->request->getVar('nama')) {
            $nama       = $this->request->getVar('nama');
            $nip        = $this->request->getVar('nip');
            $email      = $this->request->getVar('email');
            $password   = $this->request->getVar('password');
            $jabatan    = $this->request->getVar('jabatan');
            $golongan    = $this->request->getVar('golongan');
                

            if (strlen($nip) < 9) {
                $session->setFlashdata('notif', "<p style='color:red'>NIP Minimal 9 angka</p>");
                return redirect()->back()->withInput();
            }elseif(strlen($password) < 4){
                $session->setFlashdata('notif', "<p style='color:red'>Password Minimal 4 Karakter</p>");
                return redirect()->back()->withInput();
            }else {
                $M_Users = new Models_Users();
                //$cookie = md5($nama.$nip.$email.time());

                  $jumlah_email = $M_Users->where([
                        'email' => $email
                    ])->first();
                  $jumlah_nip = $M_Users->where([
                        'nip' => $nip
                    ])->first();
                  if ($jumlah_email) {
                      $session->setFlashdata('notif', "<p style='color:red'>Email Sudah Terdaftar</p>");
                        return redirect()->back()->withInput();
                  }elseif($jumlah_nip){
                        $session->setFlashdata('notif', "<p style='color:red'>NIP Sudah Terdaftar</p>");
                        return redirect()->back()->withInput();
                  }

                  $status_confirm = $this->m_setting->first();
                  if ($status_confirm['konfirmasi'] == 'tidak') {
                      $status = 'aktif';
                  }else {
                    $status = 'tidak aktif';
                  }

                $data = [
                 
                    'nama'      => $nama,
                    'foto'      => 'default.png',
                    'email'     => $email,
                    'password'  => $password,
                    'nip'       => $nip,
                    'jabatan'   => $jabatan,
                    'golongan'  => $golongan,
                    'grade'     => $grade,
                    'cookie'    => '',
                    'status'    => $status,
                    'role'      => '1'
                ];

                $M_Users->save($data);
                $session->setFlashdata('notif', "<p style='color:green'>Berhasil Mendaftar</p>");

                // CREATE NOTIFICATION
                $save_notif = [
                    'nama'      => $nama.' Berhasil Membuat Akun Baru',
                    'waktu'     => time(),
                    'status'    => 1
                ];
                $this->m_notif->save($save_notif);
                // CLOSE NOTIF

                return redirect()->to('/login');
            }

        }
        $mJabatan = new Models_Jabatan();
        $mGolongan = new Models_Gol();
        $data = [
            "dataJabatan" => $mJabatan->findAll(),
            "dataGolongan" => $mGolongan->findAll()
        ];
        return view('register', $data);
    }

    public function forget_password()
    {
        $M_Users = new Models_Users();
        $session = session();

        if ($this->request->getVar('email') AND !$this->request->getVar('password')) {
            $jumlah_email = $M_Users->where([
                        'email' => $this->request->getVar('email')
                    ])->first();
            if (!$jumlah_email) {
                $session->setFlashdata('notif', "<p style='color:red'>Email Tidak Terdaftar</p>");
                return redirect()->back()->withInput();
            }else {
                session()->set(['lupa_password' => $this->request->getVar('email')]);
            }
        }

        if ($this->request->getVar('nip') AND !$this->request->getVar('password')) {
            $nip        = $this->request->getVar('nip');
            $email      = $this->request->getVar('email');

             $jumlah = $M_Users->where([
                        'nip'   => $nip,
                        'email' => $email
                    ])->first();
             if ($jumlah) {
                 session()->set([
                    'lupa_password2'    => $nip,
                    'id_user'           => $jumlah['id_user']
                ]);
                 return redirect()->back()->withInput();
             }else {
                $session->setFlashdata('notif', "<p style='color:red'>NIP Tidak Terdaftar</p>");
                return redirect()->back()->withInput();
             }

        }


         if ($this->request->getVar('password')) {
            $nip        = $this->request->getVar('nip');
            $email      = $this->request->getVar('email');
            $password   = $this->request->getVar('password');
            
            $jumlah = $M_Users->where([
                        'nip'   => $nip,
                        'email' => $email
                    ])->first();
             if ($jumlah) {
                $data = [
                    'id_user' => session()->get('id_user'),
                    'password' => $password,
                ];
                $M_Users->save($data);
                $session->setFlashdata('notif', "<p style='color:green'>Berhasil Reset Password</p>");

                 // CREATE NOTIFICATION
                $save_notif = [
                    'nama'      => $jumlah['nama'].' Berhasil Reset Password',
                    'waktu'     => time(),
                    'status'    => 1
                ];
                $this->m_notif->save($save_notif);
                // CLOSE NOTIF


                 return redirect()->back()->withInput();
             }else {
                $session->setFlashdata('notif', "<p style='color:red'>Data Tidak Sesuai</p>");
                return redirect()->back()->withInput();
             }

        }




        return view('forget_password');
    }


}
