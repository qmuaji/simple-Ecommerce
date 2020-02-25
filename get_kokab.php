<?php 

if (isset($_GET['provinsi_id'])) {
	
	require_once('koneksi.php');
	$provinsi_id	= $_GET['provinsi_id'];
	echo "<select id='kabupaten'>";
	echo "<option value='' >- Kota / Kabupaten -</option>";
    $kabupaten		=  mysql_query("select * from kota_kab where provinsi_id='$provinsi_id'");
    while($k 		=  mysql_fetch_array($kabupaten)){

        echo"<option value='$k[kokabID]'>$k[kokab_nama]</option>";
    }
    echo"</select>";

}else{
	require_once('admin/function.php');
	getKokab($_SESSION['pelanggan_kokab']);
}

