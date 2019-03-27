<?php 	
if (isset($_SESSION['pelanggan'])) {


$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;

 ?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Histori Transaksi <?php echo $_SESSION['pelanggan_nama'] ?></h3>		

	 	<form action="index.php?f=history" method="post" id="inserts2">
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

      $result = mysql_query("SELECT * FROM transaksi
                   WHERE transaksi_detailID like '%$cari%' 
                   AND pelangganID = '$_SESSION[pelanggan]'
                   LIMIT $offset, $batas");
       $q    = mysql_query("SELECT COUNT(pesanID) from transaksi 
       						WHERE transaksi_detailID like '%$cari%'
       						AND pelangganID = '$_SESSION[pelanggan]'");
 
   
  ?>
  <div class="panel-heading"><h3>Hasil Cari :</h3></div>
  <?php

}else{
	
	$result = mysql_query("SELECT *	 FROM transaksi
						 WHERE pelangganID = '$_SESSION[pelanggan]' ORDER BY tanggal
						 LIMIT $offset, $batas") or die (mysql_error());
  	$q 		= mysql_query("SELECT COUNT(pesanID) from transaksi 
  						   WHERE pelangganID = '$_SESSION[pelanggan]' ");

} 
$no = $offset+1;?>
	
<form action="index.php?f=produk_act&act=mdel" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Tanggal</th>
					<th class='text-center'>Nota </th>
					<th class='text-center'>Total bayar <small><span class="label label-info">(Rp)</span></small></th>
					<th class='text-center'>Status</th>
					<th class='text-center'>-</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				while($rows = mysql_fetch_array($result)){
			
					$nm 	= $rows['tanggal'];
					$nm 	= date('d F, Y', strtotime($nm));
					$harga 	= $rows['totalBayar'];
					$kat 	= $rows['transaksi_detailID'];		
					$s 	= $rows['status2'];
					if ($s == 'PENDING') {
						$s = "<b style='color:red'> $s </b>";
					}else{
						$s = "<b style='color:green'> $s </b>";
					}

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-center'><small><?php echo $kat ?></small></td>
					<td class='text-right'>
						<span class="btn btn-default btn-inverse">
							<?php echo number_format($harga,0,',','.'); ?>
						</span>
					</td>					
					<td class='text-center'><?php echo $s ?></td>
					<td align="center">
						<a href="index.php?f=history_view&id=<?php echo $kat ?>" class="btn btn-info">Lihat</a> 
						<?php 
						if ($rows['status2'] == "PENDING"){
							echo "<a href='index.php?f=konfirmasi&id=$kat' class='btn btn-success'>Konfirmasi</a>" ;
						}else{
							echo "<a href='index.php?f=penjualan_print&id=$kat' target='blank' class='btn btn-default'><b class='glyphicon glyphicon-print'></b> Cetak</a>" ;
						}
						?>
					</td>
				</tr>
				<?php 
					$no++;	
				}
			 ?>
			</tbody>
		</table>
	</div>
</form>
<div class="col-md-offset-5">
	<ul class="pagination">
	<?php 

	
	  $jml 		= mysql_fetch_array($q);
	  $jmlData	= $jml[0];
	  $jmlPage	= ceil($jmlData / $batas);

	  if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=produk_view&page=".($noPage-1).">&laquo;</a></li>";

	  for($i=1; $i <= $jmlPage; $i++){

	    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

	      if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

	      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

	      if($i==$noPage) echo "<li class=active><a>$i</a></li>";

	      else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=produk_view&page=".$i." > ".$i."</a></li>";

	      $showPage=$i;
	    }  
	  }
	 
	  if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=produk_view&page=".($noPage+1).">&raquo;</a></li>";

?>
	</ul>
		
</div>
<div class="label label-danger">Total Data : <b><? echo $jmlData ?></b></div><br>
</div>
<?php }	else{
		?>
	<script>
		alert('Silahkan Login / Register terlebih dahulu!');
		document.location="index.php?f=user_register";
	</script>
	<?php
}