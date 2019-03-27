<?php 
if (isset($_SESSION['pelanggan'])) {

	?>
	<form action="user_konfir_act.php?id=<?php echo $_GET['id'] ?>" method="post" id="inserts">
		<div class="container-fluid">	
			<div class="panel panel-success">

				<div class="panel-heading">
					<h4>Konfirmasi Transfer <i class="glyphicon glyphicon-pencil"></i></h4>
					<small>Pastikan Anda telah mentransfer ke rekening kami terlebih dahulu.</small>
				</div>

				<div class="panel-body">		
					<h2>#<?php echo $_GET['id'] ?></h2><hr>
					<div class="form-group col-sm-6">
					<label>Nama Pengrim</label>
						<input type="text" name="fullName" class="form-control" placeholder="Nama pengirim" maxlength="60" autofocus>
					</div>			

					<div class="form-group col-sm-6">
					<label>No Rekening Pengirim</label><small> (mis: BCA 1232-532-22)</small>
						<input type="text" name="bank_pengirim" class="form-control" required id="">
					</div>
					<div class="form-group col-sm-6">
					<label>Bank Tujuan</label>
						<select name="bank_tujuan" class="form-control" required>
							<?php getBT(); ?>
						</select>
					</div>

					<div class="form-group col-sm-6">
						<label>Tanggal Transfer</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="date" name="tanggal_transfer" class="form-control" required maxlength="32">
						</div>
					</div>

					<div class="form-group col-sm-6">
			        	<label>Jumlah Transfer</label>
			        	<div class="input-group">
				        	<span class="input-group-addon">Rp</span>
				        	<input type="number" name="harga" value="<?php echo $row['hrg'] ?>" min="0" placeholder="Jumlah Transfer" class="form-control" required>
				      		<span class="input-group-addon">.00</span>
			      		</div>
			      	</div>

					<div class="form-group col-sm-6">
						<label>Catatan</label>
						<textarea name="catatan" placeholder="Catatan" class="form-control" id="" cols="30" rows="6"></textarea>
					</div>

					<div class="form-group col-sm-6">
						<img  src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' > 
						<a href='javascript: refreshCaptcha();'><i class="glyphicon glyphicon-refresh"></i></a> 
						<script language='JavaScript' type='text/javascript'>
							function refreshCaptcha()
							{
								var img = document.images['captchaimg'];
								img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
							}
						</script>	
					</div>		

					<div class="form-group col-sm-6">
						<input type="text" name="code" placeholder="Input Kode Captcha" class="form-control" maxlength="6">
					</div>	

				</div>	
					
				<div class="panel-footer modal-footer">					
					<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>	
				</div>	

			</div>
		</div>
	</form>	

<br>
<br>
<br><br>
<br>
<br>

	<?php
}else{
	?>
	<script>
	alert('Anda belum login !');
	document.location('index.php?f=user_login_form');
	</script>
	<?php
}
