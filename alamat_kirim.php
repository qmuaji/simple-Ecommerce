<?php 
if (!isset($_SESSION['pelanggan'])) {
	?>
	<script>
		alert('Silahkan Login / Register terlebih dahulu!');
		document.location="index.php?f=user_register";
	</script>
	<?php
}else if(isset($_SESSION['cart'])){

	$query 	= mysql_query("SELECT provinsi_id FROM kota_kab WHERE kokabID = $_SESSION[pelanggan_kokab] ");
	$row 	= mysql_fetch_assoc($query);

	?>	<form action="index.php?f=checkout_act" method="POST" role="form" id="inserts">	
			<div class="panel panel-primary">
			  	<div class="panel-heading">
					<h3>Alamat Kirim <span class="glyphicon glyphicon-road"></span></h3>
			  	</div>
			  	<div class="panel-body">
					<div class="form-group col-md-5 col-md-offset-3">
						<label>Alamat Kirim </label>
						<select name="provinsi" class="form-control" id="provinsi" required>
							<?php getProvinsi($row['provinsi_id']); ?>
						</select>		
						<select name="kokab" class="form-control" id="kabupaten" required>
							<?php getKokab($_SESSION['pelanggan_kokab']); ?>
						</select>
						<textarea name="alamat" class="form-control" placeholder="Detail Alamat" rows="10"><?php echo $_SESSION['pelanggan_alamat'] ?></textarea>
						<br>
						<div class="pull-right">
					  		<button type="submit" class="btn btn-danger">Lanjutkan</button>
					 	</div>
					</div>					
			  	</div>				  
			</div>
		</form>	<br>
	<br>
	<br>
	<br>
	<br>

	<?php
}else{
	?>
	<script>
		alert('Keranjang belanja masik kosong!');
		history.back(1);
	</script>
	<?php
}


