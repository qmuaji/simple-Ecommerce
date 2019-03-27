<?php 	
/*$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;*/
if(isset($_POST['cari'])){ 

  $cari=trim($_POST['cari']);  

      $result = mysql_query("SELECT * , hrg*stok as nilai FROM barang,kategori
                   WHERE barang.nama like '%$cari%' 
                   AND barang.kategoriID = kategori.kategoriID ORDER BY stok asc");
 
   
  ?>
  <div class="panel-heading"><h3>Hasil Cari :  <?php echo $cari ?></h3></div>
  <?php

}else{
	$cari="";
	$result = mysql_query("SELECT *, kategori, hrg*stok as nilai  
						 FROM barang, kategori 
						 WHERE barang.kategoriID = kategori.kategoriID ORDER BY stok asc") or die (mysql_error());

} 
$no = 1;
 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Laporan Stok Produk		
			<a href="?f=laporan_stok_print&cari=<?php echo $cari ?>" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Print</a>
			<a href="laporan_stok_xls.php?cari=<?php echo $cari ?>" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i> Excel</a>
		</h3>
		
	 	<form action="index.php?f=laporan_stok" method="post" id="inserts2">
	        <div class="input-group col-sm-offset-8">
	          <input type="text" name="cari" class="form-control" placeholder="Search...">
	          <span class="input-group-btn">
	            <button class="btn btn-default" type="submit">GO!</button>
	          </span>
	        </div>		   
	 	</form> 

		
	</div>   
	
<form action="index.php?f=produk_act&act=mdel" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>Kode</small></th>
					<th class='text-center'>Nama Barang</th>
					<th class='text-center'>Harga / unit <small><span class="label label-info">(Rp)</span></small></th>
					<th class='text-center'>Kategori</th>
					<th class='text-center'>Stok</th>
					<th colspan="4" class='text-center'>Nilai <small><span class="label label-info">(Rp)</span></small></th>

				</tr>
			</thead>
			<tbody>
			<?php 
				$total=0;
				while($rows = mysql_fetch_array($result)){
					$kode 	= $rows['brgID'];
					$nm 	= $rows['nama'];
					$harga 	= $rows['hrg'];
					$kat 	= $rows['kategori'];
					$stok 	= $rows['stok'];		
					$nilai 	= $rows['nilai'];	
					$total  = $total+$nilai;	

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $kode ?></small></td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-right'>
							<?php echo number_format($harga,0,',','.'); ?>
	
					</td>
					<td class='text-center'><small><?php echo $kat ?></small></td>
					<td class='text-center'><?php echo $stok ?></td>
					<td class='text-right'>
						<?php echo number_format($nilai,0,',','.'); ?>
					</td>
				</tr>

				<?php 
					$no++;	
				}
			 ?>
			 	<tr>
					<th colspan="5" class='text-center'>Total</th>
					<th class='text-right'><?php echo number_format($total,0,',','.') ?></th>
				</tr>

			</tbody>
		</table>
	</div>
</form>
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