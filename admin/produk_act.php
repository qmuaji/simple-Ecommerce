<?php 
//$result = false;
if(isset($_GET['act']) && ($_SESSION['pengelola_level'] == 'admin')){

	$act = $_GET['act'];	
	
	if (($act == 'insert') || ($act == 'edit')) {

		$kategori 	= $_POST['kategori'];
		$nama 		= $_POST['nama'];
		$harga 		= $_POST['harga'];
		$berat 		= $_POST['berat'];
		$stok 		= $_POST['stok'];
		$desk 		= $_POST['desk'];
		$image_name = $_FILES['image']['name'];	
		$direktori 	= '../images/'.$image_name;	

		if($image_name == "") $image_name = "default-image.png";

		if( $act == 'insert'){				

			$sama = mysql_query("SELECT nama FROM barang WHERE nama='$nama'");
			$cek_nama = mysql_num_rows($sama);

			if($cek_nama == 1){
				?>
				<script>
					alert('Nama Produk telah tersedia, silahkan pilih produk lain!');
					history.back();
				</script>
				<?
			}

			move_uploaded_file($_FILES['image']['tmp_name'],$direktori);				
			$result = mysql_query("INSERT INTO barang SET
			kategoriID	= $kategori,
			nama		= '$nama',
			hrg			= $harga,
			berat		= $berat,
			stok		= $stok,
			desk		= '$desk',
			images_name	= '$image_name' ");

		}else if (($act == 'edit') && (isset($_GET['id']))) {

			$q = mysql_query("SELECT images_name FROM barang WHERE brgID='$_GET[id]'");
			$r = mysql_fetch_row($q);

			if($image_name == "") $image_name = $r[0];
			else move_uploaded_file($_FILES['image']['tmp_name'],$direktori);

			$result = mysql_query("UPDATE barang SET
			kategoriID	= $kategori,
			nama		= '$nama',
			hrg			= $harga,
			berat		= $berat,
			stok		= $stok,
			desk		= '$desk',
			images_name	= '$image_name' WHERE brgID='$_GET[id]'");
		}
	}

	if($act == 'delete') {

		if (isset($_GET['id']) && $act == 'delete') {

			$result = mysql_query("DELETE FROM barang WHERE brgID=$_GET[id]");
		}

	}else if($act == 'mdel'){

		if(!empty($_POST['check'])){

			foreach(($_POST['check']) as $mdel){

				$result = mysql_query("DELETE FROM barang WHERE brgID=$mdel");
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
				document.location=('index.php?f=produk_view');
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
			alert('Maaf Boss, hanya Admin yang bisa tambah, hapus dan edit data!');
			document.location=('index.php?');
		</script>
	<?php	

}
