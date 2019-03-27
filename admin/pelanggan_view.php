<?php 	
$showPage 	= '';
$batas		= 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;

 ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Daftar Pelanggan 
			<a href="pelanggan_pdf.php" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i> PDF</a>
			<a href="pelanggan_xls.php" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i> Excel</a>
		</h3>
	</div>
<?php 
	
	$result = mysql_query("SELECT * FROM pelanggan order by	tgl_daftar desc					
						   LIMIT $offset, $batas") or die (mysql_error());
	$no = $offset+1;

 ?>
<form action="index.php?f=pelanggan_act&act=mdel" method="POST">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th class='text-center'><small>#</small></th>
					<th class='text-center'>Nama Pelanggan</th>
					<th class='text-center'>E-mail</th>
					<th class='text-center'>User ID</th>
					<th class='text-center'><i class="glyphicon glyphicon-earphone"></i>Tlp</th>
					<th class='text-center'>Tanggal Daftar</th>	
					<td class='text-center'>Aktif</td>
					<td class='text-center'>Action</td>
				</tr>
			</thead>
			<tbody>
			<?php 

				while($rows = mysql_fetch_array($result)){
			
					$nm 	= $rows['nama_lengkap'];
					$email 	= $rows['email'];
					$userID	= $rows['pelangganID'];
					$tlp 	= $rows['tlp'];
					$tglReg 	= $rows['tgl_daftar'];
					
					$status = $rows['status'];
					if ($status == 'Y') {
						$btn2   = 'btn btn-success';
					}else{
						$btn2   = 'btn btn-danger';
					}
				 ?>
				<tr>
					<td class='text-center'><small><?php echo $no ?></small></td>
					<td><small><?php echo $nm ?></small></td>
					<td>
							<?php echo $email ?>						
					</td>
					<td class='text-center'><small><?php echo $userID ?></small></td>
					<td>
						<small>
							<?php echo $tlp ?>
						</small> 
					</td>					
					<td class='text-center'><?php echo $tglReg ?></td>
					<td class='text-center'>
						<?php echo $status ?>
					</td>
					<td class='text-center'>					
						<a href="index.php?f=pelanggan_edit&id=<?php echo $userID ?>" class="btn btn-default" title="Edit <?php echo $nm ?>"><b class="glyphicon glyphicon-edit"></b></a>
						<a href="pelanggan_del_act.php?id=<?php echo $userID ?>&act=<?php echo $rows['status']?>" class="<?php echo $btn2 ?>" title="enable/disable <?php echo $nm ?>"><b class="glyphicon glyphicon-ok"></b></a>		
					</td>
				</tr>
				<?php 
					$no++;	
				}
			 ?>
			</tbody>
		</table>
	</div>
</form>
<div class="col-md-offset-5">
	<ul class="pagination">
	<?php 

	  $q 		= mysql_query("SELECT COUNT(pelangganID) from pelanggan");
	  $jml 		= mysql_fetch_array($q);
	  $jmlData	= $jml[0];
	  $jmlPage	= ceil($jmlData / $batas);

	  if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=pelanggan_view&page=".($noPage-1).">&laquo;</a></li>";

	  for($i=1; $i <= $jmlPage; $i++){

	    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

	      if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

	      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

	      if($i==$noPage) echo "<li class=active><a>$i</a></li>";

	      else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=pelanggan_view&page=".$i." > ".$i."</a></li>";

	      $showPage=$i;
	    }  
	  }
	 
	  if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=pelanggan_view&page=".($noPage+1).">&raquo;</a></li>";

	?>
	</ul>
		
</div>
<div class="label label-danger">Total Data : <b><?php echo $jmlData ?></b></div><br>
</div>
<?php include('graph_view_pel.php'); ?>