<?php 
$nota 		= getNota();
$kodeUnik 	= substr($nota, 6,10);
$pelangganID = $_SESSION['pelanggan'];

$tanggal = date("Y-m-d");
$anter   = date('Y-m-d', strtotime('+2days', strtotime($tanggal)));;

		$kokab 		= $_POST['kokab'];
		$ongkir 	= mysql_fetch_array(mysql_query("SELECT harga 
						 FROM ongkir
						 WHERE ongkirID=$kokab"));
		$alamtKirim  	= mysql_fetch_array(mysql_query("SELECT kokab_nama, provinsi_nama
													 FROM kota_kab, master_provinsi
													 WHERE kokabID = '$kokab'
													 AND kota_kab.provinsi_id = master_provinsi.provinsi_id"));

		$alamat 	= $_POST['alamat'].' '.$alamtKirim[0].' - '.$alamtKirim[1];
		if ($ongkir) {
			$hrgKirim   = $ongkir['harga'];
		}else{
			$hrgKirim   = 10000;
		}
	
	$subTotal 	= 0;
	$tBerat		= 0;	
	
	foreach ($_SESSION['cart'] as $id => $x) {	

		$result = mysql_query("SELECT hrg, berat, stok from barang
						   WHERE brgID = '$id'");
		$rows	= mysql_fetch_array($result);
		$hrg 	= $rows['hrg'];
		$total 	= $hrg * $x;
		$subTotal = $subTotal + $total;
		$berat 	= $rows['berat'] * $x;
		$tBerat = $tBerat + $berat;


		$result = mysql_query("INSERT INTO transaksi_detail SET 
						  transaksi_detailID = '$nota',
						  brgID 			 = '$id',
						  qty 				 = $x ");		

	} 

	$hrgKirim= $hrgKirim*$tBerat;

	$Gtotal = $subTotal + $hrgKirim + (intval($kodeUnik));
		$result = mysql_query("INSERT INTO transaksi SET 
			 					  transaksi_detailID	= '$nota',
			 					  tanggal 				= '$tanggal',
			 					  pengelolaID 			= 'admin',
			 					  PelangganID 			= '$pelangganID',
			 					  alamatKirim 			= '$alamat',
								  tglKirim				= '$anter',
								  totalOngkir			= $hrgKirim,
								  totalBayar 			= $Gtotal,
								  transfer 				= 'BELUM'")or die(mysql_error())	;
		
	if ($result) {
		?>
			<script>
			alert('Total biaya ongkos kirim Rp <?php echo number_format($hrgKirim,0,',','.')?>');

			document.location=('index.php?f=pesanan&id=<?php echo $nota ?>');
			</script>
		<?php
		unset($_SESSION['cart']);
	}else{
		echo "Gagal";
	}