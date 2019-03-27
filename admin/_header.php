<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../qm.png">

    <title>Qmusik Admin</title>

    <!-- Bootstrap core CSS -->

    <link href="../dist/css/bootstrap.css" rel="stylesheet">   
    <link href="../dist/css/bootstrap-datepicker.css" rel="stylesheet" >    
    <link href="../dist/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet">
    <link href="../dist/css/bootstrapValidator.min.css" rel="stylesheet">    
 
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
<!-- NAVBAR ================================================== -->
<body>
  <div class="navbar-wrapper">
    <div class="container">
      <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a href="index.php">
           <img src="../qm.png" title="Qmusik" alt="Qmusik" class="img-responsive"></a>
        </div>

        <?php  

          if(!isset($_SESSION['pengelola'])){
        ?>

        <div class="collapse navbar-collapse">
          <ul></ul>
          <ul></ul>

          <ul class="nav navbar-nav">
            <li> Qmusik Admin Panel.</li>
          </ul>
        </div>

        <?php 
          }else{
        ?>

        <!--Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">   
            <li><a href='?' title="Dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li> 
          <?php 
            if($_SESSION['pengelola_level'] == 'admin'){
          ?>
            <li><a href='index.php?f=produk_view' title="Penjualan"><span class="glyphicon glyphicon-pencil"></span> Produk</a></li> 
            <li class="dropdown">
              <a href="#" title="Laporan" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-tags"></i> Pesanan<b class="caret"></b></a>
              <ul class="dropdown-menu">
                 <li><a href='index.php?f=penjualan_view' title="Penjualan"><span class="glyphicon glyphicon-list-alt"></span> Pesanan Masuk</a></li>
                <li class="divider"></li>
                <li><a href='?f=konfirmasi_user' title="Laporan"><span class="glyphicon glyphicon-list-alt"></span> Konfirmasi Transfer</a></li>
              </ul>
            </li> 
            <li><a href='index.php?f=ongkir_view' title="Ongkos Kirim"><span class="glyphicon glyphicon-list-alt"></span> Ongkir</a></li>
            <li><a href='index.php?f=pelanggan_view' title="Pelanggan"><span class="glyphicon glyphicon-list-alt"></span> Pelanggan</a></li>
          <?php 
            }else if($_SESSION['pengelola_level'] == 'boss') {            
          ?>
            <li><a href='index.php?f=produk_view' title="Penjualan"><span class="glyphicon glyphicon-list-alt"></span> Produk</a></li> 
            <li><a href='index.php?f=pelanggan_view' title="Pelanggan"><span class="glyphicon glyphicon-list-alt"></span> Pelanggan</a></li>
<!--             <li><a href='index.php?f=laporan_view' title="Laporan"><span class="glyphicon glyphicon-list-alt"></span> Laporan</a></li> -->
           
            <li class="dropdown">
              <a href="#" title="Laporan" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list-alt"></i> Laporan<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href='?f=laporan_nota' title="Laporan"><span class="glyphicon glyphicon-list-alt"></span> Laporan Transaksi  </a></li>
               <!--  <li class="divider"></li>
                <li><a href='?f=laporan_view' title="Laporan"><span class="glyphicon glyphicon-list-alt"></span> Laporan Penjualan</a></li>
           -->  <li class="divider"></li>
                <li><a href="?f=laporan_stok"><span class="glyphicon glyphicon-list-alt" disabled="true"></span> Laporan Stok</a></li>
                <li class="divider"></li>
                <li><a href='?f=laporan_laris' title="Laporan"><span class="glyphicon glyphicon-list-alt"></span> Laporan Produk Terlaris</a></li>
              </ul>
            </li>    
            <?php } ?>   
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['pengelola_nama'] ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="../"><i class="glyphicon glyphicon-book"></i> Back to Web</a></li> 
                <li class="divider"></li>
          <!--       <li><a href="#?f=admin_setting"><span class="glyphicon glyphicon-cog" disabled="true"></span> Setting</a></li> -->
                
                <li><a href="login_act.php?&act=0"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
              </ul>
            </li>             
            <li><a href="login_act.php?&act=0" title="Log Out"><span class="glyphicon glyphicon-log-out"></span></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
        <?php } ?>
      </nav><!-- navbar -->
