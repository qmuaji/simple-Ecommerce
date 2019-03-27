<div class="panel panel-success">
	<div class="panel-heading"><h3>Tambah Produk</h3></div>
	
	<div class="container-fluid">
		<br>
		<form action="index.php?f=produk_act&act=insert" method="post" role="form" enctype="multipart/form-data" id="inserts">
		<div class="col-md-6">		
			<div class="form-group">
	        	<label>Nama Produk</label>
	        	<input type="text" name="nama" placeholder="Nama Produk" class="form-control" autofocus >
	      	</div>

	      	<div class="form-group">
	        	<label>Harga Produk</label>
	        	<div class="input-group">
		        	<span class="input-group-addon">Rp</span>
		        	<input type="text" name="harga" placeholder="Harga Produk" class="form-control" >
		      		<span class="input-group-addon">.00</span>
	      		</div>
	      	</div>

	      	<div class="form-group">
	        	<label>Kategori</label>
	        	<select name="kategori" class="form-control" >	        		
	        		<?php 					
						getKategori('');						
					?>
	        	</select>
	      	</div>

	      	<div class="form-group col-xs-6 ">	      		
	        	<label>Stok</label>
	        	<input type="number" name="stok" min="1" max="1000" placeholder="Stok" class="form-control"  >
	      	</div>

	      	<div class="form-group col-xs-6">
	        	<label>Berat</label>
	        	<div class="input-group">		        
		        	<input type="number" name="berat" min="1" max="1000" placeholder="berat" class="form-control" >
		      		<span class="input-group-addon">Kg</span>
	      		</div>
	      	</div>	      	
			<!--Textfield UPLOAD START-->
			<div class="form-group">	        	
				<label>Gambar Produk</label>																
				<div class="container-fluid">			
				
					<div class="fileupload fileupload-new" data-provides="fileupload">					

						<div class="fileupload-new thumbnail">
							<img src="../images/default-image.png" alt="Qmusik"/>
						</div>					
					
						<div class="fileupload-preview fileupload-exists thumbnail">
						
						</div>

						<span class="btn btn-info btn-file">
							<span class="fileupload-new"><i class="glyphicon glyphicon-picture">																	
								</i> Select image
							</span>
							<span class="fileupload-exists">
								<i class="glyphicon glyphicon-picture"></i> Change
							</span>
							<input type="file"name='image' accept="image/*">
							
						</span>

						<span class="btn fileupload-exists btn-info" data-dismiss="fileupload">
								<i class="glyphicon glyphicon-remove"></i> Remove
						</span>
						
					</div>
				</div>
	      	</div>
	      	<!--Textfield UPLOD STOP-->
		</div>

		<div class="col-md-6">	
	      	<div class="form-group">
	        	<label>Deskripsi Produk</label>
	        	<textarea class="form-control" name="desk" cols="30" rows="12" placeholder="Deskripsi Produk" id="desk"></textarea>
	      	</div>
	      	<hr>
		<button type="submit" class="btn btn-success"><b class="glyphicon glyphicon-floppy-disk"></b> Simpan</button>
		<button type="reset" class="btn btn-warning"><b class="glyphicon glyphicon-repeat"></b> Reset</button>
		<a href="index.php?f=produk_view"><button type="button" class="btn btn-danger"><b class="glyphicon glyphicon-remove"></b> Batal</button></a>		      		
		</form>
		</div>	

	</div>
	
</div>