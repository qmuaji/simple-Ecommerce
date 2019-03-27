<?php 	
if (isset($_GET['id'])) {
	$nota = $_GET['id'];

 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Rincian Belanja </h3>
		
	</div>   
<?php 


	$result = mysql_query("SELECT * FROM barang, transaksi_detail 
					 WHERE transaksi_detailID = '$nota'
					 AND transaksi_detail.brgID = barang.brgID") or die (mysql_error());
	$q3 	= mysql_query("SELECT * from transaksi where transaksi_detailID=$nota");
	$ongkir = mysql_fetch_array($q3);
?>

  <div class="panel-body">
	
	<div class="table-responsive">
	<h5>Tanggal : <?php echo date('d F, Y', strtotime($ongkir['tanggal'])) ?></h5>
	<h4>Nota : <?php echo $nota ?></h4>
		<table class="table">
			<tr>
				<td><h5>
					<p>Nama penerima</p>
					<p>Tlp</p>
					<p>Email</p> 
					<p>Alamat kirim</p> </h5>
				</td>		
				<td><h5>
					<p>: <?php echo $_SESSION['pelanggan_nama'] ?><br></p>
					<p>: <?php echo $_SESSION['pelanggan_tlp']?> <br></p>
					<p>: <?php echo $_SESSION['pelanggan_email'] ?><br></p>
					<p>: <?php echo $ongkir['alamatKirim']?> <br></p>	
					</h5>
				</td>
			</tr>
		</table>		
		<table class="table table-bordered">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Image</th>
					<th class='text-center'>Nama Produk</th>
					<th class='text-center'>Harga <small><span class="label label-info">(Rp)</span></small></th>					
					<th class='text-center'>Qty</th>
					<th class='text-center'>Total <small><span class="label label-info">(Rp)</span></small></th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$tBerat 	= 0;
				$subTotal 	= 0;
				$no=1;
				$kodeUnik 	= substr($nota, 6,10);
				while($rows = mysql_fetch_array($result)){
			
					$nm 	= $rows['nama'];
					$harga 	= $rows['hrg'];
					$stok 	= $rows['qty'];				
					$img 	= $rows['images_name'];
					$berat 	= $rows['berat'];
					$ongkos = $ongkir['totalOngkir'];

					$query2	= mysql_query("SELECT stok FROM barang WHERE brgID = $rows[brgID]");
					$h 		= mysql_fetch_assoc($query2);
					$stok2	= $h['stok'];
					if($stok > $stok2 && $ongkir['status']=='PENDING'){
						$ket="<p style='color:red'>* stok barang tidak tersedia.</p>";
						$ciri = "<b style ='color:red'>*</b>";
					}else{
						$ciri="";
						$ket="";
					}

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
						<td style='max-width: 10px'>
						<img class="img-responsive" src="Images/<?php echo $img ?>" alt="">
					</td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-right'><?php echo number_format($harga,0,',','.'); ?></td>					
					<td class='text-center'>
						<?php echo $stok ?>
						<?php echo $ciri ?>
					</td>
					<td class='text-right'><?php echo number_format($harga*$stok,0,',','.'); ?></td>
				</tr>
				<?php 
					$no++;
					$subTotal = $subTotal+($harga*$stok);	
					$tBerat   = $tBerat + $berat;
				}
			 ?>
			 	<tr>
					<td align="right" colspan="5" class="bg-success">Sub-Total =</td>
					<td align="right"><b><?php echo number_format($subTotal,0,',','.') ?></b></td>	
				</tr>
				<tr>
					<td align="right" colspan="5" class="bg-success">Total Berat =</td>
					<td align="right"><b><?php echo $tBerat ?> Kg</b></td>	
				</tr>
				<tr>
					<td align="right" colspan="5" class="bg-success">Ongkos kirim =</td>
					<td align="right"><b><?php echo number_format($ongkos,0,',','.') ?></b></td>	
				</tr>
				<tr>
					<td align="right" colspan="5" class="bg-success">Total bayar =</td>
					<td align="right"><b><?php echo number_format($subTotal+$ongkos+$kodeUnik,0,',','.') ?> </b></td>	
				</tr>
				<?php 
				$q4 = mysql_query("SELECT * FROM komentar,transaksi
									WHERE komentar.transaksi_detailID=transaksi.transaksi_detailID
									AND transaksi.transaksi_detailID =$nota");
				while($rows3 = mysql_fetch_array($q4)){
					?>
					<tr>
						
						<td colspan="6">
							<p><b> <?php echo $rows3['user'] ?></b> :<br>
								<?php echo $rows3['komentar'] ?> 
							</p>
						</td>	
					</tr>
					<?php
				}
				?>
				<tr>
				<form action="index.php?f=komentar_order_act&id=<?php echo $nota ?>" method="post">
					<td colspan="6">
						<textarea name="alamat" class="form-control" id="" placeholder="Tambah komentar" cols="30" rows="2"></textarea>
						<br>
						<div class="pull-right">
							<button type="submit" class="btn btn-default"><b class="glyphicon glyphicon-envelope"></b> Kirim</button>	
						</div>

					</td>
				</form>
				</tr>
			</tbody>
		</table>
		<?php echo $ket ?>

		<!-- <p>* Demi keamanan, Total biaya di tambahkan kode unik sesuiai digit terakhir nota.</p> -->
		<p>* Biaya bisa di kirimkan melalui Rekening Bank BAC dengan nomor rekening xxxx-xxxx-xxxx atas nama Si Dodo.</p>	
		<p>* Jika Uang belum di transfer hingga batas maksimal 3 hari, maka pembelian di anggap batal.</p>
		<a href="index.php?f=history&id=<?php echo $_SESSION['pelanggan'] ?>" class="btn btn-danger btn-block">Kembali</a>
	</div>
  </div>
</div>	<br>
	<br>
	<br>
	<br>
	<br>
<?php }
