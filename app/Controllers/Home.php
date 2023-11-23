<?php


namespace App\Controllers;




use CodeIgniter\Controller;
use App\Models\Models_Users;
use App\Models\Models_Setting;
use App\Models\Models_Jabatan;
use App\Models\Models_Gol;
use App\Models\Models_Notif;
use App\Models\Models_JamKerja;
use App\Models\Models_Kerja;
use App\Models\Models_Libur;
use App\Models\Models_Absen;
use App\Models\Models_IpKantor;
use App\Models\Models_WPH;
use App\Models\Models_TidakHadir;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\FontSize;


class Home extends BaseController
{

    private $m_users;
    private $m_website;
    private $m_notif;
    private $session;
    private $db;
    public function __construct(){
        /* set default timezone */
        date_default_timezone_set("Asia/Jakarta");
        $this->session = session();
        if (!session()->get('id_user')) {
            header('Location: '.base_url('/login'));
            exit(); 
        }  
    $this->m_users      = new Models_Users();
    $this->m_website    = new Models_Setting();
    $this->m_notif      = new Models_Notif();
    $this->db = \Config\Database::connect(); // Loading database
    }


   // CHECKING IP PUBLIC
   
        

    public function check_ip(){

        function getIp() {
            $ip = $_SERVER['REMOTE_ADDR'];
           
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
         
            return $ip;
        }

        echo "Data 1 :".$_SERVER['SERVER_ADDR']."<br>";
        // ______________________________________________



        $publicIP = file_get_contents("http://ipecho.net/plain");
        echo "Data 2 :".$publicIP."<br>";
        // ______________________________________________

                         
        echo "Data 3 :".gethostbyname(gethostname())."<br>";
        // ______________________________________________


        echo "Data 4 :".$_SERVER['SERVER_NAME']."<br>";
        // ______________________________________________



        
        echo "Data 5 :".getHostByName($_SERVER['HTTP_HOST'])."<br>";
        // ______________________________________________


        echo "Data 6 :".getHostByName(getIp())."<br>";
        // ______________________________________________



        echo "<hr>";
        echo "<h3>SERVER</h3>";
        echo '<pre>',print_r($_SERVER,1),'</pre>';
        // ______________________________________________



        echo "<hr>";
        echo "<h3>CURL INIT</h3>";
         $ch = curl_init();
        $opt = curl_setopt($ch, CURLOPT_URL, "https://google.com"); 
        curl_exec($ch);
        $response = curl_getinfo($ch);
        $result = array('client_public_address' => $response["primary_ip"],
                        'client_local_address' => $response["local_ip"]
                );
        echo '<pre>',print_r($result,1),'</pre>';
        curl_close($ch);



         die();
     }





   
   // CLOSING CHECKING IP


    // EXPORT LAPORAN
        public function laporan2($id=null)
    {

        // dd('masuk');

      

        $Models_JamKerja = new Models_JamKerja();
        $Jamkerja = $Models_JamKerja->findAll();

        $jadwal_masuk = $Jamkerja[0]['jam1'] .' - '. $Jamkerja[0]['jam2'];
        $jadwal_siang = $Jamkerja[1]['jam1'] .' - '. $Jamkerja[1]['jam2'];
        $jadwal_pulang = $Jamkerja[2]['jam1'] .' - '. $Jamkerja[2]['jam2'];

        $builder = $this->db->table('tb_users');
        $builder->select('*');

        if ($id=='day' OR $id==null) {
            $builder->where('tanggal',date('Y-m-d'));
        }elseif($id=='month'){
            $date = date('Y-m');
            $builder->like('tanggal', $date);
        }   
       
        

        $builder->join('tb_absen', 'tb_absen.id_user = tb_users.id_user');
        $builder->orderBy('tb_absen.id_absen', 'DESC');
        $query2rOW = $builder->get()->getResultArray();

        $dataR = [];

        $i = 1;
        $masuk = 0;
        $izin = 0;
        $sakit = 0;
        $alpa = 0;

        

        foreach ($query2rOW as $k) {
            

            if ($k['absen_masuk'] == "sakit" OR
                $k['absen_siang'] == "sakit" OR 
                $k['absen_pulang'] == "sakit"

            ) {
                $sakit = 1;
            }


            if (strpos($k['absen_masuk'], ":") !== false OR strpos($k['absen_siang'], ":") !== false OR strpos($k['absen_pulang'], ":") !== false) {
                 $masuk = 1;
            }
          

            if ($k['absen_masuk'] == "" OR
                $k['absen_siang'] == "" OR 
                $k['absen_pulang'] == ""

            ) {
                $alpa = 1;
            }

            if ($k['absen_masuk'] == "izin" OR
                $k['absen_siang'] == "izin" OR 
                $k['absen_pulang'] == "izin"

            ) {
                $izin = 1;
            }

           
            $id_user = $k['id_user'];
            

            if (!empty($dataR[$id_user]['nip'])) {
                 $dataR[$id_user]['S'] = $dataR[$id_user]['S'] + $sakit;
                 $dataR[$id_user]['I'] = $dataR[$id_user]['I'] + $izin;
                 $dataR[$id_user]['A'] = $dataR[$id_user]['A'] + $alpa;
                 $dataR[$id_user]['M'] = $dataR[$id_user]['M'] + $masuk;
            }else {
                 $dataR[$id_user]['nip'] = $k['nip'];
                 $dataR[$id_user]['nama'] = $k['nama'];
                 $dataR[$id_user]['id_user'] = $k['id_user'];
                 $dataR[$id_user]['jabatan'] = $k['jabatan'];
                 $dataR[$id_user]['golongan'] = $k['golongan'];
                 $dataR[$id_user]['A'] = $alpa;
                 $dataR[$id_user]['S'] = $sakit;
                 $dataR[$id_user]['I'] = $izin;
                 $dataR[$id_user]['M'] = $masuk;
            }



            $i++;
        }


       $Models_JamKerja = new Models_JamKerja();
        $Jamkerja = $Models_JamKerja->findAll();

        $jadwal_masuk = $Jamkerja[0]['jam1'] .' - '. $Jamkerja[0]['jam2'];
        $jadwal_siang = $Jamkerja[1]['jam1'] .' - '. $Jamkerja[1]['jam2'];
        $jadwal_pulang = $Jamkerja[2]['jam1'] .' - '. $Jamkerja[2]['jam2'];


        $data = [
            'AllData'       => $dataR,
            'jadwal_masuk'  => $jadwal_masuk,
            'jadwal_siang'  => $jadwal_siang,
            'jadwal_pulang' => $jadwal_pulang,
            'id'            => $id
        ];
        return view('laporan', $data);
    }



