<?php 	

if (isset($_GET['id'])) {
	$nota = $_GET['id'];

	$result = mysql_query("SELECT * FROM barang, transaksi_detail
					 WHERE transaksi_detailID = '$nota'
					 AND transaksi_detail.brgID = barang.brgID") or die (mysql_error());
	$pel 	= mysql_query("SELECT * from pelanggan,transaksi,konfirmasi 
						   WHERE transaksi.pelangganID=pelanggan.pelangganID
						   AND transaksi.transaksi_detailID = '$nota'");
	$pel 	= mysql_fetch_array($pel);
 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Detail Penjualan <a href="?f=penjualan_print&id=<?php echo $nota ?>" target="blank" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Print</a></h3>
	</div>   
  	<div class="panel-body">
		<h3>#<?php echo $nota ?></h3>
		<form action="index.php?f=penjualan_act&id=<?php echo $nota ?>" method="post">
			<div class="row">
				<div class="col col-md-3">
					<div class="input-group">
					<select name="status" class="form-control">
					<?php 							
						if ($pel['status2'] === "PENDING"){

							echo "<option value='PENDING'> PENDING </option>";
							echo "<option value='PROCESS'> PROCESS </option>";
							echo "<option value='COMPLETED'> COMPLETED </option>";

						}else if ($pel['status2'] === "PROCESS"){

							echo "<option value='PROCESS'> PROCESS </option>";
							echo "<option value='COMPLETED'> COMPLETED </option>";
							echo "<option value='PENDING'> PENDING </option>";

						}else if ($pel['status2'] === "COMPLETED"){

							echo "<option value='COMPLETED'> COMPLETED </option>";
							echo "<option value='PROCESS'> PROCESS </option>";
							echo "<option value='PENDING'> PENDING </option>";

						}
					 ?>
					</select> 
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><b class="glyphicon glyphicon-floppy-disk"></b> Status</button>
						</div>
					</div>
				</div>
			
		</form>

		<form action="index.php?f=transfer_act&id=<?php echo $nota ?>" method="post">
			
<!-- 				<div class="col col-md-3">
					<div class="input-group">
					<select name="transfer" class="form-control">
					<?php 							
						if ($pel['transfer'] == "BELUM"){
							echo "<option value='BELUM'> BELUM </option>";
							echo "<option value='SUDAH'> SUDAH </option>";
						}else{
							echo "<option value='SUDAH'> SUDAH </option>";
							echo "<option value='BELUM'> BELUM </option>";
						}
					 ?>
					</select> 
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><b class="glyphicon glyphicon-floppy-disk"></b> Transfer</button>
						</div>
					</div>
				</div> -->
			</div>
		</form>
	<div class="table-responsive">
	<table class="table" >
		<tbody>
			<tr>
				<td>	
					<h5>Tanggal </h5>
					<h5>Nama Pelanggan</h5>
					<h5>No Tlp</h5>
					<h5>Email</h5>
					<h5>Alamat Kirim </h5>
				</td>
				<td>
					<h5>: <?php echo date('d F, Y', strtotime($pel['tanggal'])) ?></h5>
					<h5>: <?php echo $pel['nama_lengkap'] ?></h5>
					<h5>: <?php echo $pel['tlp'] ?></h5>
					<h5>: <?php echo $pel['email'] ?></h5>
					<h5><p>: <?php  echo $pel['alamatKirim'] ?></p></h5>
				</td>
			</tr>
		</tbody>	
	</table>
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
	
					<th class='text-center'>Nama Barang</th>
					<th class='text-center'>Harga <small>(Rp)</small></th>					
					<th class='text-center'>Qty</th>
					<th class='text-center'>Total <small>(Rp)</small></th>
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
					$qty 	= $rows['qty'];				
					$berat 	= $rows['berat'];
					$ongkos = $pel['totalOngkir'];

					$query2	= mysql_query("SELECT stok FROM barang WHERE brgID = $rows[brgID]");
					$h 		= mysql_fetch_assoc($query2);
					$stok2	= $h['stok'];
					if($qty > $stok2 && $pel['status2']=='PENDING'){

						$ciri = "Stok kurang ".($qty - $stok2);
					}else{
						$ciri="";
					}
				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td><small><?php echo $nm ?></small></td>
					<td class='text-right'><?php echo number_format($harga,0,',','.'); ?></td>					
					<td class='text-center'>
<!-- 						<form action="index.php?f=update_cart" >
	<div class="form-group">
		<div class="input-group">
		  	<input type="number" class="form-control" name="qty" value="<?php echo $qty ?>" required min="0">
	      <span class="input-group-btn">
	        <button class="btn btn-danger" type="submit"><b class="glyphicon glyphicon-floppy-disk"></b> ubah</button>
	      </span>
	    	
	    </div>/input-group							
	</div>
</form> --> 			<?php echo $qty ?>
						<small style="color:red"><?php echo $ciri ?></small>
					</td>
					<td class='text-right'><?php echo number_format($harga*$qty,0,',','.'); ?></td>
				</tr>
				<?php 
					$no++;
					$subTotal = $subTotal+($harga*$qty);	
					$tBerat   = $tBerat + $berat;
				}
			 ?>
			 	<tr>
					<td align="right" colspan="4">Sub-Total </td>
					<td align="right"><b><?php echo number_format($subTotal,0,',','.') ?></b></td>	
				</tr>
				<tr>
					<td align="right" colspan="4">Total Berat </td>
					<td align="right"><b><?php echo $tBerat ?> Kg</b></td>	
				</tr>
				<tr>
					<td align="right" colspan="4">Ongkos kirim </td>
					<td align="right"><b><?php echo number_format($ongkos,0,',','.') ?></b></td>	
				</tr>
				<tr>
					<td align="right" colspan="4">Total bayar </td>
					<td align="right"><b><?php echo number_format($subTotal+$ongkos+$kodeUnik,0,',','.') ?> </b></td>	
				</tr>
				<tr>
					<td align="right" colspan="4">Total Transfer </td>
					<td align="right"><b><?php echo number_format($pel['jumlah_transfer'],0,',','.') ?> </b></td>	
				</tr>
				<tr>
					<td align="right" colspan="4">Kembali </td>
					<td align="right"><b><?php echo number_format(($pel['jumlah_transfer'])-($subTotal+$ongkos+$kodeUnik),0,',','.') ?> </b></td>	
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
				</form>
					</td>
				</tr>
			</tbody>
		</table>
<!-- 		<p>* Demi keamanan, Total biaya di tambahkan kode unik sesuiai digit terakhir nota.</p> -->
		<a href="index.php?f=penjualan_view" class="btn btn-danger">Kembali</a>
	</div>
  </div>
</div>
<?php }
