<?php 
if (isset($_SESSION['pelanggan'])) {
  $nama   = $_SESSION['pelanggan_nama'];
  $email  = $_SESSION['pelanggan_email'];
}else{
  $nama   ="";
  $email  ="";
}


?>

<h3>Contact US</h3>
  <div class="panel panel-default">
    <div class="panel-body">
 
      <div class="row">
        <div class="col-sm-6"><strong>Qmusik Shop</strong><br>
          <address>Jl Caringin Ngumbarng, Sukabumi, Jawa Barat - Indonesia  </address>
        </div>
        <div class="col-sm-6"><strong>Telephone</strong><br>
           +6285722442265<br>
           <br><a href="#">muaji.risky@gmail.com</a>
           <br><a href="#">facebook.com/qmuaji</a>
        </div>
      </div>

<hr>
 <h3>Buku Tamu</h3><hr>
   <div class="col col-md-6">
  <form action="index.php?f=contact_act" method="post" class="form-horizontal" id="inserts">

         
          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Anda</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" value="<?php echo $nama ?>">
                          </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">E-Mail</label>
            <div class="col-sm-10">
              <input type="text" name="email" class="form-control" value="<?php echo $email ?>">
                          </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Komentar</label>
            <div class="col-sm-10">
              <textarea name="komentar" rows="10" class="form-control"></textarea>
                          </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Kode Captcha</label>
            <div class="col-sm-10">
              <input type="text" name="code" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3">
                <img  src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' > 
                <a href='javascript: refreshCaptcha();'><i class="glyphicon glyphicon-refresh"></i></a> 
                <script language='JavaScript' type='text/javascript'>
                  function refreshCaptcha()
                  {
                    var img = document.images['captchaimg'];
                    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
                  }
                </script> 
   
                 <input class="btn btn-primary" type="submit" value="Kirim">
            </div>
          </div>
  
    </form>
    </div>
  
    <div class="col col-md-6">
<div class="panel panel-default"> 
<div class="panel-body">
          <?php 

      $showPage   = '';
      $batas    = 3;

      if (isset($_GET['page'])) $noPage = $_GET['page'];
      else $noPage = 1;

      $offset=($noPage - 1) * $batas;
      $query  =mysql_query("SELECT * FROM buku_tamu where view='Y' LIMIT $offset, $batas");

          while ($row = mysql_fetch_array($query)) {
            ?>
           <b>From </b>: <?php echo $row['nama'] ?><br>
           <small><?php echo $row['tanggal'] ?></small><br>
           
           <p><?php echo $row['komentar'] ?></p>
           <p>Email  <?php echo " : ". $row['email'] ?></p>

            <hr>
            <?php
          } ?>
            </div>
  <div class="col-md-offset-5">
  <ul class="pagination">
  <?php 
    $q      = mysql_query("SELECT COUNT(buku_tamuID) from buku_tamu where view='Y'");
    $jml    = mysql_fetch_array($q);
    $jmlData  = $jml[0];
    $jmlPage  = ceil($jmlData / $batas);

    if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=contact&page=".($noPage-1).">&laquo;</a></li>";

    for($i=1; $i <= $jmlPage; $i++){

      if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

        if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

        if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

        if($i==$noPage) echo "<li class=active><a>$i</a></li>";

        else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=contact&page=".$i." > ".$i."</a></li>";

        $showPage=$i;
      }  
    }
   
    if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=contact&page=".($noPage+1).">&raquo;</a></li>";

  ?>
  </ul>
    
</div>
<!-- <div class="label label-danger">Total Komentar : <b><? echo $jmlData ?></b></div><br> -->
     </div>     </div>
    </div>
    </div>

  </div>