<?php 
//session_start();

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else{
	$id = 1;
}

if (isset($_GET['act'])) {
	$act = $_GET['act'];
}else{
	$act = "empty";
}

$query = mysql_query("SELECT stok from barang where brgID='$id' ");
$result = mysql_fetch_array($query);			
$q2 = $result['stok'];
switch ($act) {

	case 'add':

		if (isset($_SESSION['cart'][$id])) {
			$q1 = $_SESSION['cart'][$id];

			if ($q1 >= $q2) {
				?>
				<script>
				alert('Maaf, stok tidak tersedia!');
				document.location="index.php?f=cart&act=none"
				</script>				
				<?php
			}else{
				$_SESSION['cart'][$id]++;
			}
		}else{		
			if ($q2 == 0) {
				?>
				<script>
				alert('Maaf, stok habis!');
				</script>
				<?php
			}else{
				$_SESSION['cart'][$id]=1;
			}
		}
		
		break;
	
	case 'remove':
		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]--;
			if ($_SESSION['cart'][$id] == 0) {
				unset($_SESSION['cart'][$id]);			
			}else if (empty($_SESSION['cart'])) {
				unset($_SESSION['cart']);
			}
		}
		break;
	case 'empty':
		unset($_SESSION['cart']);
		break;
}

if (!empty($_SESSION['cart'])) {
	?> 	
	<div class="container-fluid">
		<h3><b class="glyphicon glyphicon-shopping-cart"></b> Keranjang Belanja</h3>
		<hr>
	<div class="panel panel-default col-md-9">
	<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="text-center">Image</th>  
					<th class="text-center">Nama Produk</th>				
					<th class="text-center">Qty</th>
					<th class="text-center">Harga <small><b class="label label-success">(Rp)</b></small></th>
					<th class="text-center">Total <small><b class="label label-success">(Rp)</b></small></th>
				</tr>
			</thead>		
			<tbody>
	<?php 
	$subTotal 	= 0;
	$tBerat		= 0;	
	foreach ($_SESSION['cart'] as $id => $x) {	

		$result = mysql_query("SELECT nama, hrg, images_name, berat from barang
						   WHERE brgID = '$id'");
		$rows	= mysql_fetch_array($result);
		$hrg 	= $rows['hrg'];
		$total 	= $hrg * $x;
		$subTotal = $subTotal + $total;
		$berat 	= $rows['berat'] * $x;
		$tBerat = $tBerat + $berat;
		?>
	
				<tr>
					<td class="text-center" style='max-width: 90px'>
						<a href="index.php?f=produk_detail&id=<?php echo $id?>"><img class="img-responsive" style="width:100%" src="images/<?php echo $rows['images_name'] ?>" alt="Qmusik"></a>
					</td>
					<td><small> <?php echo substr($rows['nama'],0,40) ?></small></td>					
					<td class="text-center"  style='min-width: 90px'>
						<a href="index.php?f=cart&id=<?php echo $id ?>&act=remove"> 
							<b class="glyphicon glyphicon-minus"></b>
						</a><span class="btn btn-default"><?php echo $x ?></span>
						<a href="index.php?f=cart&id=<?php echo $id ?>&act=add"> 
							<b class="glyphicon glyphicon-plus"></b>
						</a>
					</td>
					<td align="right"><?php echo number_format($hrg,0,',','.') ?></td>
					<td align="right"><?php echo number_format($total,0,',','.') ?></td>
				</tr>
			</tbody><?php 

	} ?>		<!-- <tr>					
					<td colspan="5">
						<div class="form-group">
							<label>Alamat Kirim </label>
							<select name="provinsi" class="form-control" id="provinsi" required>
								<?php getProvinsi(''); ?>
							</select>		
							<select name="kokab" class="form-control" id="kabupaten" required></select>
						</div>
					</td>	
				</tr> -->
				<tr>
					<td align="right" colspan="4"><b class="label label-info">Sub-Total =</b></td>
					<td align="right"><b><?php echo number_format($subTotal,0,',','.') ?></b></td>	
				</tr>
				<tr>
					<td align="right" colspan="4"><b class="label label-primary">Total Berat =</b></td>
					<td align="right"><b><?php echo $tBerat ?> Kg</b></td>	
				</tr>					
			</table>
		</div>
		
		</div>

		<div class="modal-footer">
			<form action="index.php?f=alamat_kirim" method="post">
				<button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-share-alt"></span> Checkout</button>
			</form>
		</div>
	</div>

	<div class="col-sm-3">
		<?php 
			if (!isset($_SESSION['pelanggan'])) {
			 	include('user_login_form.php');
			 }else{
			 	?><h4>Hi.. <?php echo $_SESSION['pelanggan_nama'] ?></h4>
			 		<p>Silahkan berbelanja..</p>	<?php
			 } 
		?>
	</div>
	</div>
	<?php //echo var_dump($_SESSION['cart']);

}else{
	unset($_SESSION['cart']);
	?>
	<h3>Keranjang belanja kosong.</h3>
	<hr>
	<br><br><br><br><br>
	<?php
}
