<?php 
session_start();
require_once('koneksi.php');
require_once('_header.php');
require_once('admin/function.php');


if(!isset($_GET['f'])){

	include('home.php');

}else if(isset($_GET['f'])){
	?>
	<style>
		.isi{
			padding-top: 80px;
		}
	</style>
	<div class="container isi">
	<?php
		$file=$_GET['f'];

		require($file.'.php');
		require('featured.php')

	?></div>
	
	<?php


}
?>

</body>
<div class="container">
	<footer>
		<script src="dist/js/jquery.js"></script>
	    <script src="dist/js/bootstrap.min.js"></script>
        <script src="dist/js/bootstrap-datepicker.min.js"></script>
        <script src="dist/locales/bootstrap-datepicker.id.min.js"></script>
        <script src="dist/js/bootstrapValidator.min.js"></script>
	    <script src="validasi.js"></script>
		<hr>
		<p class="pull-right">
			<a href="#" class="btn btn-danger"><b class="glyphicon glyphicon-arrow-up"></b></a>
		</p>
		<p>Qmusik &copy 2015
	</footer>
</div>
