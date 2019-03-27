<?php 	
/*$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;*/
if(isset($_POST['cari'])){ 

  $cari=trim($_POST['cari']);  

      $result = mysql_query("SELECT images_name, nama, hrg, sum(qty)as qty, stok as sisa 
							FROM barang,transaksi_detail,transaksi
							Where transaksi.transaksi_detailID=transaksi_detail.transaksi_detailID
							AND transaksi_detail.brgID=barang.brgID
							AND transaksi.status2='COMPLETED'
							AND nama like '%$cari%'
							GROUP BY nama
							ORDER BY qty desc ");
 
   
  ?>
  <div class="panel-heading"><h3>Hasil Cari :  <?php echo $cari ?></h3></div>
  <?php

}else{
	$cari="";
	$result = mysql_query("SELECT images_name, nama, hrg, sum(qty)as qty, stok as sisa 
							FROM barang,transaksi_detail,transaksi
							Where transaksi.transaksi_detailID=transaksi_detail.transaksi_detailID
							AND transaksi_detail.brgID=barang.brgID
							AND transaksi.status2='COMPLETED'
							GROUP BY nama
							ORDER BY qty desc ") or die (mysql_error());

} 
$no = 1;
 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Laporan Produk Terlaris</a>
		</h3>
		
	 	<form action="index.php?f=laporan_laris" method="post" id="inserts2">
	        <div class="input-group col-sm-offset-8">
	          <input type="text" name="cari" class="form-control" placeholder="Cari nama produk...">
	          <span class="input-group-btn">
	            <button class="btn btn-default" type="submit">GO!</button>
	          </span>
	        </div>		   
	 	</form> 

		
	</div>   
	
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Gambar</th>
					<th class='text-center'>Nama Produk</th>
					<th class='text-center'>Harga / unit <small><span class="label label-info">(Rp)</span></small></th>
					<th class='text-center'>Terjual</th>
					<th class='text-center'>Sisa</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$total 	= 0;
				$no 	= 1;
				while($rows = mysql_fetch_array($result)){
					$img 	= $rows['images_name'];
					$nm 	= $rows['nama'];
					$harga 	= $rows['hrg'];
					$stok 	= $rows['sisa'];		
					$laris 	= $rows['qty'];		
				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td style='max-width: 90px'>
						<img class="img-responsive" src="../images/<?php echo $img ?>" alt="">
					</td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-right'>
							<?php echo number_format($harga,0,',','.'); ?>
	
					</td>
					<td class='text-center'><small><?php echo $laris ?></small></td>
					<td class='text-center'><?php echo $stok ?></td>
				</tr>

				<?php 
					$no++;	
				}
			 ?>
			</tbody>
		</table>
	</div>
<!-- <div class="col-md-offset-5">
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
 -->