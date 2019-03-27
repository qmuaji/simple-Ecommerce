<div class="panel panel-success">
	<div class="panel-heading"><h3>Tambah Ongkir</h3></div>
	
	<div class="container-fluid">
		<br>
		<form action="index.php?f=ongkir_act&act=insert" method="post" role="form" enctype="multipart/form-data" id="inserts">
			<div class="col-md-6">	

		      	<div class="form-group">
					<label>Provinsi</label>
					<select name="provinsi" class="form-control" id="provinsi" required>
						<?php getProvinsi(''); ?>
					</select>		
				</div>

				<div class="form-group ">		
					<label>Kota/Kabupaten</label>
					<select name="kokab" class="form-control" id="kabupaten" required></select>
				</div>		
			</div>

	      	<div class="form-group">
	        	<label>Harga Ongkir</label>
	        	<div class="input-group">
		        	<span class="input-group-addon">Rp</span>
		        	<input type="text" name="harga" placeholder="Harga Ongkir" class="form-control" >
		      		<span class="input-group-addon">.00</span>
	      		</div>
	      	</div>
	      	<hr>
	      	<div class="pull-right">
				<button type="submit" class="btn btn-success"><b class="glyphicon glyphicon-floppy-disk"></b> Simpan</button>
				<button type="reset" class="btn btn-warning"><b class="glyphicon glyphicon-repeat"></b> Reset</button>
				<a href="index.php?f=ongkir_view"><button type="button" class="btn btn-danger"><b class="glyphicon glyphicon-remove"></b> Batal</button></a>	
			</div>	
		</form>
	</div>	
</div>
