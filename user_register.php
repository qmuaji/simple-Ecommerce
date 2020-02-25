<?php 

include('user_login_form.php');
error_reporting(E_ALL ^ E_DEPRECATED)
?>

<div class="panel-heading" style="padding-top:0px; padding-bottom:0px;"><h3>Login / Register</h3></div>
<div class="col-sm-4">	
	
</div>

<form action="user_register_act.php" method="post" id="inserts">
	<div class="col-md-8">	
		<div class="panel panel-info">

			<div class="panel-heading">
				<h4>Register Account <i class="glyphicon glyphicon-pencil"></i></h4>
				<small>Jika anda telah mempunyai akun, silahkan login terlebih dahulu.</small>
			</div>

			<div class="panel-body">		

				<div class="form-group col-sm-12">
				<label>Nama lengkap</label>
					<input type="text" name="fullName" class="form-control" placeholder="Nama lengkap" maxlength="50" autofocus>
				</div>			

				<div class="form-group col-sm-5">
				<label>Jenis kelamin</label>
					<select name="jk" class="form-control" required>
						<?php getJK($row['jk']) ?>
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
						<input type="text" name="tlp" class="form-control" placeholder="Telephone" maxlength="32">
					</div>
				</div>

				<div class="form-group col-sm-7">
					<label>Alamat</label>
					<textarea name="alamat" placeholder="Alamat" class="form-control" id="" cols="30" rows="6"></textarea>
				</div>

				<div class="form-group col-sm-5">
					<label>Provinsi</label>
					<select name="provinsi" class="form-control" id="provinsi" required>
						<?php getProvinsi(""); ?>
					</select>		
				</div>

				<div class="form-group col-sm-5">		
					<label>Kota/Kabupaten</label>
					<select name="kokab" class="form-control" id="kabupaten" required>
					</select>
				</div>

				<div class="form-group col-sm-7">			
					<label>E-mail</label>
					<div class="input-group">
						<span class="input-group-addon"><b>@</b></span>
						<input type="email" name="email" class="form-control" placeholder="E-mail" maxlength="50" id="">
					</div>
				</div>

				<div class="form-group col-md-5">
					<label>Username</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="username" class="form-control" placeholder="Username" maxlength="32">
					</div>				
				</div>

				<div class="form-group col-md-6">
					<label>Password</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="pass1" placeholder="Password" class="form-control" maxlength="32">
					</div>				
				</div>

				<div class="form-group col-md-6">
					<label>*</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="pass2" placeholder="Password Confirm" class="form-control" maxlength="32">
					</div>					
				</div>					

				<div class="col-sm-7">
					<img  src="captcha.php?rand=<?= rand(); ?>" id='captchaimg' > 
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
				<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Register</button>	
			</div>	

		</div>
	</div>
</form>

