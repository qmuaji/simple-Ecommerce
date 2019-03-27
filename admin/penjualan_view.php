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

	 	<form action="index.php?f=penjualan_view" method="post" id="inserts2">
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

      $result = mysql_query("SELECT *,transaksi.status2  as st  FROM transaksi,pelanggan
                   WHERE transaksi_detailID like '%$cari%' 
                   AND pelanggan.pelangganID=transaksi.pelangganID
                   LIMIT $offset, $batas");
       $q    = mysql_query("SELECT COUNT(pesanID) from transaksi 
       						WHERE transaksi_detailID like '%$cari%' ORDER BY tanggal desc, transaksi_detailID desc");
 
   
  ?>
  <div class="panel-heading"><h3>Hasil Cari :  <?php echo $cari ?></h3></div>
  <?php

}else{
	
	$result = mysql_query("SELECT *,transaksi.status2  as st FROM transaksi,pelanggan 
						   WHERE pelanggan.pelangganID=transaksi.pelangganID ORDER BY tanggal desc, transaksi_detailID desc
						   LIMIT $offset, $batas") or die (mysql_error());
  	$q 		= mysql_query("SELECT COUNT(pesanID) from transaksi ");

} 
$no = $offset+1;?>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>					
					<th class='text-center'>Nota </th>
					<th class='text-center'>Tanggal</th>
					<th class='text-center'>Total bayar <small><span class="label label-info">(Rp)</span></small></th>
					<th class='text-center'>Nama Pelanggan</th>
					<!-- <th class='text-center'>Transfer</th> -->
					<th class='text-center' colspan="5">Status</th>					
				</tr>
			</thead>
			<tbody>
			<?php 

				while($rows = mysql_fetch_array($result)){
			
					$nm 	= $rows['tanggal'];
					$nm 	= date('d F, Y', strtotime($nm));
					$harga 	= $rows['totalBayar'];
					$kat 	= $rows['transaksi_detailID'];
					$stok 	= $rows['nama_lengkap'];	
					$trans 	= $rows['transfer'];			
					$st 	= $rows['st'];
					if ($st == "PENDING") {
						$s = "btn btn-warning";
					}else{
						$s = "btn btn-success";
					}

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>					
					<td class='text-center'><small><?php echo $kat ?></small></td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-right'>
						<span class="btn btn-default btn-inverse">
							<?php echo number_format($harga,0,',','.'); ?>
						</span>
					</td>					
					<td><?php echo $stok ?></td>
		<!-- 			<td class="text-center">
						<?php echo $trans ?>
					</td>	 -->				
					<td class='text-center'>
						<?php echo $st ?>
					</td>
					<td class='text-center'>
						<a href="index.php?f=detail_view&id=<?php echo $kat ?>" class="<?php echo $s ?>">Lihat</a>						
					</td>
				</tr>
				<?php 
					$no++;	
				}
			 ?>
			 <tr></tr>
			</tbody>
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