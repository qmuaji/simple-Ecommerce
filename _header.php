<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="qm.png">

    <title>Qmusik Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="dist/css/bootstrap-datepicker3.css" rel="stylesheet">

    <!--<link href="dist/css/bootstrap-theme.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
   <!--  <link href="dist/css/carousel.css" rel="stylesheet"> -->
    <link href="dist/css/bootstrapValidator.min.css" rel="stylesheet">
    
  </head>
  
<!-- NAVBAR
================================================== -->
<body>
  <div class="navbar-wrapper">
    <div class="container">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a href="#">
           <img src="qm.png" title="Qmusik" alt="Qmusik" class="img-responsive"></a>
        </div>
      
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="dropdown"> 
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
          <ul class="dropdown-menu mega-menu">            
          
          <?php 
            $q = mysql_query("SELECT * from jenisbarang ");
            while($rows = mysql_fetch_array($q)){
              $jenisID = $rows['jenisID'];

              $kat = mysql_query("SELECT kategoriID, kategori 
                                  FROM kategori 
                                  WHERE kategori.jenisID=$jenisID");

              ?>
                <li class="mega-menu-column">
                  <ul>
                   <li class="nav-header"><h4> <?php echo $rows['nama'] ?></h4></li>
                    <img src="images/<?php echo $rows['images_name'] ?>">
                    <?php 
                      while($row2 = mysql_fetch_array($kat)){
                        ?>                          
                        <li><a href="index.php?f=produk_view&id=<?php echo $row2['kategoriID'] ?>"><?php echo $row2['kategori'] ?></a></li>
                        <?php 
                      }
                    ?>
                  </ul> 
                </li>       
              <?php
               //var_dump($rows);
            }                 
          ?>                      
          </ul>
          <!-- dropdown-menu -->                       
        </li>
            <li><a href="index.php?f=about" title="About">About</a></li>
            <form action="index.php?f=produk_view" class="navbar-form navbar-left" role="search" method="post" id="inserts2">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" name="nama" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">GO!</button>
                  </span>
                </div>
              </div>
            </form>              
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?f=contact" title="Contact"><span class="glyphicon glyphicon-phone-alt"></span></a></li>
            <li class="dropdown">
                <a href="#" title="My Account" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php if(isset($_SESSION['pelanggan'])) echo ucwords((strtolower($_SESSION['pelanggan_nama']))) ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
              <?php  

                if(!isset($_SESSION['pelanggan'])){
              ?>
                    <li><a href="index.php?f=user_register"><i class="glyphicon glyphicon-pencil"></i> Login / Register</a></li>
              <?php }else{ ?>
                    <li><a href="index.php?f=history&id=<?php echo $_SESSION['pelanggan'] ?>"><i class="glyphicon glyphicon-book"></i> Histori belanja</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?f=user_edit_form"><i class="glyphicon glyphicon-pencil"></i> Edit Account</a></li>
                    <li><a href="user_login_act.php?act=0"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
              <?php } ?>
              </ul>
            </li>
<!--             <?php 
              if (!empty($_SESSION['cart'])) {
                $subTotal = 0;
                $item    = 0;
                $total   = 0;
                foreach ($_SESSION['cart'] as $id => $x) {  

                  $result = mysql_query("SELECT hrg from barang WHERE brgID = '$id'");
                  $rows = mysql_fetch_array($result);
                  $hrg  = $rows['hrg'];
                  $total  = $hrg * $x;
                  $subTotal = $subTotal + $total;
                  $item = $item + $x;
                }
              }else{
                $item = "0";
                $subTotal = "0";
              }
            ?> -->
            <li><a href="index.php?f=cart&act=none" title="Shopping Cart"><b class="glyphicon glyphicon-shopping-cart"></b><!--  <?php echo $item; ?> item(s) - Rp <?php echo number_format($subTotal,0,',','.'); ?> --></a></li>
            <li><a href="index.php?f=alamat_kirim" title="Check Out"><span class="glyphicon glyphicon-share-alt"></span></a></li>
          </ul>
        </div>
      </div><!-- /.navbar-collapse -->
      </nav>
    </div>  
  </div>
  