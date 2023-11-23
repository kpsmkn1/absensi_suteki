function getIdPengguna_delete(id){
	var arefid = document.getElementById('arefid');
	var url    = document.getElementById('base_url');
	arefid.setAttribute("href", url.value+"/delete_pengguna/"+id);
}


function getIdjabatan_delete(id){
	var arefid = document.getElementById('arefid');
	var url    = document.getElementById('base_url');
	arefid.setAttribute("href", url.value+"/delete_jabatan/"+id);
}

function getIdgolongan_delete(id){
	var arefid2 = document.getElementById('arefid2');
	var url    = document.getElementById('base_url');
	arefid2.setAttribute("href", url.value+"/delete_golongan/"+id);
}

function changeSelect(e){
	var url    = document.getElementById('base_url');

	location.href = url.value+"/laporan/"+e.value;
}

function jam_edit(nama_,id_,jam1_,jam2_){
	var juduljam = document.getElementById('juduljam');
	var jam1 = document.getElementById('jam1');
	var jam2 = document.getElementById('jam2');
	var id = document.getElementById('jamKerja');

	juduljam.innerHTML = nama_;
	jam1.value = jam1_;
	jam2.value = jam2_;
	id.value = id_;

}

function getIdPengguna_edit(id,nama,jabatan,nip,email,password,status,role,grade,golongan){

	document.getElementById('id_user').value = id;
	document.getElementById('nama').value = nama;
	document.getElementById('nip').value = nip;
	document.getElementById('email').value = email;
	document.getElementById('password').value = password;
	document.getElementById('grade').value = grade;
	document.getElementById('golongan').value = golongan;
	document.getElementById('jabatan').value = jabatan;
	document.getElementById('role').value = role;
	document.getElementById('status').value = status;
}

function currentTime() {
  let date = new Date(); 
  let hh = date.getHours();
  let mm = date.getMinutes();
  let ss = date.getSeconds();
  let session = "WIB";

  if(hh == 0){
      hh = 12;
  }
  if(hh > 12){
      hh = hh - 12;
      session = "PM";
   }

   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = hh + ":" + mm + ":" + ss + " " + session;

  document.getElementById("clock").innerText = time; 
  let t = setTimeout(function(){ currentTime() }, 1000);
}

currentTime();



function getIdharilibur_delete(id){
	var hreflibur = document.getElementById('hreflibur');
	var url    = document.getElementById('base_url');
	hreflibur.setAttribute("href", url.value+"/delete_harilibur/"+id);
}

function getIdharilibur_edit(id,nama,tanggal){
	document.getElementById('idLibur').value = id;
	document.getElementById('nama').value = nama;
	document.getElementById('tanggal').value = tanggal;
}

function gantijenisabsen(e) {
	var data = e.value;


	if (data == 'WFO') {
		document.getElementById('tampil').innerHTML = '<h4>Catatan</h4> <p>1. Pastikan Kamu Terhubung Dengan WIFI Kantor</p> <p>2. Alamat IP Yang Berbeda Akan Ditolak Untuk ABSEN</p> <p>3. Hubungi Admin Untuk Mengecek List IP jaringan kantor Jika ada kendala di saat absensi</p> ';

/* ==================================================================== */
	if(navigator.onLine){
	  document.getElementById('ipku').value = 'Loading...';
	 } else {
	  return document.getElementById('ipku').value = 'Connection Error!';
	 }
	var a    = document.getElementById('base_url');
	 var xhr = new XMLHttpRequest();
            var url = a.value+"/ajax_online";
            xhr.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    //document.getElementById("hasil").innerHTML = this.responseText;
                    
                    if (this.responseText) {
                    	return document.getElementById('ipku').value = this.responseText;
                    }else {
                    	//document.getElementById('tampil').innerHTML = 'Error Connection !';
                    }
                }else {
                	
                }
            };
            xhr.open("GET", url, true);
            xhr.send();



            document.getElementById('btn_absen').style.display = 'none';
			document.getElementById('btn_foto').style.display = 'none';

document.getElementById('foto').removeAttribute('required');


	}else {
		document.getElementById('tampil').innerHTML = '<h4>Catatan</h4><p>1. Pastikan Untuk Mengaktifkan Lokasi Di Device Anda</p> <p>2. Absensi Akan Ditolak Apabila lokasi tidak di aktifkan</p>';
		document.getElementById('btn_absen').style.display = 'block';
		document.getElementById('btn_foto').style.display = 'block';
		document.getElementById('foto').setAttribute('required', '');
		getLocation();

	}
}

var lokasi = document.getElementById('lokasi');

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    lokasi.value = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  lokasi.value = "Latitude: " + position.coords.latitude +
  " | Longitude: " + position.coords.longitude;


}


function ajax_online(){
	 if(navigator.onLine){
	  document.getElementById('tampil').innerHTML = 'Loading... !';
	 } else {
	  return document.getElementById('tampil').innerHTML = 'Hubungkan Ke Internet Untuk Melihat Alamat IP !';
	 }
	var a    = document.getElementById('base_url');
	 var xhr = new XMLHttpRequest();
            var url = a.value+"/ajax_online";
            xhr.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    //document.getElementById("hasil").innerHTML = this.responseText;
                    
                    if (this.responseText) {
                    	return document.getElementById('tampil').innerHTML = this.responseText;
                    }else {
                    	//document.getElementById('tampil').innerHTML = 'Error Connection !';
                    }
                }else {
                	
                }
            };
            xhr.open("GET", url, true);
            xhr.send();
}