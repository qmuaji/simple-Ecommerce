<?php 
if($_GET['id'] && isset($_SESSION['pelanggan'])){
	$nota 		= $_GET['id'];
	$q 			= mysql_query("SELECT * FROM transaksi WHERE transaksi_detailID='$nota'")or die(mysql_error());
	$pesanan 	= mysql_fetch_array($q);
	$tgl 		= $pesanan['tanggal'];
	?>
	<div class="panel panel-success">
		<div class="panel-heading">
				<h3>Pesanan <?php echo $_SESSION['pelanggan_nama'] ?> <b class="glyphicon glyphicon-shopping-cart"></b></h3>
		</div>
		<div class="panel-body">

								<h5>Tanggal : <?php echo date('d F, Y', strtotime($tgl)) ?></h5>
								<h3>Nota : <?php echo $pesanan['transaksi_detailID'] ?></h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tbody>
						<tr>

							<td>
															
									<h4>Total biaya untuk pembelian Produk adalah:</h4><br>
									<h1 class="text-center">Rp <?php echo number_format($pesanan['totalBayar'],0,',','.')?></h1><br>
									<p>dan biaya bisa di kirimkan melalui Rekening Bank BAC dengan nomor rekening xxxx-xxxx-xxxx atas nama Si Dodo.</p>		
	
							</td>

							<td>
								<h4>Barang akan kami kirim ke alamat di bawah ini: </h4><br>
								<table class="table">
									<tr>
										<td>
											<p>Nama</p>
											<p>Tlp</p>
											<p>Email</p> 
											<p>Alamat</p> 
										</td>		
										<td>
											<p>: <?php echo $_SESSION['pelanggan_nama'] ?><br></p>
											<p>: <?php echo $_SESSION['pelanggan_tlp']?> <br></p>
											<p>: <?php echo $_SESSION['pelanggan_email'] ?><br></p>
											<p>: <?php echo $pesanan['alamatKirim']?> <br></p>	

										</td>
									</tr>
								</table>								
							</td>

						</tr>
					</tbody>
				</table>
			</div>
			<p>* Demi keamanan, Total biaya di tambahkan kode unik sesuiai digit terakhir nota.</p>
			<p>* Jika Uang belum di transfer hingga batas maksimal 3 hari, maka pembelian di anggap batal.</p>
		</div>
		<a href="index.php" class="btn btn-success btn-lg btn-block"><i class="glyphicon glyphicon-share-alt"></i> OK</a>
		
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<?php 
}