    public function laporan($id=null){
        dd('tesss');


        $builder = $this->db->table('tb_users');
        $builder->select('*');
        if ($id=='day' OR $id==null) {
            $builder->where('tanggal',date('Y-m-d'));
        }elseif($id=='month'){
            $date = date('Y-m');
            $builder->like('tanggal', $date);
        }


        $builder->join('tb_absen', 'tb_absen.id_user = tb_users.id_user');
        $builder->orderBy('tb_absen.id_absen', 'DESC');
        $query2rOW = $builder->get()->getResultArray();


        $Models_JamKerja = new Models_JamKerja();
        $Jamkerja = $Models_JamKerja->findAll();

        $jadwal_masuk = $Jamkerja[0]['jam1'] .' - '. $Jamkerja[0]['jam2'];
        $jadwal_siang = $Jamkerja[1]['jam1'] .' - '. $Jamkerja[1]['jam2'];
        $jadwal_pulang = $Jamkerja[2]['jam1'] .' - '. $Jamkerja[2]['jam2'];

        
        $data = [
            'AllData'       => $query2rOW,
            'jadwal_masuk'  => $jadwal_masuk,
            'jadwal_siang'  => $jadwal_siang,
            'jadwal_pulang' => $jadwal_pulang,
            'id'            => $id
        ];
        return view('laporan', $data);
    }


    public function dlaporan($id_user=null){
        $builder = $this->db->table('tb_users');
        $builder->select('*');
        $builder->join('tb_absen', 'tb_absen.id_user = tb_users.id_user');
        $builder->where('tb_users.id_user',$id_user);
        $builder->orderBy('tb_absen.id_absen', 'DESC');
        $query2rOW = $builder->get()->getResultArray();

        $Models_JamKerja = new Models_JamKerja();
        $Jamkerja = $Models_JamKerja->findAll();
        
        $data = [
            "AllData"   => $query2rOW,
            "j1"        => $Jamkerja[0]['jam1'] . " - " . $Jamkerja[0]['jam2'],
            "j2"        => $Jamkerja[0]['jam1'] . " - " . $Jamkerja[0]['jam2'],
            "j3"        => $Jamkerja[0]['jam1'] . " - " . $Jamkerja[0]['jam2']
        ];
        return view('dlaporan', $data);
    }

