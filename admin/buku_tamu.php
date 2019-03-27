<div class="panel panel-default"> 
  <div class="panel-heading"><h3>Buku Tamu</h3>
  </div>
<div class="panel-body">
          <?php 

      $showPage   = '';
      $batas    = 4;

      if (isset($_GET['page'])) $noPage = $_GET['page'];
      else $noPage = 1;

      $offset=($noPage - 1) * $batas;
      $query  =mysql_query("SELECT * FROM buku_tamu LIMIT $offset, $batas");

          while ($row = mysql_fetch_array($query)) {       
            $view = $row['view'];
            if($view == 'Y'){
              $btn = "btn-success";
            }else{
              $btn = "btn-danger";
            }
            ?>
           <b>From </b>: <?php echo $row['nama'] ?><br>             
           <div class="pull-right">
                <a href="index.php?f=komentar_act&act=<?php echo $row['view'] ?>&id=<?php echo $row['buku_tamuID'] ?>" class="btn <?php echo $btn ?>"> tampilkan</a>
            </div>
           <small><?php echo $row['tanggal'] ?></small><br>
           
           <p><?php echo $row['komentar'] ?></p>
           <p>Email  <?php echo " : ". $row['email'] ?> </p>

            <hr>
            <?php
          } ?>
            </div>
  <div class="col-md-offset-5">
  <ul class="pagination">
  <?php 
    $q      = mysql_query("SELECT COUNT(buku_tamuID) from buku_tamu");
    $jml    = mysql_fetch_array($q);
    $jmlData  = $jml[0];
    $jmlPage  = ceil($jmlData / $batas);

    if($noPage > 1) echo "<li><a href=$_SERVER[PHP_SELF]?page=".($noPage-1).">&laquo;</a></li>";

    for($i=1; $i <= $jmlPage; $i++){

      if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

        if(($showPage == 1) && ($i != 2)) echo "<li><a>...</a></li>";

        if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<li><a>...</a></li>";

        if($i==$noPage) echo "<li class=active><a>$i</a></li>";

        else echo "<li><a href=".$_SERVER['PHP_SELF']."?page=".$i." > ".$i."</a></li>";

        $showPage=$i;
      }  
    }
   
    if ($noPage < $jmlPage) echo "<li><a href=$_SERVER[PHP_SELF]?page=".($noPage+1).">&raquo;</a></li>";

  ?>
  </ul>
    
</div>
<div class="label label-danger">Total Komentar : <b><? echo $jmlData ?></b></div><br>
</div>