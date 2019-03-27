<?php 
if ($_GET['id']) {
	$status = $_POST['status'];
	$id=$_GET['id'];


	$result = mysql_query("SELECT barang.brgID FROM barang, transaksi_detail
					 WHERE transaksi_detailID = '$id'
					 AND transaksi_detail.brgID = barang.brgID") or die (mysql_error());

	$update = mysql_fetch_assoc($result);
	if ($status == 'COMPLETED'){
		foreach($update as $a => $b){
		
			$h=mysql_query("UPDATE barang SET
								stok 		= stok - (select qty from transaksi_detail where transaksi_detailID=$id and brgID=$b)
								WHERE brgID	= $b");	
		}
	}else{
		foreach($update as $a => $b){

			$h=mysql_query("UPDATE barang SET
								stok 		= stok + (select qty from transaksi_detail where transaksi_detailID=$id and brgID=$b)
								WHERE brgID	= $b");	
		}
	}
	if ($h) {
		$q = mysql_query("UPDATE transaksi SET
					status2 = '$status'
					WHERE transaksi_detailID=$id");	
	}else{
		$q = "";
	}
	
//var_dump($update);
	if ($q) {
		?>
		<script>
			alert('Status berhasil di ubah !');
			document.location="index.php?f=detail_view&id=<?php echo $id ?>";
		</script>
		<?php
	}else{
		?>
		<script>
			alert('Stok tidak tersedia !');
			document.location="index.php?f=detail_view&id=<?php echo $id ?>";
		</script>
		<?php
	}
}