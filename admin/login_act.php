<?php 

require('../koneksi.php');

session_start();
$act 	= $_GET['act'];
$user 	= mysql_escape_string($_POST['username']);
$pass 	= mysql_escape_string($_POST['password']);

if(isset($_GET['act'])){

	if($act == 1){

		$result = mysql_query("	SELECT * FROM pengelola 
								WHERE pengelolaID	= '$user' 
								AND pass			= '$pass'");
		$s = mysql_num_rows($result);

		if ($s == 1) {

			$row = mysql_fetch_array($result);
		 	$_SESSION['pengelola'] 		= $row['pengelolaID'];
		 	$_SESSION['pengelola_nama'] = $row['nama_lengkap'];
		 	$_SESSION['pengelola_level']= $row['level'];
		 	header("location:index.php");
		 }else{
		 	?>
				<script>
					alert('Username / Password salah!');
					history.back();
				</script>
		 	<?php
		 } 

	}else if ($act == 0) {

		unset($_SESSION['pengelola']);
		unset($_SESSION['pengelola_nama']);
		//session_destroy();
		header("location:../admin/");
	}

}else{
	
	header("location:../admin/");
	die();
}
