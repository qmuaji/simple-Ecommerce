<?php 	
$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;

 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Daftar Produk 			
			<a href="produk_pdf.php" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i> PDF</a>
			<a href="produk_xls.php" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i> Excel</a>
		</h3>
		

	 	<form action="index.php?f=produk_view" method="post" id="inserts2">
	        <div class="input-group col-sm-offset-8">
	          <input type="text" name="cari" class="form-control" placeholder="Cari nama produk...">
	          <span class="input-group-btn">
	            <button class="btn btn-default" type="submit">GO!</button>
	          </span>
	        </div>		   
	 	</form> 

		
	</div>   
<?php 

if(isset($_POST['cari'])){ 

  $cari=trim($_POST['cari']);  

      $result = mysql_query("SELECT * FROM barang,kategori
                   WHERE barang.nama like '%$cari%' 
                   AND barang.kategoriID = kategori.kategoriID
                   LIMIT $offset, $batas");
       $q    = mysql_query("SELECT COUNT(brgID) from barang WHERE nama like '%$cari%'");
 
   
  ?>
  <div class="panel-heading"><h3>Hasil Cari :  <?php echo $cari ?></h3></div>
  <?php

}else{
	
	$result = mysql_query("SELECT *, kategori 
						 FROM barang, kategori 
						 WHERE barang.kategoriID = kategori.kategoriID ORDER BY kategori.kategori
						 LIMIT $offset, $batas") or die (mysql_error());
  	$q 		= mysql_query("SELECT COUNT(brgID) from barang");

} 
$no = $offset+1;?>
	
<form action="index.php?f=produk_act&act=mdel" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Nama Produk</th>
					<th class='text-center'>Harga <small><span class="label label-info">(Rp)</span></small></th>
					<th class='text-center'>Kategori</th>
					<th class='text-center'>Image</th>
					<th class='text-center'>Stok</th>
					<th class='text-center'>
						<a href="index.php?f=produk_add" title='Tambah barang' class="btn btn-success"><b class="glyphicon glyphicon-plus"></b></a>
						<button type="submit" title="Hapus Semua" class="btn btn-danger"><b class="glyphicon glyphicon-trash"></b></button>
					</th>
					<td>
						<label class="btn btn-default">
							<input type="checkbox" id="cek" title="Pilih Semua">
						</label>
					</td>
				</tr>
			</thead>
			<tbody>
			<?php 

				while($rows = mysql_fetch_array($result)){
			
					$nm 	= $rows['nama'];
					$harga 	= $rows['hrg'];
					$kat 	= $rows['kategori'];
					$stok 	= $rows['stok'];				
					$img 	= $rows['images_name'];

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-right'>
							<?php echo number_format($harga,0,',','.'); ?>
					</td>
					<td class='text-center'><small><?php echo $kat ?></small></td>
					<td style='max-width: 90px'>
						<img class="img-responsive" src="../images/<?php echo $img ?>" alt="">
					</td>
					<td class='text-center'><?php echo $stok ?></td>
					<td class='text-center'>					
						<a href="index.php?f=produk_edit&id=<?php echo $rows['brgID']; ?>" class="btn btn-default" title="Edit <?php echo $nm ?>"><b class="glyphicon glyphicon-edit"></b></a>
						<a href="index.php?f=produk_act&act=delete&id=<?php echo $rows['brgID']; ?>" class="btn btn-warning" title="Hapus <?php echo $nm ?>"><b class="glyphicon glyphicon-trash"></b></a>		
					</td>

					<td>
						<label class="btn btn-default">
							<input type="checkbox" class="checkbox1" name="check[]" value="<?php echo $rows['brgID'] ?>">							
						</label>						
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
<div class="label label-danger">Total Data : <b><?php echo $jmlData ?></b></div><br>
</div>
