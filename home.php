<div class="container-fluid">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="images/banner1.gif" alt="First Qmusik">
      <div class="container">
        <div class="carousel-caption">
<!--           <h1>Example headline.</h1>
          <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
          <p><a class="btn btn-lg btn-info" href="#" role="button">Sign up today</a></p>
        --> </div>
      </div>
    </div>
    <div class="item">
      <img class="second-slide" src="images/banner1.gif" alt="Second Qmusik">
      <div class="container">
        <div class="carousel-caption">
<!--           <h1>Another example headline.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-info" href="#" role="button">Learn more</a></p>
        --> </div>
      </div>
    </div>
    <div class="item">
      <img class="third-slide" src="images/banner1.gif" alt="Third Qmusik">
      <div class="container">
        <div class="carousel-caption">
<!--           <h1>One more for good measure.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-info" href="#" role="button">Browse gallery</a></p>
         --></div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<style>
  .pajang{
  min-height: 200px; 
  max-height: 200px; 
  }
  .panjang2{
    height: 330px;
    border-bottom: 3px solid;
  }
</style>

<div class="container-fluid">
<div class="panel-heading" style="padding-top:0px; padding-bottom:0px;"><h3>Produk acak</h3></div>
<?php 
  $home = mysql_query("SELECT * FROM barang ORDER BY RAND() LIMIT 4");
  while($rand = mysql_fetch_array($home)){

?>
  <div class="col-sm-3">
    <a href="index.php?f=produk_detail&id=<?php echo $rand[0] ?>" title="Click to detail"><b><?php echo $rand['nama'] ?></b>
    <div class="thumbnail panjang2">
  
        <img class="pajang" src="images/<?php echo $rand['images_name']; ?>" alt="<?php echo $rand['nama']; ?>">
      </a>  
      <a href="index.php?f=cart&act=add&id=<?php echo $rand['brgID'] ?>" title="Beli" class="btn btn-info btn-block btn-lg"><b class="glyphicon glyphicon-shopping-cart"></b> Beli </a>
    <div class="caption">

      <small>
        <p style="text-align: justify"><?php    $desc = substr($rand['desk'], 0, 100);
                $len  = strlen($desc);
                if($len >= 100) echo $desc."...";
                else echo $desc; ?>
        </p>
      </small>

    </div>
    </div>

  </div>

<?php } ?>
</div>
