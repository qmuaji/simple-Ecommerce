<?php 
function getBP() {

	echo "<option value='' >- Bank Pengirim -</option>";
	$query = mysql_query("SELECT * FROM bank");

	while ($row = mysql_fetch_row($query)) {

			echo "<option value='$row[1]'> " . ucwords($row[1]) . " </option>";

	}
}

function getBT() {

	echo "<option value='' >- Bank Tujuan -</option>";
	echo "<option value='BAC 234-432-234' >BAC 234-432-234</option>";
	echo "<option value='Mandiri 123-321-123' >Mandiri 123-321-123</option>";
	echo "<option value='BNI 432-543-543' >BNI 432-543-543</option>";

}


function getKategori($kode) {

	echo "<option value='' >- Kategori -</option>";
	$query = mysql_query("SELECT kategoriID,kategori FROM kategori");

	while ($row = mysql_fetch_row($query)) {

		if ($kode == ""){
			echo "<option value='$row[0]'> " . ucwords($row[1]) . " </option>";
		}else{
			echo "<option value='$row[0]'" . selected($row[0], $kode) . "> " . ucwords($row[1]) . " </option>";
		}
	}
}

function getProvinsi($kode) {

	echo "<option value='' >- Provinsi -</option>";
	$query = mysql_query("SELECT * FROM master_provinsi");

	while ($row = mysql_fetch_row($query)) {

		if ($kode == ""){
			echo "<option value='$row[0]'> " . ucwords($row[1]) . " </option>";
		}else{
			echo "<option value='$row[0]'" . selected($row[0], $kode) . "> " . ucwords($row[1]) . " </option>";
		}
	}
}

function getKokab($a) {

	echo "<option value='' >- Kota/Kabupaten -</option>";
	$query = mysql_query("SELECT * FROM kota_kab");

	while ($row = mysql_fetch_row($query)) {

		if ($a == ""){
			echo "<option value='$row[0]'> " . ucwords($row[1]) . " </option>";
		}else{
			echo "<option value='$row[0]'" . selected($row[0], $a) . "> " . ucwords($row[1]) . " </option>";
		}
	}
}

function getJK($kode) {

	echo "<option value='' >- Jenis kelamin -</option>";
	$query = mysql_query("SELECT distinct jk FROM pelanggan");

	while ($row = mysql_fetch_row($query)) {

		if ($kode == ""){
			echo "<option value='$row[0]'> " . ucwords($row[0]) . " </option>";
		}else{
			echo "<option value='$row[0]'" . selected($row[0], $kode) . "> " . ucwords($row[0]) . " </option>";
		}
	}
}


function selected($t1, $t2) {

	if(trim($t1) == trim($t2)) return "selected";
	else return "";

}

// Anti SQL injection
function anti_sql_injection( $input ) {

	// daftarkan perintah-perintah SQL yang tidak boleh ada
	// dalam query dimana SQL Injection mungkin dilakukan
	$aforbidden = array (
	"insert", "select", "update", "delete", "truncate",
	"replace", "drop", " or ", ";", "#", "–", "=" );

	// lakukan cek, input tidak mengandung perintah yang tidak boleh
	$breturn=true;
	foreach($aforbidden as $cforbidden) {

		if(strripos($input, $cforbidden)){
			$breturn=false;
			break;
		}
	}
	return $breturn;
}

function format_rupiah($rp) {
	$hasil = "Rp." . number_format($rp, 0, "", ".") . ",00";
	return $hasil;
}

function getDay($tgl,$sep){
    $sepparator = $sep; //separator. contoh: '-', '/'
    $parts = explode($sepparator, $tgl);
    $d = date("l", mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));

    if ($d=='Monday'){
        return 'Senin';
    }elseif($d=='Tuesday'){
        return 'Selasa';
    }elseif($d=='Wednesday'){
        return 'Rabu';
    }elseif($d=='Thursday'){
        return 'Kamis';
    }elseif($d=='Friday'){
        return 'Jumat';
    }elseif($d=='Saturday'){
        return 'Sabtu';
    }elseif($d=='Sunday'){
        return 'Minggu';
    }else{
        return 'ERROR!';
    }
}

function getNota(){
	
	$result = mysql_query("SELECT transaksi_detailID FROM transaksi");
	$nota 	= mysql_fetch_array($result);
	$date 	= date('dmy');
	$date2	= date('ymd');
	
	if ($nota == 0){
		$nota = $date.'0001';
	}else{
		$result = mysql_query("SELECT MAX(transaksi_detailID) as nota from transaksi 
								WHERE transaksi_detailID IN(SELECT MAX(transaksi_detailID))
								AND tanggal='$date2'");
		$row 	= mysql_fetch_assoc($result);
		$nota	= $row['nota'];
		$ambil	= substr($nota, 0,6);
		if ($date == $ambil){
			$nota = substr($nota, 5,10)+1;
			$nota = substr($date, 0,5).$nota;
		}else{
			$nota = $date.'0001';
		}
	}
	return $nota;
}