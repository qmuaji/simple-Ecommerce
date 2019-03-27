<?php 	
/*$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;
*/

	if (isset($_POST['end'])){
		$start 	= date('y-m-d', strtotime($_POST['start']));
		$end 	= date('y-m-d', strtotime($_POST['end'])); 
		$result = mysql_query("SELECT tanggal, transaksi.transaksi_detailID, hrg * sum(qty) as total
								FROM transaksi, transaksi_detail, barang
								WHERE transaksi.transaksi_detailID = transaksi_detail.transaksi_detailID
								AND transaksi_detail.brgID = barang.brgID 
								AND transaksi.status2='COMPLETED'
								AND tanggal BETWEEN '$start' AND '$end'
								GROUP BY transaksi.transaksi_detailID ") or die (mysql_error());

		$ongkir = mysql_fetch_row(mysql_query("SELECT sum(totalOngkir) from transaksi
												 where status2='COMPLETED'
												 AND tanggal BETWEEN '$start' AND '$end'"));

		$ket	= date('d F Y', strtotime($_POST['start'])). " - ".date('d F Y', strtotime($_POST['end']));
		$print  = "BETWEEN '$start' AND '$end'";
	}else{
		$start	="";
		$end	= date('y-m-d');
		$ket 	= 'Awal - Akhir';
		$result = mysql_query("SELECT tanggal, transaksi.transaksi_detailID, hrg * sum(qty) as total
								FROM transaksi, transaksi_detail, barang
								WHERE transaksi.transaksi_detailID = transaksi_detail.transaksi_detailID
								AND transaksi_detail.brgID = barang.brgID 
								AND transaksi.status2='COMPLETED'
								AND tanggal BETWEEN '$start' AND '$end'
								GROUP BY transaksi.transaksi_detailID") or die (mysql_error());

		$ongkir = mysql_fetch_row(mysql_query("SELECT sum(totalOngkir) from transaksi 
												where status2='COMPLETED' 
												AND tanggal BETWEEN '$start' AND '$end'"));
	}
	$no = 1;
	
 ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Laporan Transaksi
			<a href="index.php?f=laporan_print2&start=<?php echo $start ?>&end=<?php echo $end ?>" target="blank" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Print</a>
		</h3>
	</div>
<div class="panel-body">
	<form action="index.php?f=laporan_nota" method="post">
		<div class="container" id="sandbox-container">
			<div class="col col-md-5 col-md-offset-3">
			Periode :
				<div class="input-daterange input-group" id="datepicker">
			    	<input type="text" class="form-control" name="start"/>
			    	<span class="input-group-addon">sd</span>
			    	<input type="text" class="form-control" name="end" />
			    	<span class="input-group-btn">
			    	<button class="btn btn-primary" type="submit">OK</button></span>
			    </div>
			</div>
			
		</div>

	</form>
	<p>Periode : <?php echo $ket ?></p>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Tanggal</th>
					<th class='text-center'>Nota</th>
					<th class='text-center'>Total</th>	
				</tr>
			</thead>
			<tbody>
			<?php 
				$subTotal = 0;
				$total    = 0;
				while($rows = mysql_fetch_array($result)){
					$tgl 	= $rows['tanggal'];
					$tgl = date("d F, Y", strtotime($tgl));
					$nama 	= $rows['transaksi_detailID'];
					$total 	= $rows['total'];
					$subTotal = $subTotal + $total;

				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td><?php echo $tgl ?></td>
					<td class='text-center'><small><?php echo $nama ?></small></td>
					<td class='text-right'><?php echo number_format($total,0,',','.') ?></td>
<!-- 					<td class='text-center'>					
	<a href="index.php?f=pelanggan_edit&id=<?php echo $rows['pelangganID']; ?>" class="btn btn-default" title="Edit <?php echo $tgl ?>"><b class="glyphicon glyphicon-edit"></b></a>
	<a href="index.php?f=pelanggan_act&act=delete&id=<?php echo $rows['pelangganID']; ?>" class="btn btn-warning" title="Hapus <?php echo $tgl ?>"><b class="glyphicon glyphicon-trash"></b></a>		
</td> -->
				</tr>
				<?php 
					$no++;	
				}
			 ?>
				<tr>		
					<td colspan="3" class='text-right'>
						SubTotal
					</td>		
				 	<td class='text-right'>
				 		<b><?php echo number_format($subTotal,0,',','.') ?></b>
				 	</td>

				</tr>
				<tr>
					<td colspan="3" class='text-right'>
						Total Ongkir
					</td>
					<td class='text-right'>
						<b><?php echo number_format($ongkir[0],0,',','.'); ?></b>
					</td>
				</tr>
				<tr>
					<td colspan="3" class='text-right'>
						GTotal
					</td>
					<td class='text-right'>
						<b><?php echo number_format(($ongkir[0]+$subTotal),0,',','.'); ?></b>
					</td>
				</tr>
				
			</tbody>
		</table>
	</div>
<?php 
include('graph_view.php');
?>
<!-- <div class="col-md-offset-5">
	<ul class="pagination">
	<?php 

	  $q 		= mysql_query("SELECT COUNT(nama) from v_totaljual");
	  $jml 		= mysql_fetch_array($q);
	  $jmlData	= $jml[0];
	  $jmlPage	= ceil($jmlData / $batas);

	  if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=laporan_view&page=".($noPage-1).">&laquo;</a></li>";

	  for($i=1; $i <= $jmlPage; $i++){

	    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

	      if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

	      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

	      if($i==$noPage) echo "<li class=active><a>$i</a></li>";

	      else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=laporan_view&page=".$i." > ".$i."</a></li>";

	      $showPage=$i;
	    }  
	  }
	 
	  if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=laporan_view&page=".($noPage+1).">&raquo;</a></li>";

	?>
	</ul>
		
</div>
<div class="label label-danger">Total Data : <b><? echo $jmlData ?></b></div><br> -->
</div>
