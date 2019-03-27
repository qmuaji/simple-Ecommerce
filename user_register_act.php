<?php 
//$result = false;
require_once('koneksi.php');
session_start();

if(strcmp($_SESSION['code'], $_POST['code']) != 0){
	?>
	<script>
		alert('Gagal : Captcha Salah, silahkan ulangi!');
		history.back();
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	</script>
	<?php

}else{ 		

	$id 		= mysql_escape_string($_POST['username']);
	$pass 		= mysql_escape_string($_POST['pass2']);
	$email 		= mysql_escape_string($_POST['email']);
	$nama 		= mysql_escape_string($_POST['fullName']);
	$jk			= $_POST['jk'];
	$alamat		= mysql_escape_string($_POST['alamat']);	
	$kokabID	= $_POST['kokab'];
	$tlp		= mysql_escape_string($_POST['tlp']); 				

	$sama = mysql_query("SELECT pelangganID FROM pelanggan WHERE pelangganID='$id'");
	$sama2 = mysql_query("SELECT email FROM pelanggan WHERE email='$email'");

	$cek_nama = mysql_num_rows($sama);
	$cek_email = mysql_num_rows($sama2);

	if(($cek_nama > 0) || ($cek_email > 0)){
		?>
		<script>
			alert('Maaf, username/email telah digunakan!');
			history.back();
		</script>
		<?php
		exit();
	}else{			
		$result = mysql_query("INSERT INTO pelanggan SET
		pelangganID		= '$id',
		nama_lengkap	= '$nama',
		password		= '$pass',
		email			= '$email',
		jk				= '$jk',
		alamat			= '$alamat',
		kokabID			= $kokabID,
		tlp 			= '$tlp'");

		if ($result) {
			?>
				<script>
					alert('Data berhasil disimpan. Silahkan Login');
					document.location=('index.php?f=user_register');
				</script>

			<?php
			

		}else{
			?>
				<script>
					alert('Gagal !');
					history.back();
				</script>
			<?php	
			
		}
	}
}
