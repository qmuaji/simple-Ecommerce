<?php 	
if (isset($_SESSION['pengelola'])) {


$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;

 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Order Masuk </h3>

	 	<form action="index.php?f=konfirmasi_user" method="post" id="inserts2">
	        <div class="input-group col-sm-offset-8">
	          <input type="text" name="cari" class="form-control" placeholder="Cari nota">
	          <span class="input-group-btn">
	            <button class="btn btn-default" type="submit">GO!</button>
	          </span>
	        </div>		   
	 	</form> 

		
	</div>   
<?php 

if(isset($_POST['cari'])){ 

  $cari=trim($_POST['cari']);  

      $result = mysql_query("SELECT * FROM konfirmasi
                   WHERE transaksi_detailID like '%$cari%' 
                   LIMIT $offset, $batas");
       $q    = mysql_query("SELECT COUNT(konfirmasiID) from konfirmasi 
       						WHERE transaksi_detailID like '%$cari%' ORDER BY konfirmasiID desc");
 
   
  ?>
  <div class="panel-heading"><h3>Hasil Cari :  <?php echo $cari ?></h3></div>
  <?php

}else{
	
	$result = mysql_query("SELECT * FROM konfirmasi 
						   ORDER BY konfirmasiID desc
						   LIMIT $offset, $batas") or die (mysql_error());
  	$q 		= mysql_query("SELECT COUNT(konfirmasiID) from konfirmasi ");

} 
$no = $offset+1;?>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>					
					<th class='text-center'>Tanggal Transfer</th>
					<th class='text-center'>Nota </th>
					<th class='text-center'>Total Transfer<small><span class="label label-info">(Rp)</span></small></th>
					<th class='text-center'>Nama Pengirim</th>
					<th class='text-center'>Bank Pengirim</th>
					<th class='text-center'>Bank Tujuan</th>	
					<th class='text-center'>Catatan</th>
				<!-- 	<th class='text-center'>-</th>		 -->			
				</tr>
			</thead>
			<tbody>
			<?php 

				while($rows = mysql_fetch_array($result)){
			
				$nota 			= ($rows['transaksi_detailID']);
				$nama_pengirim 	= ($rows['nama_pengirim']);
				$bank_pengirim	= ($rows['bank_pengirim']);
				$bank_tujuan	= ($rows['bank_tujuan']);
				$tanggal_tras	= ($rows['tanggal_transfer']);
				$jumlah_trans	= ($rows['jumlah_transfer']);
				$catatan		= ($rows['catatan']);

/*					if ($st == "PENDING") {
						$s = "btn btn-warning";
					}else{
						$s = "btn btn-success";
					}
*/
				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>	
					<td>
						<small><?php echo date('d F, Y', strtotime($tanggal_tras)); ?></small>
					</td>				
					<td class='text-center'>
						<small><?php echo $nota ?></small>
						<a href="index.php?f=detail_view&id=<?php echo $nota ?>" class="btn btn-info">Lihat</a>	
					</td>
					
					<td class='text-right'>
							<?php echo number_format($jumlah_trans,0,',','.'); ?>
					</td>					
					<td class="text-center"><?php echo $nama_pengirim ?></td>
					<td class="text-center">
						<?php echo $bank_pengirim ?>
					</td>					
					<td class='text-center'>
							<?php 	echo $bank_tujuan						 ?>
					</td>
					<td>
						<p><?php echo $catatan ?></p>				
					</td> 
<!-- 					<td class='text-center'>
	<a href="hapus_korfir.php&id=<?php echo $nota ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
</td> -->
	
				</tr>
			

				<tr></tr>
				<?php 
					$no++;	
				}
			 ?></tbody>
		</table>	 
			
		
	</div>

<div class="col-md-offset-5">
	<ul class="pagination">
	<?php 

	
	  $jml 		= mysql_fetch_array($q);
	  $jmlData	= $jml[0];
	  $jmlPage	= ceil($jmlData / $batas);

	  if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=penjualan_view&page=".($noPage-1).">&laquo;</a></li>";

	  for($i=1; $i <= $jmlPage; $i++){

	    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

	      if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

	      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

	      if($i==$noPage) echo "<li class=active><a>$i</a></li>";

	      else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=penjualan_view&page=".$i." > ".$i."</a></li>";

	      $showPage=$i;
	    }  
	  }
	 
	  if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=penjualan_view&page=".($noPage+1).">&raquo;</a></li>";

?>
	</ul>
		
</div>
<div class="label label-danger">Total Data : <b><?php echo $jmlData ?></b></div><br>
</div>
<?php }	else{
		?>
	<script>
		alert('Silahkan Login / Register terlebih dahulu!');
		document.location="index.php?f=user_register";
	</script>
	<?php
}
/*
echo date('dmy')."<br>";
echo getNota();*/