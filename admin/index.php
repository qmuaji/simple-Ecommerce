<?php 
session_start();
require_once('../koneksi.php');
require_once('_header.php');
require_once('function.php');

if(!isset($_SESSION['pengelola'])){

  require_once('login_form.php');    

}else{

  if(!isset($_GET['f'])){
    ?><div class="col-md-6"> <?php
    include('graph_view_pel.php');
    ?></div><div class="col-md-6"> <?php
    include('graph_view.php');
    ?></div>
  
      <div class="col-md-4"> <?php
    include('buku_tamu.php');
    ?></div><div class="col-md-8"> <?php
    include('laporan_laris.php');
    ?></div><?php
  }else{

    $file=$_GET['f'];
    include($file.'.php');
  }
}

?>

    <br>
    </div><!-- /.container -->
  </div><!-- /.navbar-wrapper -->
</body>        
        <script src="../dist/js/jquery.js"></script>
        <script src="../dist/js/bootstrap.min.js"></script>
        <script src="../dist/js/bootstrap-datepicker.min.js"></script>
        <script src="../dist/locales/bootstrap-datepicker.id.min.js"></script>
        <script src="../dist/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="../dist/js/bootstrapValidator.min.js"></script>
        <script src="../Validasi.js"></script>
<!-- FOOTER -->
<footer class="text-center">

  <p>Qmusik Admin © 2015</p>
</footer>