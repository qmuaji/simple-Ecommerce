<?php 

require('koneksi.php');

session_start();
$act 	= $_GET['act'];
$user 	= mysql_escape_string($_POST['username']);
$pass 	= mysql_escape_string($_POST['password']);

if(isset($_GET['act'])){

	if($act == 1){

		$result = mysql_query("	SELECT * FROM pelanggan 
								WHERE pelangganID	= '$user' 
								AND password		= '$pass'
								AND status 			= 'Y'");
		$s = mysql_num_rows($result);

		if ($s == 1) {

			$row = mysql_fetch_array($result);
		 	$_SESSION['pelanggan'] 		= $row['pelangganID'];
		 	$_SESSION['pelanggan_nama'] = $row['nama_lengkap'];
		 	$_SESSION['pelanggan_kokab'] = $row['kokabID'];
		 	$_SESSION['pelanggan_alamat'] = $row['Alamat'];
		 	$_SESSION['pelanggan_email'] = $row['email'];
		 	$_SESSION['pelanggan_tlp'] = $row['tlp'];
		 	if (isset($_SESSION['cart'])) {
		 		header("location:index.php?f=cart&act=none");
		 	}else{
		 		header("location:index.php");
		 	}
		 	
		 }else{
		 	?>
				<script>
					alert('Username / Password salah!');
					history.back();
				</script>
		 	<?php
		 } 

	}else if ($act == 0) {
		unset($_SESSION['cart']);
		unset($_SESSION['pelanggan']);
		unset($_SESSION['pelanggan_nama']);
		unset($_SESSION['pelanggan_alamat']);
		unset($_SESSION['pelanggan_kokab']);
		unset($_SESSION['pelanggan_email']);
		unset($_SESSION['pelanggan_tlp']);
		//session_destroy();
		header("location:index.php");
	}

}else{
	
	header("location:index.php");
	die();
}
