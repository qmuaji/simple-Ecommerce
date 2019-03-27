<?php 
if (isset($_SESSION['pelanggan'])) {
	$q 		= mysql_query("SELECT * FROM pelanggan, master_provinsi, kota_kab 
						   WHERE pelanggan.pelangganID ='$_SESSION[pelanggan]'
						   AND master_provinsi.provinsi_id=kota_kab.provinsi_id
						   AND kota_kab.KokabID=pelanggan.KokabID ");
	$row 	= mysql_fetch_array($q);
	?>
	<form action="user_edit_act.php" method="post" id="inserts">
		<div class="col-md-8">	
			<div class="panel panel-info">

				<div class="panel-heading">
					<h4>Edit Account <i class="glyphicon glyphicon-pencil"></i></h4>
					<small>Edit Account.</small>
				</div>

				<div class="panel-body">		

					<div class="form-group col-sm-12">
					<label>Nama lengkap</label>
						<input type="text" name="fullName" class="form-control" placeholder="Nama lengkap" value="<?php echo $row['nama_lengkap'] ?>" maxlength="50" autofocus>
					</div>			

					<div class="form-group col-sm-5">
					<label>Jenis kelamin</label>
						<select name="jk" class="form-control" required>
							<?php getJK($row['jk']); ?>
						</select>
					</div>

	<!-- 					<div class="form-group col-sm-4">
					<label>Tanggal lahir</label>
						<div class="input-group">
							<input type="text" name="tgl_lahir" class="form-control" placeholder="Tanggal lahir" id="">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div> -->

					<div class="form-group col-sm-7">
						<label>Telphone</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
							<input type="text" name="tlp" class="form-control" placeholder="Telephone" value="<?php echo $row['tlp'] ?>" maxlength="32">
						</div>
					</div>

					<div class="form-group col-sm-7">
						<label>Alamat</label>
						<textarea name="alamat" placeholder="Alamat" class="form-control" id="" cols="30" rows="6"><?php echo $row['Alamat'] ?></textarea>
					</div>

					<div class="form-group col-sm-5">
						<label>Provinsi</label>
						<select name="provinsi" class="form-control" id="provinsi" required>
							<?php getProvinsi($row['provinsi_id']); ?>
						</select>		
					</div>

					<div class="form-group col-sm-5">		
						<label>Kota/Kabupaten</label>
						<select name="kokab" class="form-control"  id="kabupaten" required>
							<?php getKokab($row['kokabID']); ?>
						</select>
					</div>

					<div class="form-group col-sm-7">			
						<label>E-mail</label>
						<div class="input-group">
							<span class="input-group-addon"><b>@</b></span>
							<input type="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo $row['email'] ?>"maxlength="50" id="">
						</div>
					</div>

					<div class="form-group col-md-5">
						<label>Username</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" name="username" class="form-control" placeholder="Username" maxlength="32" readonly value="<?php echo $row['pelangganID'] ?>">
						</div>				
					</div>

					<div class="form-group col-md-6">
						<label>New Password</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" name="pass3" placeholder="Password" class="form-control" maxlength="32">
						</div>				
					</div>

					<div class="form-group col-md-6">
						<label>*</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" name="pass4" placeholder="Password Confirm" class="form-control" maxlength="32">
						</div>					
					</div>					

					<div class="col-sm-7">
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

					<div class="form-group col-sm-5">
						<input type="text" name="code" placeholder="Input Kode Captcha" class="form-control" maxlength="6">
					</div>	

				</div>	
					
				<div class="panel-footer modal-footer">					
					<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>	
				</div>	

			</div>
		</div>
	</form>	



	<?php
}else{
	?>
	<script>
	alert('Anda belum login !');
	document.location('index.php?f=user_login_form');
	</script>
	<?php
}
