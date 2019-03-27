<?php 

if(isset($_GET['alert'])){
	$a = $_GET['alert'];

	if($a == 1){
		?>
			<div class="alert alert-success alert-dismissable">
			<i class="glyphicon glyphicon-floppy-saved"></i> 
				Berhasil : Data telah disimpan!      
				<button type="button" class="close" data-dismiss="alert">×</button>
    		</div>
		<?php
	}else if($a == 2){
		?>
			<div class="alert alert-danger">
			<i class="glyphicon glyphicon-floppy-remove"></i> 
				Gagal : Data gagal disimpan!      
				<button type="button" class="close" data-dismiss="alert">×</button>
    		</div>
		<?php

	}



}