    public function rekap_data()
    {
        $Models_JamKerja = new Models_JamKerja();
        $Jamkerja = $Models_JamKerja->findAll();

        $jadwal_masuk = $Jamkerja[0]['jam1'] .' - '. $Jamkerja[0]['jam2'];
        $jadwal_siang = $Jamkerja[1]['jam1'] .' - '. $Jamkerja[1]['jam2'];
        $jadwal_pulang = $Jamkerja[2]['jam1'] .' - '. $Jamkerja[2]['jam2'];

        $builder = $this->db->query("SELECT * FROM tb_users JOIN tb_absen ON tb_users.id_user=tb_absen.id_user");
        
        $query2rOW = $builder->getResultArray();
       

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'ffd166')
            )
        );

        $sheet ->getStyle('A3:N3')->applyFromArray($styleArray);
        $sheet->setCellValue('A1', 'REKAP DATA ABSENSI KECAMATAN SEGEDONG');
         $spreadsheet->getActiveSheet()->mergeCells('A1:N1');
         $spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
        array('horizontal' => Alignment::HORIZONTAL_CENTER,));
    



        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A3', 'NIP')
            ->setCellValue('B3', 'NAMA')
            ->setCellValue('C3', 'GOL')
            ->setCellValue('D3', 'JABATAN')
            ->setCellValue('E3', 'GRADE')
            ->setCellValue('F3', 'USERID')
            ->setCellValue('G3', 'TANGGAL')
            ->setCellValue('H3', 'JADWAL MASUK')
            ->setCellValue('I3', 'ABSEN MASUK')
            ->setCellValue('J3', 'JADWAL SIANG')
            ->setCellValue('K3', 'ABSEN SIANG')
            ->setCellValue('L3', 'JADWAL PULANG')
            ->setCellValue('M3', 'ABSEN PULANG')
            ->setCellValue('N3', 'BULAN');

        $column = 4;
        $tanggal_now = '';
        foreach ($query2rOW as $k) {


            $explode = explode('-', $k['tanggal']);
            $bulan = $explode[1];
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, '\''.$k['nip'])
                ->setCellValue('B' . $column, $k['nama'])
                ->setCellValue('C' . $column, $k['golongan'])
                ->setCellValue('D' . $column, $k['jabatan'])
                ->setCellValue('E' . $column, $k['grade'])
                ->setCellValue('F' . $column, 290000+$k['id_user'])
                ->setCellValue('G' . $column, $k['tanggal'])
                ->setCellValue('H' . $column, $jadwal_masuk)
                ->setCellValue('I' . $column, $k['absen_masuk'])
                ->setCellValue('J' . $column, $jadwal_siang)
                ->setCellValue('K' . $column, $k['absen_siang'])
                ->setCellValue('L' . $column, $jadwal_pulang)
                ->setCellValue('M' . $column, $k['absen_pulang'])
                ->setCellValue('N' . $column, $bulan);

            $column++;
            for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
                $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap_Data_Absensi';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        
    }




    public function download_laporan($id=null)
    {

      

        $Models_JamKerja = new Models_JamKerja();
        $Jamkerja = $Models_JamKerja->findAll();

        $jadwal_masuk = $Jamkerja[0]['jam1'] .' - '. $Jamkerja[0]['jam2'];
        $jadwal_siang = $Jamkerja[1]['jam1'] .' - '. $Jamkerja[1]['jam2'];
        $jadwal_pulang = $Jamkerja[2]['jam1'] .' - '. $Jamkerja[2]['jam2'];

        $builder = $this->db->table('tb_users');
        $builder->select('*');

        if ($id=='day' OR $id==null) {
            $builder->where('tanggal',date('Y-m-d'));
        }elseif($id=='month'){
            $date = date('Y-m');
            $builder->like('tanggal', $date);
        }   
       
        

        $builder->join('tb_absen', 'tb_absen.id_user = tb_users.id_user');
        $builder->orderBy('tb_absen.id_absen', 'DESC');
        $query2rOW = $builder->get()->getResultArray();

        // dd($query2rOW);

        $dataR = [];

        $i = 1;
        $masuk = 0;
        $alpa = 0;
        $izin = 0;
        $sakit = 0;
        $alpa = 0;
        foreach ($query2rOW as $k) {
            

            if ($k['absen_masuk'] == "sakit" OR
                $k['absen_siang'] == "sakit" OR 
                $k['absen_pulang'] == "sakit"

            ) {
                $sakit = 1;
            }


 
            if (($k['absen_masuk'] != "sakit" OR
                $k['absen_masuk'] != "izin dinas" OR 
                $k['absen_masuk'] != "izin bertugas" OR 
                $k['absen_masuk'] != "") AND 
                ($k['absen_siang'] != "sakit" OR
                $k['absen_siang'] != "izin dinas" OR 
                $k['absen_siang'] != "izin bertugas" OR 
                $k['absen_siang'] != "") AND 
                ($k['absen_pulang'] != "sakit" OR
                $k['absen_pulang'] != "izin dinas" OR 
                $k['absen_pulang'] != "izin bertugas" OR 
                $k['absen_pulang'] != "" )

            ) {
                $masuk = 1;
            }

            if ($k['absen_masuk'] == "" OR
                $k['absen_siang'] == "" OR 
                $k['absen_pulang'] == ""

            ) {
                $alpa = 1;
            }

            if ($k['absen_masuk'] == "izin" OR
                $k['absen_siang'] == "izin" OR 
                $k['absen_pulang'] == "izin"

            ) {
                $izin = 1;
            }

           
            $id_user = $k['id_user'];
            
            $dataR[$id_user]['absen_masuk'] = $k['absen_masuk'];
            $dataR[$id_user]['absen_siang'] = $k['absen_siang'];
            $dataR[$id_user]['absen_pulang'] = $k['absen_pulang'];
            $dataR[$id_user]['tanggal'] = $k['tanggal'];

            if (!empty($dataR[$id_user]['nip'])) {
                 $dataR[$id_user]['S'] = $dataR[$id_user]['S'] + $sakit;
                 $dataR[$id_user]['I'] = $dataR[$id_user]['I'] + $izin;
                 $dataR[$id_user]['A'] = $dataR[$id_user]['A'] + $alpa;
                 $dataR[$id_user]['M'] = $dataR[$id_user]['M'] + $masuk;
            }else {
                 $dataR[$id_user]['nip'] = $k['nip'];
                 $dataR[$id_user]['nama'] = $k['nama'];
                 $dataR[$id_user]['jabatan'] = $k['jabatan'];
                 $dataR[$id_user]['golongan'] = $k['golongan'];
                 $dataR[$id_user]['A'] = $alpa;
                 $dataR[$id_user]['S'] = $sakit;
                 $dataR[$id_user]['I'] = $izin;
                 $dataR[$id_user]['M'] = $masuk;
            }



            $i++;
        }

  

        // $jumlah_telat = $this->db->query("SELECT * FROM tb_users JOIN tb_absen ON tb_users.id_user=tb_absen.id_user WHERE tb_absen.absen_masuk='telat' OR tb_absen.absen_siang='telat' OR tb_absen.absen_pulang='telat'")->resultID->num_rows;

        // $jumlah_tidak_absen = $this->db->query("SELECT * FROM tb_users JOIN tb_absen ON tb_users.id_user=tb_absen.id_user WHERE tb_absen.absen_masuk='' OR tb_absen.absen_siang='' OR tb_absen.absen_pulang=''")->resultID->num_rows;

        // $jumlah_sakit = $this->db->query("SELECT * FROM tb_users JOIN tb_absen ON tb_users.id_user=tb_absen.id_user WHERE tb_absen.absen_masuk='sakit' OR tb_absen.absen_siang='sakit' OR tb_absen.absen_pulang='sakit'")->resultID->num_rows;

     
        // $jumlah_hari_kerja = $this->db->query("SELECT * FROM tb_users JOIN tb_absen ON tb_users.id_user=tb_absen.id_user GROUP BY tb_absen.tanggal")->resultID->num_rows;
        
        
        // $jumlah_masuk = ($jumlah_hari_kerja * 3) - ($jumlah_telat + $jumlah_sakit + $jumlah_tidak_absen);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'ffd166')
            )
        );

        $sheet ->getStyle('A3:H3')->applyFromArray($styleArray);
        $sheet->setCellValue('A1', 'LAPORAN ABSENSI');
         $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
         $spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

        $sheet->getStyle('A1')->getAlignment()->applyFromArray(
        array('horizontal' => Alignment::HORIZONTAL_CENTER,));
    



        $spreadsheet->setActiveSheetIndex(0)
   
            ->setCellValue('A3', 'NO')
            ->setCellValue('B3', 'NAMA')
            ->setCellValue('C3', 'JABATAN')
            ->setCellValue('D3', 'GOLONGAN')
            ->setCellValue('E3', 'ABSEN MASUK')
            ->setCellValue('F3', 'ABSEN SIANG')
            ->setCellValue('G3', 'ABSEN PULANG')
            ->setCellValue('H3', 'TANGGAL');

            $sheet->getStyle('E3')->getAlignment()->applyFromArray(
        array('horizontal' => Alignment::HORIZONTAL_CENTER,));
            $sheet->getStyle('F3')->getAlignment()->applyFromArray(
        array('horizontal' => Alignment::HORIZONTAL_CENTER,));
            $sheet->getStyle('G3')->getAlignment()->applyFromArray(
        array('horizontal' => Alignment::HORIZONTAL_CENTER,));
            $sheet->getStyle('H3')->getAlignment()->applyFromArray(
        array('horizontal' => Alignment::HORIZONTAL_CENTER,));
        $column = 4;
        $tanggal_now = '';
        $no=1;
        foreach ($dataR as $k) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $k['nama'])
                ->setCellValue('C' . $column, $k['jabatan'])
                ->setCellValue('D' . $column, $k['golongan'])
                ->setCellValue('E' . $column, $k['absen_masuk'])
                ->setCellValue('F' . $column, $k['absen_siang'])
                ->setCellValue('G' . $column, $k['absen_pulang'])
                ->setCellValue('H' . $column, $k['tanggal']);

            $column++;
            for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
                $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            }
        }
        $column = $column + 3;
        // $spreadsheet->setActiveSheetIndex(0)
        //         ->setCellValue('A' . $column, 'Telat')
        //         ->setCellValue('B' . $column, $jumlah_telat)
        //         ->setCellValue('A' . ($column+1), 'Tidak Hadir')
        //         ->setCellValue('B' . ($column+1), $jumlah_tidak_absen)
        //         ->setCellValue('A' . ($column+2), 'Jumlah Sakit')
        //         ->setCellValue('B' . ($column+2), $jumlah_sakit)
        //         ->setCellValue('A' . ($column+3), 'Hadir')
        //         ->setCellValue('B' . ($column+3), $jumlah_masuk)
        //         ->setCellValue('A' . ($column+4), 'Jumlah Hari Kerja')
        //         ->setCellValue('B' . ($column+4), $jumlah_hari_kerja);





        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Absensi';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');







        
    }










    public function index()
    {
        

        $Models_Absen = new Models_Absen();
        $Models_WPH = new Models_WPH();

        $dataWPH = $Models_WPH->where([
            "status" => "belum diverifikasi"
        ])->countAllResults();

        $builder = $this->db->table('tb_users');
        $builder->select('*');
        $builder->join('tb_absen', 'tb_absen.id_user = tb_users.id_user');
        $builder->where('tb_absen.tanggal', date('Y-m-d'));
        $builder->orderBy('tb_absen.id_absen', 'DESC');
        $query2rOW = $builder->get(2)->getResultArray();
        

        $data = [
            "total_pengguna" => $this->m_users->countAllResults(),
            "total_absen_hari_ini" => $Models_Absen->countAllResults(),
            "verifikasi_wfh" => $Models_Absen->countAllResults(),
            "jumlahdataWPH" => $dataWPH,
            "query2rOW"     => $query2rOW,
            'AllUsers'      => $this->m_users->get(5)->getResultArray(),
        ];
        if (session()->get('role')==2) {
            return view('index', $data);
        }else {
             return view('index_pegawai', $data);
        }
        
    }


    public function confirm_wfh($id=null){
        $Models_Absen       = new Models_Absen();
        $Models_WPH         = new Models_WPH();

        $dataWFH = $Models_WPH->where([
                        'id_wph'     => $id
            ])->first(); 

       if ($dataWFH) {
           $dataAbsen = $Models_Absen->where([
                        'id_user'     => $dataWFH['id_user'],
                        'tanggal'     => $dataWFH['tanggal']
            ])->first();


            $updateABSEN = [
                'id_absen' => $dataAbsen['id_absen']
            ]; 
            $updateABSEN["{$dataWFH['nama_absen']}"] = $dataWFH['jam_absen'];
            $Models_Absen->save($updateABSEN);
            

            $updateWFH = [
                'id_wph' => $dataWFH['id_wph'],
                'status' => 'sudah diverifikasi'
            ];
            $Models_WPH->save($updateWFH);

             return redirect()->to('absen_wfh');
       }else {
            return redirect()->to('absen_wfh');
       }
    }

    public function confirm_absen($id=null,$tanggal=null){
        $Models_Absen       = new Models_Absen();
        $Models_TidakHadir  = new Models_TidakHadir();

        if ($id!=null) {
            $dataTidakHadir = $Models_TidakHadir->where([
                        'id_user'     => $id,
                        'tanggal'     => $tanggal
            ])->first();
            if ($dataTidakHadir) {
                
            $dataAbsen = $Models_Absen->where([
                        'id_user'     => $id,
                        'tanggal'     => $tanggal
            ])->first();

            $a = $dataTidakHadir['waktu_absen'];


            if (strpos($a, 'absen_masuk') !== false) {
                $dabsen1 = $dataTidakHadir['alasan'];
            }else {
                $dabsen1 = $dataAbsen['absen_masuk'];
            }
            if (strpos($a, 'absen_siang') !== false) {
                $dabsen2 = $dataTidakHadir['alasan'];
            }else {
                $dabsen2 = $dataAbsen['absen_siang'];
            }
            if (strpos($a, 'absen_pulang') !== false) {
                $dabsen3 = $dataTidakHadir['alasan'];
            }else {
                $dabsen3 = $dataAbsen['absen_pulang'];
            }

                // UPDATE ABSENSI
                $updateAbsen = [
                    'id_absen' => $dataAbsen['id_absen'],
                    'absen_masuk' => $dabsen1,
                    'absen_siang' => $dabsen2,
                    'absen_pulang' => $dabsen3
                ];

                $updateTidakHadir = [
                    'id_tidakhadir' => $dataTidakHadir['id_tidakhadir'],
                    'status'        => 'sudah dikonfirmasi'
                ];

                $Models_TidakHadir->save($updateTidakHadir);
                $Models_Absen->save($updateAbsen);


                return redirect()->to('data_absen');

            }else {
                return redirect()->to('data_absen');
            }



        }else {
            return redirect()->to('data_absen');
        }
        
    }



    public function absen_wfh($id=null){
            $builder = $this->db->table('tb_users');
            $builder->select('*');
            $builder->join('id_wph', 'id_wph.id_user = tb_users.id_user');
            $minggu = date('Y-m-d', time() - (60*60*24*7));
            
        if ($id == null) {
            $builder->where('id_wph.status', 'belum diverifikasi');
        }elseif($id == "semua"){
            //$builder->where('tb_tidakhadir.tanggal !=', '2');
        }elseif($id == "day"){
            $builder->where('id_wph.tanggal', date('Y-m-d'));
        }elseif($id == "minggu_lalu"){
            $builder->where('id_wph.tanggal >=', $minggu);
        }
            
            $builder->orderBy('id_wph.id_wph', 'DESC');
            $query2rOW = $builder->get()->getResultArray();
           

        $data = [
            "allData" => $query2rOW,
            "active"  => $id,
            'jabasen' => "wfh"
        ];

        return view('absen_wfh',$data);
    }



    public function data_absen($id=null){
            $builder = $this->db->table('tb_users');
            $builder->select('*');
            $builder->join('tb_tidakhadir', 'tb_tidakhadir.id_user = tb_users.id_user');
       
        if ($id == null) {
            $builder->where('tb_tidakhadir.status', 'belum dikonfirmasi');
        }elseif($id == "semua"){
            $builder->where('tb_tidakhadir.tanggal !=', '2');
        }elseif($id == "izin"){
            $builder->where('tb_tidakhadir.alasan', 'izin');
        }elseif($id == "sakit"){
            $builder->where('tb_tidakhadir.alasan', 'sakit');
        }elseif($id == "cuti"){
            $builder->where('tb_tidakhadir.alasan', 'cuti');
        }
            
            $builder->orderBy('tb_tidakhadir.id_tidakhadir', 'DESC');
            $query2rOW = $builder->get()->getResultArray();
           

        $data = [
            "allData" => $query2rOW,
            "active"  => $id
        ];

        return view('data_absen',$data);
    }

    public function list_absen($id=null)
    {   

            $builder = $this->db->table('tb_users');
            $builder->select('*');
            $builder->join('tb_absen', 'tb_absen.id_user = tb_users.id_user');


            $detik = 60;
            $menit = $detik * 60;
            $jam   = $menit * 60;
            $hari  = $jam * 24;
            $minggu = $hari * 7;
            $bulan = $hari * 30;
            $tahun = 12 * $bulan;
            $now_time = time();

        if ($id == null) {
            $builder->where('tb_absen.tanggal', date('Y-m-d'));
        }elseif($id == "week"){
            $builder->where('tb_absen.tanggal_time >=', ($now_time - $minggu));
        }elseif($id == "month"){
            $builder->where('tb_absen.tanggal_time >=', ($now_time - $bulan));
        }elseif($id == "year"){
            $builder->where('tb_absen.tanggal_time >=', ($now_time - $tahun));
        }else {
            $builder->where('tb_absen.tanggal_time >=', 0);
        }
        if (session()->get('role') == 1){
            $builder->where('tb_absen.id_user', session()->get('id_user'));
        }
            $builder->orderBy('tb_absen.id_absen', 'DESC');
            $query2rOW = $builder->get()->getResultArray();

        $data = [
            "allData" => $query2rOW,
            "active"  => $id,
            "jabasen" => 'wfo'
        ];



        return view('list_absen',$data);
    }






    public function absen_day($id,$lambat=null){
        

        /* set default timezone */
        date_default_timezone_set("Asia/Jakarta");

        $Models_Absen = new Models_Absen();
         // ABSEN MULAI
        if (isset($_POST['absen'])) {
            $absen          = $id;
            $jamnow         = $_POST['jamnow'];
         
            $jenisabsen     = $_POST['jenisabsen'];
            $ip_user        = $_POST['ipku'];
            $tglnow         = date('Y-m-d');
            
            if ($jenisabsen == "WFO") {
                $Models_IpKantor = new Models_IpKantor();

                $list_ip = $Models_IpKantor->where([
                    'ip_name'     => $ip_user
                ])->first();

                $neworupdate = $Models_Absen->where([
                    'id_user'     => session()->get('id_user'),
                    'tanggal'     => $tglnow
                ])->first();

                

                
                if ($list_ip) {

                    if ($id == md5(1)) {
                        $dataAbsen = [
                        'id_user' => session()->get('id_user'),
                        'tanggal' => $tglnow,
                        'tanggal_time' => time(),
                        'absen_masuk' => $jamnow
                    ];
                    }elseif($id == md5(2)){
                        $dataAbsen = [
                        'id_user' => session()->get('id_user'),
                        'tanggal' => $tglnow,
                        'tanggal_time' => time(),
                        'absen_siang' => $jamnow
                    ];
                    }elseif($id == md5(3)){
                       $dataAbsen = [
                        'id_user' => session()->get('id_user'),
                        'tanggal' => $tglnow,
                        'tanggal_time' => time(),
                        'absen_pulang' => $jamnow
                    ];
                    }else {
                        return redirect()->to('absen');
                    }
                    
                        
                    if ($neworupdate) {
                        $dataAbsen['id_absen'] = $neworupdate['id_absen'];
                    }else {
                        $dataAbsen['jabsen'] = $jenisabsen;
                    }




                    $Models_Absen->save($dataAbsen);
                    $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Absen $jenisabsen Pada Jam $jamnow
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


                // CREATE NOTIFICATION
                $save_notif = [
                    'nama'      => session()->get('nama').' Berhasil Absensi '.$jenisabsen,
                    'waktu'     => time(),
                    'status'    => 1
                ];
                $this->m_notif->save($save_notif);
                // CLOSE NOTIF



                return redirect()->back();
                }else {
                    $this->session->setFlashdata("notif","<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Absensi Gagal Karena IP Bukan Alamat Kantor !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                return redirect()->back();
                }

                

            }else { 
                // ABSEN WFH
                $lokasi = $_POST['lokasi'];
                if (strlen($lokasi) < 8) {
                    $this->session->setFlashdata("notif","<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Absensi Gagal Karena Lokasi Tidak On !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                return redirect()->back();
                }

                $foto = $_FILES['foto'];
                $extension = explode(".", $foto['name']);
                $etd = strtolower(end($extension));
                if ($etd == "jpg" || $etd == "jpeg" || $etd == "png") {

                $dataBerkas = $this->request->getFile('foto');
                $fileName = $dataBerkas->getRandomName();

                $neworupdate = $Models_Absen->where([
                    'id_user'     => session()->get('id_user'),
                    'tanggal'     => $tglnow
                ])->first();



                    // UPLOAD BERHASIL
                    if ($id == md5(1)) {
                        $nama_absen = "absen_masuk";
                        $dataAbsen = [
                        'id_user' => session()->get('id_user'),
                        'tanggal' => $tglnow,
                        'tanggal_time' => time(),
                        'absen_masuk' => $jamnow. "| WFH ❗"
                    ];
                    }elseif($id == md5(2)){
                        $nama_absen = "absen_siang";
                        $dataAbsen = [
                        'id_user' => session()->get('id_user'),
                        'tanggal' => $tglnow,
                        'tanggal_time' => time(),
                        'absen_siang' => $jamnow. "| WFH ❗"
                    ];
                    }elseif($id == md5(3)){
                        $nama_absen = "absen_pulang";
                       $dataAbsen = [
                        'id_user' => session()->get('id_user'),
                        'tanggal' => $tglnow,
                        'tanggal_time' => time(),
                        'absen_pulang' => $jamnow. "| WFH ❗"
                    ];
                    }else {
                        return redirect()->to('absen');
                    }
                    // ✅
                        
                    if ($neworupdate) {
                        $dataAbsen['id_absen'] = $neworupdate['id_absen'];
                    }else {
                        $dataAbsen['jabsen'] = "WFH";
                    }

                    // INSERT KE DB tb_wfh
                    $Models_WPH = new Models_WPH();
                    $dataWPH = [
                        'id_user'       => session()->get('id_user'),
                        'tanggal'       => $tglnow,
                        'foto'          => $fileName,
                        'lokasi'        => $lokasi,
                        'jam_absen'     => $jamnow,
                        'nama_absen'    => $nama_absen,
                        'status'        => "belum diverifikasi"
                    ];

                    $dataBerkas->move('assets/foto_wfh/', $fileName);

                    $Models_WPH->save($dataWPH);
                    $Models_Absen->save($dataAbsen);



                $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Absen $jenisabsen Pada Jam $jamnow
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                // CREATE NOTIFICATION
                $save_notif = [
                    'nama'      => session()->get('nama').' Berhasil Absensi '.$jenisabsen,
                    'waktu'     => time(),
                    'status'    => 1
                ];
                $this->m_notif->save($save_notif);
                // CLOSE NOTIF
                return redirect()->back();



                }else {
                    $this->session->setFlashdata("notif","<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Absensi Gagal </strong>  File Foto Harus Berformat JPG,JPEG DAN PNG
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                return redirect()->back();
                }


                





            }
        }

        $now = date('H:i');
        $Models_JamKerja = new Models_JamKerja();
        

        if ($id == md5(1)) {
            $id = 1;
            $absen = "Absen Masuk";
        }elseif($id == md5(2)){
            $absen = "Absen Siang";
            $id = 2;
        }elseif($id == md5(3)){
            $id = 3;
            $absen = "Absen Pulang";
        }else {
            return redirect()->to('absen');
        }

        $vabsen = str_replace(" ", "_", $absen);
        $vabsen = strtolower($vabsen);
        $cekSudahAbsen = $Models_Absen->where([
                    'id_user'     => session()->get('id_user'),
                    'tanggal'     => date('Y-m-d')
                ])->first();


        $dataJam = $Models_JamKerja->where([
                    'id_jamkerja'     => $id
                ])->first();
        if (!empty($cekSudahAbsen)) {
            if (strlen($cekSudahAbsen[$vabsen]) > 3) {
                // SUDAH ABSEN
                $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> $absen
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");

                return redirect()->to('absen');
            }else {
                
            }
        }
    
        if ($now >= $dataJam['jam1'] AND $now <= $dataJam['jam2'])  {
            $status = "hadir";
        }else {
           $status = "salah absen";
        }

        $data = [
            'unix' => $id,
            'jam1' => $dataJam['jam1'],
            'jam2' => $dataJam['jam2'],
            'absen'=> $absen
        ];


       


        return view('absen_day', $data);
    }
    public function absen()
    {
        $absen_masuk    = 0;
        $absen_siang    = 0;
        $absen_pulang   = 0;


        /* set default timezone */
        date_default_timezone_set("Asia/Jakarta");


        $Models_Libur       = new Models_Libur();
        $Models_JamKerja    = new Models_JamKerja();
        $Models_Kerja    = new Models_Kerja();
        $Models_Absen    = new Models_Absen();
        $Models_TidakHadir    = new Models_TidakHadir();
        $liburNow = $Models_Libur->where([
                    'waktu'     => date('Y-m-d')
                ])->first();




        function hari_ini(){
    $hari = date ("D");
 
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;
 
        case 'Mon':         
            $hari_ini = "Senin";
        break;
 
        case 'Tue':
            $hari_ini = "Selasa";
        break;
 
        case 'Wed':
            $hari_ini = "Rabu";
        break;
 
        case 'Thu':
            $hari_ini = "Kamis";
        break;
 
        case 'Fri':
            $hari_ini = "Jumat";
        break;
 
        case 'Sat':
            $hari_ini = "Sabtu";
        break;
        
        default:
            $hari_ini = "Tidak di ketahui";     
        break;
    }
 
    return $hari_ini;
 
}
 



       $nama = hari_ini();
        $liburNowByHariKerja = $Models_Kerja->where([
                    'status'     => 'libur',
                    'nama'       => $nama
         ])->first();

       

        if ($liburNow OR $liburNowByHariKerja) {
            if ($liburNow) {
                $libur = $liburNow['nama'];
            }
            if ($liburNowByHariKerja) {
                $libur = $liburNowByHariKerja['nama'];
            }


            $AbsenDayArray = [];


        }else {
            $libur = "masuk";

            $AbsenDay = $Models_Absen->where([
                    'id_user'     => session()->get('id_user'),
                    'tanggal'     => date('Y-m-d')
                ])->first();
            $AbsenDayArray = $Models_Absen->where([
                    'id_user'     => session()->get('id_user')
                ])->orderBy("tanggal","DESC")->get()->getResultArray();
        if ($AbsenDay) {
            if (strlen($AbsenDay['absen_masuk']) > 3) {
                $absen_masuk = $AbsenDay['absen_masuk'];
            }
            if (strlen($AbsenDay['absen_siang']) > 3) {
                $absen_siang = $AbsenDay['absen_siang'];
            }
            if (strlen($AbsenDay['absen_pulang']) > 3) {
                $absen_pulang = $AbsenDay['absen_pulang'];
            }
        }



        }

        if (isset($_POST['tanggal'])) {
            
            // VALIDASI

            
            
            if (!isset($_POST['checkbox'])) {
                 $this->session->setFlashdata("notif","<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Melakukan Absensi, Harap Pilih Salah Satu Waktu Absensi !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
            $this->session->setFlashdata('active','tsss');
            return redirect()->back();
            }
           
            $waktu_absen = '';
            $no =1;
            foreach ($_POST['checkbox'] as $k) {
                
                if ($no==1) {
                   $waktu_absen .= $k;
                }else {
                    $waktu_absen .= ",".$k;
                }
                $no++;
            }
            
                $Sudah_PernahAbsen = $Models_TidakHadir->where([
                    'id_user'     => session()->get('id_user'),
                    'tanggal'     => date('Y-m-d'),
                    'waktu_absen' => $waktu_absen
                ])->first();

                if ($Sudah_PernahAbsen) {
                    $this->session->setFlashdata("notif","<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Melakukan Absensi, Anda Sudah Melakukan Absensi Hari Ini
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                    $this->session->setFlashdata('active','tsss');
                    return redirect()->back();
                }

                $datasx = $Models_Absen->where([
                    'id_user'     => session()->get('id_user'),
                    'tanggal'     => date('Y-m-d')
                ])->first();


                if (!$datasx) {
                        $datas2 = [
                        'id_user'       => session()->get('id_user'),
                        'tanggal'       => date('Y-m-d'),
                        'tanggal_time'  => time(),
                        'absen_masuk'   => '',
                        'absen_siang'   => '',
                        'absen_pulang'  => '',
                        'jabsen'        => $this->request->getVar('alasan')
                    ];
                     $Models_Absen->save($datas2);
                }
                

               




                $foto = $_FILES['foto'];
                $extension = explode(".", $foto['name']);
                $etd = strtolower(end($extension));
                if ($etd == "jpg" || $etd == "jpeg" || $etd == "png") {

                $dataBerkas = $this->request->getFile('foto');
                $fileName = $dataBerkas->getRandomName();
                $dataBerkas->move('assets/foto_absen/', $fileName);
                }else {
                    $this->session->setFlashdata("notif","<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Melakukan Absensi, Hanya Boleh Upload Gambar
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                    $this->session->setFlashdata('active','tsss');
                    return redirect()->back();

                }








            $datas = [
                'id_user' => session()->get('id_user'),
                'tanggal' => date('Y-m-d'),
                'foto'    => $fileName,
                'ket'     => $this->request->getVar('ket'),
                'alasan'  => $this->request->getVar('alasan'),
                'waktu_absen' => $waktu_absen,
                'status' => 'belum dikonfirmasi'
            ];



            $Models_TidakHadir->save($datas);
             $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Data Sudah Dikirim Dan Akan dikonfirmasi Admin
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
            $this->session->setFlashdata('active','tsss');


            // CREATE NOTIFICATION
                $save_notif = [
                    'nama'      => session()->get('nama').' Melakukan '.$this->request->getVar('alasan').' [ '.$waktu_absen.' ]',
                    'waktu'     => time(),
                    'status'    => 1
                ];
            $this->m_notif->save($save_notif);
            // CLOSE NOTIF



            return redirect()->back();


        }



        $data = [
            "total_pengguna"    => $this->m_users->countAllResults(),
            "libur"             => $libur,
            "jamKerja"          => $Models_JamKerja->findAll(),
            "absen_masuk"       => $absen_masuk,
            "absen_siang"       => $absen_siang,
            "absen_pulang"      => $absen_pulang,
            "AbsenDay"          => $AbsenDayArray
        ];



        return view('absen', $data);
    }



    public function jadwal_kerja()
    {

        $Models_Kerja = new Models_Kerja();
        $data = [
            "allData" => $Models_Kerja->findAll()
        ];
        if (isset($_POST['id_users'])) {
           
           $senin = (isset($_POST['1']) ? "masuk" : "libur");
           $selasa = (isset($_POST['2']) ? "masuk" : "libur");
           $rabu = (isset($_POST['3']) ? "masuk" : "libur");
           $kamis = (isset($_POST['4']) ? "masuk" : "libur");
           $jumat = (isset($_POST['5']) ? "masuk" : "libur");
           $sabtu = (isset($_POST['6']) ? "masuk" : "libur");
           $minggu = (isset($_POST['7']) ? "masuk" : "libur");

            $data2 = array(
                array(
                    'id_kerja' => '1' ,
                    'status' => $senin
                ),
                array(
                    'id_kerja' => '2' ,
                    'status' => $selasa
                ),
                array(
                    'id_kerja' => '3' ,
                    'status' => $rabu
                ),
                array(
                    'id_kerja' => '4' ,
                    'status' => $kamis
                ),
                array(
                    'id_kerja' => '5' ,
                    'status' => $jumat
                ),
                array(
                    'id_kerja' => '6' ,
                    'status' => $sabtu
                ),
                array(
                    'id_kerja' => '7' ,
                    'status' => $minggu
                )
            );

            $Models_Kerja->updateBatch($data2, 'id_kerja');
            $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Menyimpan Perubahan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                return redirect()->back();



        }
            
        return view('ajadwal_kerja', $data);
    }


    public function jadwal_libur()
    {
       $Models_Libur = new Models_Libur;
        
        $data = [
        'all_libur' => $Models_Libur->orderBy('id_libur','DESC')->findAll()
            ];



            if ($this->request->getVar('tanggal') AND !$this->request->getVar('idLibur')) {
                $nama     = $this->request->getVar('nama');
                $tanggal  = $this->request->getVar('tanggal');
                $data = [
                    'nama' => $nama,
                    'waktu'=> $tanggal
                ];
                $Models_Libur->save($data);
                $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Menyimpan Perubahan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                return redirect()->back();
            }

            if ($this->request->getVar('idLibur')) {
                $id       = $this->request->getVar('idLibur');
                $nama     = $this->request->getVar('nama');
                $tanggal  = $this->request->getVar('tanggal');
                $data = [
                    'id_libur' => $id,
                    'nama' => $nama,
                    'waktu'=> $tanggal
                ];
                $Models_Libur->save($data);
                $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Mengubah Hari Libur !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
                return redirect()->back();
            }



        return view('hari_libur', $data);
    }


    public function notifikasi($id=null)
    {
        $data = [
            "allData" => $this->m_notif->orderBy('waktu','DESC')->findAll()
        ];
        if ($id=="dibaca") {
            
             $result = $this->m_notif->query("UPDATE tb_notif SET status='0'");
             return redirect()->to('/notifikasi');
        }
        

        return view('notifikasi', $data);
    }

        public function cari()
    {
        if (!isset($_POST['key'])) {
            return redirect()->back();
        }
        $key = $this->request->getVar('key');


        $like = $this->m_users->like('nama',$key)->findAll();
       
        $mJabatan = new Models_Jabatan();
        $mGolongan = new Models_Gol();
        $data = [
        'all_users' => $like,
        'allJabatan' => $mJabatan->findAll(),
        'allGolongan' => $mGolongan->findAll()
            ];

            if ($this->request->getVar('nama')) {
                $nama       = $this->request->getVar('nama');
                $jabatan    = $this->request->getVar('jabatan');
                $nip        = $this->request->getVar('nip');
                $email      = $this->request->getVar('email');
                $password   = $this->request->getVar('password');
                $status     = $this->request->getVar('status');
                $role       = $this->request->getVar('role');
                $grade      = $this->request->getVar('grade');
                $golongan   = $this->request->getVar('golongan');
                $role       = $this->request->getVar('role');
                if ($this->request->getVar('id_user')) {
                    $status_notif = "Mengubah";
                    $dataForm = [
                        'id_user' => $this->request->getVar('id_user'),
                        'nama'          => $nama,
                        'email'         => $email,
                        'password'      => $password,
                        'nip'           => $nip,
                        'jabatan'       => $jabatan,
                        'golongan'      => $golongan,
                        'grade'         => $grade,
                        'status'        => $status,
                        'role'          => $role
                    ];
                }else {
                    $status_notif = "Menambah";
                    $dataForm = [
                        'nama'          => $nama,
                        'email'         => $email,
                        'password'      => $password,
                        'nip'           => $nip,
                        'jabatan'       => $jabatan,
                        'foto'          => 'default.jpg',
                        'golongan'      => $golongan,
                        'grade'         => $grade,
                        'status'        => $status,
                        'role'          => $role
                    ];
                }
                
                $this->m_users->save($dataForm);

                $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil {$status_notif} Pengguna !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


                return redirect()->back();
            }
        
        

        return view('pengguna', $data);
    }
    public function pengguna()
    {
        $mJabatan = new Models_Jabatan();
        $mGolongan = new Models_Gol();
        $data = [
        'all_users' => $this->m_users->orderBy('id_user','DESC')->findAll(),
        'allJabatan' => $mJabatan->findAll(),
        'allGolongan' => $mGolongan->findAll()
            ];

            if ($this->request->getVar('nama')) {
                $nama       = $this->request->getVar('nama');
                $jabatan    = $this->request->getVar('jabatan');
                $nip        = $this->request->getVar('nip');
                $email      = $this->request->getVar('email');
                $password   = $this->request->getVar('password');
                $status     = $this->request->getVar('status');
                $role       = $this->request->getVar('role');
                $grade      = $this->request->getVar('grade');
                $golongan   = $this->request->getVar('golongan');
                $role       = $this->request->getVar('role');
                if ($this->request->getVar('id_user')) {
                    $status_notif = "Mengubah";
                    $dataForm = [
                        'id_user' => $this->request->getVar('id_user'),
                        'nama'          => $nama,
                        'email'         => $email,
                        'password'      => $password,
                        'nip'           => $nip,
                        'jabatan'       => $jabatan,
                        'golongan'      => $golongan,
                        'grade'         => $grade,
                        'status'        => $status,
                        'role'          => $role
                    ];
                }else {
                    $status_notif = "Menambah";
                    $dataForm = [
                        'nama'          => $nama,
                        'email'         => $email,
                        'password'      => $password,
                        'nip'           => $nip,
                        'jabatan'       => $jabatan,
                        'foto'          => 'default.jpg',
                        'golongan'      => $golongan,
                        'grade'         => $grade,
                        'status'        => $status,
                        'role'          => $role
                    ];
                }
                
                $this->m_users->save($dataForm);

                $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil {$status_notif} Pengguna !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


                return redirect()->back();
            }
        
        

        return view('pengguna', $data);
    }

    public function profil($id=null)
    {
        if ($id==null) {
               $data = [
                "all_users" => $this->m_users->find(session()->get('id_user')),
                'status'    => 'off',
                'title'     => 'Profil Saya'
            ];
        }else {
              $data = [
                "all_users" => $this->m_users->find($id),
                'status'    => 'on',
                'title'     => 'Profil Pengguna'
            ];  
        }
        
        return view('profil', $data);
    }
    public function pengaturan()
    {
        $mJabatan = new Models_Jabatan();
        $mGolongan = new Models_Gol();
        $mJamKerja = new Models_JamKerja();
        $Models_IpKantor = new Models_IpKantor();


        $data = [
            'allData' => $this->m_website->findAll(),
            'allJabatan' => $mJabatan->findAll(),
            'allGolongan' => $mGolongan->findAll(),
            'allJamKerja' => $mJamKerja->findAll(),
            'ipkantor'   => $Models_IpKantor->findAll()
        ];

        

        if (isset($_POST['ipkantor'])) {
            $data2 = array(
                array(
                    'id_list' => '1' ,
                    'ip_name' => trim($this->request->getVar('ip_name1'))
                ),
                array(
                    'id_list' => '2' ,
                    'ip_name' => trim($this->request->getVar('ip_name2'))
                ),
                array(
                    'id_list' => '3' ,
                    'ip_name' => trim($this->request->getVar('ip_name3'))
                ),
                array(
                    'id_list' => '4' ,
                    'ip_name' => trim($this->request->getVar('ip_name4'))
                ),
                array(
                    'id_list' => '5' ,
                    'ip_name' => trim($this->request->getVar('ip_name5'))
                )
            );

            $Models_IpKantor->updateBatch($data2, 'id_list');

            $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menyimpan Perubahan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->to('/pengaturan');
        }



        if ($this->request->getVar('id_website')) {
            $data = [
                'id_website'    => $this->request->getVar('id_website'),
                'nama'          => $this->request->getVar('nama'),
                'konfirmasi'    => $this->request->getVar('konfirmasi')
            ];
            $this->m_website->save($data);

            $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menyimpan Perubahan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();
        }
        if ($this->request->getVar('jabatan')) {
            

            $data = [
                'nama' => $this->request->getVar('jabatan')
            ];
            $mJabatan->save($data);

            $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menambah Jabatan Baru !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();


        }


        if ($this->request->getVar('golongan')) {
            

            $data = [
                'nama' => $this->request->getVar('golongan')
            ];
            $mGolongan->save($data);

            $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menambah Golongan Baru !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();


        }



        if ($this->request->getVar('jamKerja')) {
            

            $data = [
                'id_jamkerja' => $this->request->getVar('jamKerja'),
                'jam1' => $this->request->getVar('jam1'),
                'jam2' => $this->request->getVar('jam2')
            ];
            $mJamKerja->save($data);

            $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menyimpan Perubahan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();


        }






        return view('pengaturan', $data);
    }

// EDIT PROFIL




    public function edit_profil()
    {
        $mJabatan = new Models_Jabatan();
        $mGolongan = new Models_Gol();
        $data = [
            "allData"       => $this->m_users->find(session()->get('id_user')),
            "allJabatan"    => $mJabatan->findAll(),
            "allGol"        => $mGolongan->findAll()
        ];


        if ($this->request->getVar('nama')) {
        //     if ($this->request->getVar('p1') != $this->request->getVar('p2')) {
               
        //     $this->session->setFlashdata("notif","<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        //                         <strong>Gagal</strong> Konfirmasi password Tidak Sesuai !
        //                         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        //                             <span aria-hidden='true'>&times;</span>
        //                         </button>
        //                     </div>");


        //     return redirect()->back();
        //     }

            if ($this->request->getFile('foto')->getError() == 4) {
                $fileName = $this->request->getVar('fotolama');
            }else {
                $dataBerkas = $this->request->getFile('foto');
                $fileName = $dataBerkas->getRandomName();
                
                $ext = explode(".", $fileName);
                    $ex = end($ext);
                
                    if ($ex == "png" OR $ex == "jpg" OR $ex == "jpeg") {
                        // code...
                    }else {
                        $this->session->setFlashdata("notif","<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Hanya Boleh Upload Gambar !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();
                    }
                
                $dataBerkas->move('assets/img/', $fileName);
            }
            $data = [
                'id_user'   => session()->get('id_user'),
                'nama'      => $this->request->getVar('nama'),
                'email'     => $this->request->getVar('email'),
                'nip'       => $this->request->getVar('nip'),
                'foto'       => $fileName,
                'jabatan'   => $this->request->getVar('jabatan'),
                'golongan'  => $this->request->getVar('golongan')
                ];


            $this->m_users->save($data);
             $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Menyimpan Perubahan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();

        }

        return view('edit_profil', $data);
    }





    public function ganti_password()
    {
        
        $data = [
            "allData" => $this->m_users->find(session()->get('id_user'))
        ];


        if ($this->request->getVar('p1')) {
            if ($this->request->getVar('p1') != $this->request->getVar('p2')) {
               
            $this->session->setFlashdata("notif","<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Gagal</strong> Konfirmasi password Tidak Sesuai !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();
            }
            $data = [
                'id_user' => session()->get('id_user'),
                'password' => $this->request->getVar('p2')
                ];
            $this->m_users->save($data);
             $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Berhasil</strong> Mengganti password !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");


            return redirect()->back();

        }

        return view('ubah_password', $data);
    }

   


   // DELETE 
    public function delete_golongan($id){
        $mGolongan = new Models_Gol();
        $mGolongan->delete($id);

       $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menghapus Golongan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
       return redirect()->to('/pengaturan');
    }


    public function delete_jabatan($id){
        $mJabatan = new Models_Jabatan();
       $mJabatan->delete($id);

       $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menghapus Jabatan !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
       return redirect()->to('/pengaturan');
    }


    public function delete_pengguna($id){
       $this->m_users->delete($id);

       $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menghapus Pengguna !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
       return redirect()->to('/pengguna');
    }

    public function delete_harilibur($id){
       $Models_Libur = new Models_Libur();

       $Models_Libur->delete($id);
       $this->session->setFlashdata("notif","<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Sukses</strong> Berhasil Menghapus hari_libur !
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>");
       return redirect()->to('/jadwal_libur');
    }


    public function ajax_online(){
                                        
    $connected = fopen("http://www.google.com:80/","r");
      if($connected)
      {
        // $publicIP = file_get_contents('https://api.ipify.org/');
        // $publicIP = $_SERVER['REMOTE_ADDR'];
        $publicIP = getHostByName(getHostName());
        echo $publicIP;
        die();

      } else {
       echo "Hubungkan Ke Internet Untuk Melihat Alamat IP";
       die();
      } 
    }
    public function keluar()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }


}
