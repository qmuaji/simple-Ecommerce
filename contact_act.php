<?php 
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


	$email 		= trim($_POST['email']);
	$nama 		= trim($_POST['nama']);
	$komentar	= trim($_POST['komentar']);	
			


			
	$result = mysql_query("INSERT INTO buku_tamu SET
	nama	= '$nama',
	email	= '$email',
	komentar= '$komentar'");

	if ($result) {
		?>
			<script>
				alert('Terimakasih :)');
				document.location=('index.php');
			</script>

		<?php
		

	}/*else{
		?>
			<script>
				alert('Gagal : Username telah digunakan, Silahkan input username lain!');
				history.back();
			</script>
		<?php	
		
	}*/
}

