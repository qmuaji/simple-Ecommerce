<?php 
if (isset($_GET['act'])) {
	$act = $_GET['act'];
	if ($act == 'Y') {
		$h=mysql_query("UPDATE buku_tamu SET view='N' WHERE buku_tamuID=$_GET[id]") or die (mysql_error());

	}else if($act == 'N'){
		 $h=mysql_query("UPDATE buku_tamu SET view='Y' WHERE buku_tamuID=$_GET[id]") or die (mysql_error());
	}

	if($h){
		?>
		<script>
		document.location="index.php"
		</script>
		<?
	}
}