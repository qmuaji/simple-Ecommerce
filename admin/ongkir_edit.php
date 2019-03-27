<?php  

$id 	= $_GET['id'];
$result = mysql_query("SELECT *, kokab_nama 
						 FROM ongkir, kota_kab 
						 WHERE ongkir.ongkirID = kota_kab.kokabID AND ongkirID=$id");
$row 	= mysql_fetch_array($result);

?>
<div class="panel panel-info">
	<div class="panel-heading"><h3>Edit Ongkir</h3></div>
	
	<div class="container-fluid">
		<br>
		<form action="index.php?f=ongkir_act&act=edit&id=<?php echo $id ?>" method="post" role="form" enctype="multipart/form-data" id="inserts">
			<div class="col-md-6">	

				<div class="form-group ">		
					<label>Kota/Kabupaten</label>
					<input type="text" name="kokab" class="form-control" value="<?php echo $row['kokab_nama'] ?>" readonly>
				</div>		
			</div>

	      	<div class="form-group">
	        	<label>Harga Ongkir</label>
	        	<div class="input-group">
		        	<span class="input-group-addon">Rp</span>
		        	<input type="text" name="harga" value="<?php echo $row['harga'] ?>" class="form-control" >
		      		<span class="input-group-addon">.00</span>
	      		</div>
	      	</div>
	      	<hr>
	      	<div class="pull-right">
				<button type="submit" class="btn btn-success"><b class="glyphicon glyphicon-floppy-disk"></b> Update</button>
				<button type="reset" class="btn btn-warning"><b class="glyphicon glyphicon-repeat"></b> Reset</button>
				<a href="index.php?f=ongkir_view"><button type="button" class="btn btn-danger"><b class="glyphicon glyphicon-remove"></b> Batal</button></a>	
			</div>	
		</form>
	</div>	
</div>
