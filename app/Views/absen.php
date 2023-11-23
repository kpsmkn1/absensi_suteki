
<?php 
        if (session()->get('role') == 2) {
            echo $this->extend('template/index');
        }else {
            echo $this->extend('template/pegawai_template');
        }

 ?>


            <?= $this->section('content') ?>
            <style>
                .btn-blue {
                    background-color: #219ebc;
                }
            </style>
            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Page Header -->
                            <div class="page-header mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="page-title">Presensi</h3>
                                        <?php if (session()->get('notif')) {
                                echo session()->getFlashdata('notif');
                            } ?>

                            
                                    </div>
                                </div>
                            </div>
                            <!-- /Page Header -->


                            <?php if ($libur == "masuk") : ?>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-bottom" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?= (!session()->getFlashdata('active')) ? "active" : "" ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                                    Presensi
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?= (session()->getFlashdata('active')) ? "active" : "" ?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Absensi</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Data Presensi</a>
                                </li>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane <?= (!session()->getFlashdata('active')) ? "active" : "" ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <h4>Lakukan Presensi Dengan Klik Tombol Absen Sekarang</h4>
                                  
                                    <div class="form-group  form-row row approver seq-approver" style="display: block;">
                                       
                                        <div class="col-sm-9 ">
                                            <?php 

                    $no=1; foreach ($jamKerja as $k) :

                    $now        = date('H:i');
                    //$waktutelat = date('H:i', time()+(60*15));
                    $waktutelat = strtotime($k['jam2']) + (60*15);
                    $waktutelat = date('H:i', $waktutelat);

                    if ($no==1) {
                        $jabsen = $absen_masuk;
                    }elseif($no==2){
                        $jabsen = $absen_siang;
                    }elseif($no==3){
                        $jabsen = $absen_pulang;
                    }

                    if ($jabsen) {
                        $waktu_normal = "Waktu Absen : ".$jabsen;
                    }else {
                        $waktu_normal = $k['jam1'] ." - ".$k['jam2'];
                    }

                                             ?>
                                            <label class="ex_exp_approvers_<?= $no; ?> control-label mb-2 exp_appr" style="padding-left:0"><?= $k['nama']; ?></label>
                                            <div class="row ex_exp_approvers_3 form-group">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input readonly value="<?= $waktu_normal; ?>" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                    <?php 
                    
                   
                    if (TRUE)  {
                        $return = "";
                        $a = "'Absen Diluar jam ! Apakah tetap ingin absen ?'";
                        $b = 'onclick="return confirm('.$a.')"';
                        if ($no == 1) {
                            if (strlen($absen_masuk) > 3) {
                                $tombol_on = 'btn-success border';
                                $link = "javascript:void";
                           }else {
                            if ($now >= $k['jam1'] AND $now <= $k['jam2']) {
                                $tombol_on = 'btn-blue';
                                $url = md5($no);
                                $link = base_url()."/absen_day/".$url;
                            }else {
                                if ($now >= $k['jam1'] AND $now <= $waktutelat) {
                                    $return = $b;
                                    $tombol_on = 'btn-danger';
                                    $url = md5($no);
                                    $link = base_url()."/absen_day/".$url."/telat";
                                }else {
                                    $return = $b;
                                    $tombol_on = 'btn-danger';
                                    $url = md5($no);
                                    $link = base_url()."/absen_day/".$url."/salah absen";
                                }
                                
                            }

                                
                           }
                        }
                        if ($no == 2) {
                           if (strlen($absen_siang) > 3) {
                                $tombol_on = 'btn-success border';
                                $link = "javascript:void";
                           }else {
                                if ($now >= $k['jam1'] AND $now <= $k['jam2']) {
                                $tombol_on = 'btn-blue';
                                $url = md5($no);
                                $link = base_url()."/absen_day/".$url;
                            }else {
                               if ($now >= $k['jam1'] AND $now <= $waktutelat) {
                                    $return = $b;
                                    $tombol_on = 'btn-danger';
                                    $url = md5($no);
                                    $link = base_url()."/absen_day/".$url."/telat";
                                }else {
                                    $return = $b;
                                    $tombol_on = 'btn-danger';
                                    $url = md5($no);
                                    $link = base_url()."/absen_day/".$url."/salah absen";
                                }
                            }
                           }
                        }
                        if ($no == 3) {
                            if (strlen($absen_pulang) > 3) {
                                $tombol_on = 'btn-success border';
                                $link = "javascript:void";
                           }else {
                                if ($now >= $k['jam1'] AND $now <= $k['jam2']) {
                                $tombol_on = 'btn-blue';
                                $url = md5($no);
                                $link = base_url()."/absen_day/".$url;
                            }else {
                               if ($now >= $k['jam1'] AND $now <= $waktutelat) {
                                    $return = $b;
                                    $tombol_on = 'btn-danger';
                                    $url = md5($no);
                                    $link = base_url()."/absen_day/".$url."/telat";
                                }else {
                                    $return = $b;
                                    $tombol_on = 'btn-danger';
                                    $url = md5($no);
                                    $link = base_url()."/absen_day/".$url."/salah absen";
                                }
                            }
                           }
                        }
                        


                    }else {
                        $tombol_on = 'btn-default border';
                        $link = "javascript:void";
                    }
                    ?>
                                                        <a <?= $return ?> href="<?= $link ?>" class="btn-sm btn <?= $tombol_on ?>"><i class="fa fa-plus"></i> Absen</a>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php $no++; endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?= (session()->getFlashdata('active')) ? "active" : "" ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    
                                   
                                    <div class=" row ">
                                        <div class="col-md-12">

                                            <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                       
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Tanggal</label>
                                            <div class="col-md-10">
                                                <input name="tanggal" value="<?= date('Y-m-d') ?>" type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        
                                       
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Pilih Alasan Tidak Hadir</label>
                                            <div class="col-md-10">
                                                <select name="alasan"  required class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="izin bertugas">Izin Bertugas</option>
                                                    <option value="izin dinas">Izin</option>
                                                    <option value="sakit">Sakit</option>
                                                    <option value="cuti">Cuti</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Waktu</label>
                                            <div class="col-md-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="absen_masuk" name="checkbox[]"> Absen Masuk
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="absen_siang" name="checkbox[]"> Absen Siang
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="absen_pulang" name="checkbox[]"> Absen Pulang
                                                    </label>
                                                </div>
                                                <p><i class="text-danger">Centang Semua jika absen dalam 1 hari penuh</i></p>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">File Document</label>
                                            <div class="col-md-10">
                                                <input required class="form-control" name="foto" type="file">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Keterangan</label>
                                            <div class="col-md-10">
                                                <textarea required name="ket" rows="5" cols="5" class="form-control" placeholder="Tambahkan Keterangan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                            
                                            <div class="col-md-8 offset-md-2">
                                               <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                    <div class="table-responsive">
                            
                                <!-- Promotion Table -->
                                <table class="table table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Absen Masuk</th>
                                            <th>Absen Siang</th>
                                            <th>Absen Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($AbsenDay as $k) :?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $k['tanggal'] ?></td>
                                                <td><?= $k['absen_masuk'] ?></td>
                                                <td><?= $k['absen_siang'] ?></td>
                                                <td><?= $k['absen_pulang'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- /Promotion Table -->
                                
                            </div>
                                </div>
                               
                            </div>
                        <?php else: ?>
                            <center>
                                <h2 style="color:green; padding: 10px;">Hari Libur</h2>
                            <h3 style="color:red"><?= $libur ?></h3>


                                <img style="width:40%" src="<?= base_url() ?>/assets/img/libur.png" alt="">
                            </center>
                            
                        <?php endif; ?>



                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
        <?= $this->endSection(); ?>