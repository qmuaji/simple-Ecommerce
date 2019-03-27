<hr>
<style>
  .pajang{
  min-height: 200px; 
  max-height: 200px; 
  }
  .panjang2{
    height: 245px;
    border-bottom: 3px solid;
  }
</style>


<div class="panel-heading" style="padding-top:0px; padding-bottom:0px;"><h3>Produk acak</h3></div>
<?php 
  $home = mysql_query("SELECT * FROM barang where stok > 0 ORDER BY RAND() LIMIT 4");
  while($rand = mysql_fetch_array($home)){

?>
  <div class="col-md-3">
  <a href="index.php?f=produk_detail&id=<?php echo $rand[0]; ?>" title="Click to detail"><b><?php echo $rand['nama'] ?></b>
    <div class="thumbnail panjang2">
      
        <img class="pajang" src="images/<?php echo $rand['images_name']; ?>" alt="<?php echo $rand['nama']; ?>">
      </a>  
      <a href="index.php?f=cart&act=add&id=<?php echo $rand['brgID'] ?>" title="Beli" class="btn btn-info btn-block btn-lg"><b class="glyphicon glyphicon-shopping-cart"></b> Beli </a>
    </div>

  </div>

<?php } ?>
