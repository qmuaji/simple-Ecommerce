<?php 
if ($_GET['id']) {
	$status = $_POST['transfer'];
	$id=$_GET['id'];


		
			$h=mysql_query("UPDATE transaksi SET transfer = '$status' WHERE transaksi_detailID='$id'");	

	if ($h) {
		?>
		<script>
			alert('Transfer berhasil di ubah !');
			document.location="index.php?f=detail_view&id=<?php echo $id ?>"
		</script>
		<?php
	}else{
		?>
		<script>
			alert('Stok tidak tersedia !');
			document.location="index.php?f=detail_view&id=<?php echo $id ?>"
		</script>
		<?php
	}
}