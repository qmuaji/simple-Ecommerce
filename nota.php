<?php 


function getNota(){

	$result = mysql_query("SELECT transaksi_detailID FROM transaksi_detail");
	$nota 	= mysql_fetch_array($result);
	$date = date('dmy');
	
	if ($nota == 0){
		$nota = $date.'0001';
	}else{
		$result = mysql_query("SELECT MAX(transaksi_detailID) as nota from transaksi_detail WHERE transaksi_detailID IN(SELECT MAX(transaksi_detailID))");
		$row 	= mysql_fetch_assoc($result);
		$nota	= $row['nota'];
		$ambil	= substr($nota, 0,6);
		if ($date == $ambil){
			$nota = substr($nota, 5,10)+1;
			$nota = substr($date,0,5).$nota;
		}else{
			$nota = $date.'0001';
		}
	}
	return $nota;
}
?>