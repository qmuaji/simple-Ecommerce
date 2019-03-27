<script type="text/javascript">
  if (window.print) {
    document.write();
  }
  setTimeout('window.print()', 1000);
  setTimeout('TO_INDEX()', 1200);
</script>
<?php 
if(isset($get['cari'])){ 

  $cari=trim($get['cari']);  

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
		<h3>Laporan Stok Produk</h3>
		
	</div>   
	
<form action="index.php?f=produk_act&act=mdel" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>Kode</small></th>
					<th class='text-center'>Nama Barang</th>
					<th class='text-center'>Harga / unit </th>
					<th class='text-center'>Kategori</th>
					<th class='text-center'>Stok</th>
					<th colspan="4" class='text-center'>Nilai </th>

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