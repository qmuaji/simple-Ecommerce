<?php 
if(isset($_GET['act']) && ($_SESSION['pengelola_level'] == 'admin')){

	$act 	= $_GET['act'];	

	if( $act == 'insert'){				
		$nama 	= $_POST['kokab'];
		$harga 	= $_POST['harga'];
		$sama = mysql_query("SELECT ongkirID FROM ongkir WHERE ongkirID='$nama'");
		$cek_nama = mysql_num_rows($sama);

		if($cek_nama == 1){
			?>
			<script>
				alert('Nama Kota / Kabupaten telah terdaftar, silahkan pilih Kota / Kabupaten lain!');
			</script>
			<?
		}
			
		$result = mysql_query("INSERT INTO ongkir SET
		ongkirID	= $nama,
		harga		= $harga");

	}else if (($act == 'edit') && (isset($_GET['id']))) {
		$harga 	= $_POST['harga'];
		$result = mysql_query("UPDATE ongkir SET
							   harga = $harga WHERE ongkirID =$_GET[id]");

	}else if($act == 'delete') {

		if (isset($_GET['id']) && $act == 'delete') {

			$result = mysql_query("DELETE FROM ongkir WHERE ongkirID=$_GET[id]");
		}

	}else if($act == 'mdel'){

		if(!empty($_POST['check'])){

			foreach(($_POST['check']) as $mdel){

				$result = mysql_query("DELETE FROM ongkir WHERE ongkirID=$mdel");
			}	
		}else {
			?>
			<script>
				alert('Error : Pilih dulu yang akan di hapus dong!');
				history.back();
			</script>
			<?
		}	

	}

	if ($result) {
		?>
			<script>
				alert('Berhasil : Data telah di Eksekusi!');
				document.location=('index.php?f=ongkir_view');
			</script>

		<?php
		

	}else{
		?>
			<script>
				alert('Gagal : Data gagal Eksekusi! Silahkan ulangi');
				history.back();
			</script>
		<?php			
	}
	
}else{
	?>
		<script>
			alert('Maaf Boss, hanya Admin yang bisa simpan data!');
			document.location=('index.php?');
		</script>
	<?php	

}

