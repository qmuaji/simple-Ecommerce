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
	$nota 			= $_GET['id'];
	$nama_pengirim 	= mysql_escape_string($_POST['fullName']);
	$bank_pengirim	= mysql_escape_string($_POST['bank_pengirim']);
	$bank_tujuan	= mysql_escape_string($_POST['bank_tujuan']);
	$tanggal_tras	= ($_POST['tanggal_transfer']);
	$jumlah_trans	= mysql_escape_string($_POST['harga']);
	$catatan		= mysql_escape_string($_POST['catatan']);
			
	$totalBayar = mysql_fetch_assoc(mysql_query("SELECT totalBayar from transaksi WHERE transaksi_detailID = '$nota'"));

	if ($jumlah_trans < $totalBayar['totalBayar']){
		?>
		<script>
			alert('Maaf, jumlah transfer kurang !');
			history.back();
		</script>
		<?php	exit();
	}else{
		$result = mysql_query("INSERT INTO konfirmasi SET
		transaksi_detailID	= '$nota',
		bank_pengirim		= '$bank_pengirim',
		bank_tujuan			= '$bank_tujuan',
		tanggal_transfer	= '$tanggal_tras',
		jumlah_transfer		= $jumlah_trans,
		nama_pengirim		= '$nama_pengirim',
		catatan   			= '$catatan'");

		if ($result) {
			mysql_query("UPDATE transaksi SET status2 = 'PROCESS' WHERE transaksi_detailID ='$nota'");
			?>
				<script>
					alert('Data berhasil disimpan. Silahkan tunggu konfirmasi dari Admin');
					document.location=('index.php?f=history&id=<?php echo $nota ?>');
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

