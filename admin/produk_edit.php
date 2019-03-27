<?php  

$id 	= $_GET['id'];
$result = mysql_query("SELECT * FROM barang WHERE brgID=$id");
$row 	= mysql_fetch_array($result);

?>

<div class="panel panel-primary">
	<div class="panel-heading"><h3>Edit Produk</h3></div>
	
	<div class="container-fluid">
		<br>
		<form action="index.php?f=produk_act&act=edit&id=<?php echo $row['brgID'] ?>" method="post" enctype="multipart/form-data" id="inserts">
		<div class="col-sm-6">		
			<div class="form-group">
	        	<label>Nama Produk</label>
	        	<input type="text" name="nama" value="<?php echo $row['nama'] ?>" placeholder="Nama Produk" class="form-control" autofocus required>
	      	</div>

	      	<div class="form-group">
	        	<label>Harga Produk</label>
	        	<div class="input-group">
		        	<span class="input-group-addon">Rp</span>
		        	<input type="number" name="harga" value="<?php echo $row['hrg'] ?>" placeholder="Harga Produk" min="0" class="form-control" required>
		      		<span class="input-group-addon">.00</span>
	      		</div>
	      	</div>

	      	<div class="form-group">
	        	<label>Kategori</label>
	        	<select name="kategori" class="form-control">	        		       		
	        		<?php getKategori($row['kategoriID']) ?>
	        	</select>
	      	</div>			
	      	<div class="col-xs-5 form-group">	      		
	        	<label>Stok</label>
	        	<input type="number" name="stok" min="1" max="1000" value="<?php echo $row['stok']; ?>" placeholder="Stok" class="form-control"  required>
	      	</div>

	      	<div class="col-xs-offset-7 form-group">
	        	<label>Berat</label>
	        	<div class="input-group">		        
		        	<input type="number" name="berat" min="1" max="1000" value="<?php echo $row['berat']; ?>" placeholder="berat" class="form-control" required>
		      		<span class="input-group-addon">Kg</span>
	      		</div>
	      	</div>	

			<!--Textfield UPLOAD START-->
			<div class="form-group">	        	
				<label>Gambar Produk</label>																
				<div class="container-fluid">			
				
					<div class="fileupload fileupload-new" data-provides="fileupload">					

						<div class="fileupload-new thumbnail">
							<img class="img-responsive" src="../images/<?php echo $row['images_name']; ?>" alt="Qmusik"/>
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
							<input type="file" name="image" accept="image/*" >
							
						</span>
						<span class="btn fileupload-exists btn-info" data-dismiss="fileupload">
								<i class="glyphicon glyphicon-remove"></i> Remove
						</span>
						
					</div>
				</div>
	      	</div>
	      	<!--Textfield UPLOD STOP-->
		</div>

		<div class="col-sm-6">	
	      	<div class="form-group">
	        	<label>Deskripsi Produk</label>
	        	<textarea class="form-control" name="desk" id="" cols="30" rows="12" placeholder="Deskripsi Produk"><?php echo $row['desk'] ?></textarea>
	      	</div>
	      	<hr>
		<button type="submit" class="btn btn-primary"><b class="glyphicon glyphicon-floppy-disk"></b> Simpan</button>
		<button type="reset" class="btn btn-warning"><b class="glyphicon glyphicon-repeat"></b> Reset</button>
		<a href="index.php?f=produk_view"><button type="button" class="btn btn-danger"><b class="glyphicon glyphicon-remove"></b> Batal</button></a>		      		
		</form>
		</div>	

	</div>	
</div>
