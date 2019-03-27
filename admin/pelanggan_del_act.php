<?php 
if (isset($_GET['id'])) {

	include('../koneksi.php');
	$id=$_GET['id'];
	$act=$_GET['act'];

	if ($act=='Y') {
		$result = mysql_query("UPDATE pelanggan 
						SET status = 'N' 
						WHERE pelangganID = '$id'")or die (mysql_error());
			if ($result) {
		?>
			<script>
				alert('User berhasil di non aktifkan !');
				document.location=('index.php?f=pelanggan_view');
			</script>

		<?php
		}
	}else{
		$result = mysql_query("UPDATE pelanggan 
						SET status = 'Y' 
						WHERE pelangganID = '$id'")or die (mysql_error());
			if ($result) {
		?>
			<script>
				alert('User berhasil di aktifkan !');
				document.location=('index.php?f=pelanggan_view');
			</script>

		<?php
		}

	}


/*else{
		?>
			<script>
				alert('Gagal !');
				history.back();
			</script>
		<?php	
		
	}*/
}