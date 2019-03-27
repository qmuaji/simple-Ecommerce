<?php 

require_once('../koneksi.php');

session_start();

if(strcmp($_SESSION['code0'], $_POST['code']) != 0){
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
	$pass 		= mysql_escape_string($_POST['pass4']);
	$email 		= trim($_POST['email']);
	$nama 		= trim($_POST['fullName']);
	$jk			= $_POST['jk'];
	$alamat		= trim($_POST['alamat']);	
	$kokabID	= $_POST['kokab'];
	$tlp		= trim($_POST['tlp']); 				

/*	$sama = mysql_query("SELECT nama_lengkap FROM pelanggan WHERE nama_lengkap='$nama'");
	$sama2 = mysql_query("SELECT email FROM pelanggan WHERE email='$email'");

	$cek_nama = mysql_num_rows($sama);
	$cek_email = mysql_num_rows($sama2);

	if($cek_email > 0){
		?>
		<script>
			alert('Email user telah digunakan, Silahkan masukan email lain!');
			history.back();
		</script>
		<?
	}*/
			
	if ($pass == "") {
		$result = mysql_query("UPDATE pelanggan SET
		nama_lengkap	= '$nama',
		email			= '$email',
		jk				= '$jk',
		alamat			= '$alamat',
		kokabID			= $kokabID,
		tlp 			= '$tlp' WHERE pelangganID	= '$id'");
	}else{
		$result = mysql_query("UPDATE pelanggan SET
		nama_lengkap	= '$nama',
		email			= '$email',
		jk				= '$jk',
		alamat			= '$alamat',
		kokabID			= $kokabID,
		password		= '$pass',
		tlp 			= '$tlp' WHERE pelangganID	= '$id'");

	}

	if ($result) {
		?>
			<script>
				alert('Data berhasil diubah.');
				document.location=('index.php?f=pelanggan_view');
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
