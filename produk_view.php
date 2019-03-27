<?php   
$showPage   = '';
$batas    = 10;

if (isset($_GET['page'])) $noPage = $_GET['page'];
else $noPage = 1;

$offset=($noPage - 1) * $batas;

 ?>

<style>
  .pajang0{
  min-height: 200px; 
  max-height: 200px; 
  }
  .panjang1{
    height: 330px;
    border-bottom: 3px solid;
  }
</style>

<div class="container-fluid">

<?php 

if(isset($_POST['nama'])){ 

  $cari=trim($_POST['nama']);  

      $view = mysql_query("SELECT * FROM barang
                   WHERE nama like '%$cari%'                     
                   LIMIT  $offset, $batas");
       $q    = mysql_query("SELECT COUNT(brgID) from barang 
                    WHERE nama like '%$cari%' 
                    ");
 
   
  ?>
  <div class="panel-heading" style="padding-top:0px; padding-bottom:0px;"><h3>Hasil Cari :  <?php echo $cari ?></h3></div>
  <?php

}else{
  $q    = mysql_query("SELECT COUNT(brgID) from barang 
                        WHERE kategoriID=$_GET[id] 
                        ");
  $view = mysql_query("SELECT * FROM barang 
                       WHERE kategoriID=$_GET[id]                         
                       LIMIT $offset, $batas");
  $kat = mysql_fetch_array(mysql_query("SELECT kategori from kategori where kategoriID=$_GET[id]"));

  ?>
  <div class="panel-heading" style="padding-top:0px; padding-bottom:0px;"><h3><?php echo $kat['kategori'] ?></h3></div>
  <?php
}
$hasil=mysql_num_rows($view);

if ($hasil > 0) {

?>

  <hr>
  <?php
    while($prod = mysql_fetch_array($view)){

  ?>

    <div class="col-sm-4">
      <a href="index.php?f=produk_detail&id=<?php echo $prod[0]; ?>" title="Click to detail"><b><?php echo $prod['nama'] ?></b>
      <div class="thumbnail panjang1">
        
          <img class="pajang0" src="images/<?php echo $prod['images_name']; ?>" alt="<?php echo $prod['nama']; ?>">
        </a>  
        <a href="index.php?f=cart&act=add&id=<?php echo $prod['brgID'] ?>" title="Beli"><button class="btn btn-info btn-block"><b class="glyphicon glyphicon-shopping-cart"></b> <?php echo "Rp ".number_format($prod['hrg'],0,',','.'); ?></button></a>
      
      <div class="caption">

        <small>
          <p style="text-align: justify">
          <?php   $desc = substr($prod['desk'], 0, 100);
                  $len  = strlen($desc);
                  if($len >= 100) echo $desc."...";
                  else echo $desc; 
              ?>
          </p>
        </small>

      </div>
      </div>

    </div>

  <?php }
}else{
  ?>
  <?php echo "Hasil pencarian tidak ditemukan...";   ?><br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <?php
}
?>

  </div>
  <div class="col-md-offset-5">
  <ul class="pagination">
  <?php 

    $jml    = mysql_fetch_array($q);
    $jmlData  = $jml[0];
    $jmlPage  = ceil($jmlData / $batas);

    if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?f=produk_view&page=".($noPage-1).">&laquo;</a></li>";

    for($i=1; $i <= $jmlPage; $i++){

      if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

        if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

        if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

        if($i==$noPage) echo "<li class=active><a>$i</a></li>";

        else echo "<li><a href=".$_SERVER['PHP_SELF']."?f=produk_view&page=".$i." > ".$i."</a></li>";

        $showPage=$i;
      }  
    }
   
    if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?f=produk_view&page=".($noPage+1).">&raquo;</a></li>";

  ?>
  </ul>
    
</div>
<div class="label label-danger">Total Item : <b><? echo $jmlData ?></b></div><br>

