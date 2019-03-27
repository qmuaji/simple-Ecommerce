	<?php 

	$result = mysql_query("SELECT * FROM barang WHERE brgID='$_GET[id]'");
	$row 	= mysql_fetch_array($result);
	?>


<div class="container-fluid">
<h3><?php echo $row['nama'] ?></h3>
	<div class="col-md-6">
	
		<div class="thumbnail">
			<img src="images/<?php echo$row['images_name'] ?>" class="img-responsive" alt="">
		</div>
	</div>


	<div class="col-md-6">
		<div class="caption">			
			<h4><?php echo $row['nama'] ?></h4>
			<p style="text-align:justify"><?php echo $row['desk'] ?></p>
			<div class="panel-heading">
				<h3><?php echo "Rp ".number_format($row['hrg'],0,',','.'); ?></h3>Berat : <?php echo $row['berat'] ?> Kg
			</div>

			<a href="index.php?f=cart&act=add&id=<?php echo $row['brgID'] ?>" title="Beli" class="btn btn-info btn-block btn-lg"><b class="glyphicon glyphicon-shopping-cart"></b> Beli </a>
		</div>
	</div>

</div>
