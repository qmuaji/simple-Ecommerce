<script type="text/javascript">
  if (window.print) {
    document.write();
  }
  setTimeout('window.print()', 1000);
  setTimeout('TO_INDEX()', 1200);
</script>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Laporan Transaksi QMusik </h3>
  </div>
<?php 
  if (!empty($_GET['end']) && !empty($_GET['start'])){
    $start  = date('y-m-d', strtotime($_GET['start']));
    $end  = date('y-m-d', strtotime($_GET['end'])); 
    $result = mysql_query("SELECT tanggal, transaksi.transaksi_detailID, hrg * sum(qty) as total
                            FROM transaksi, transaksi_detail, barang
                            WHERE transaksi.transaksi_detailID = transaksi_detail.transaksi_detailID
                            AND transaksi_detail.brgID = barang.brgID 
                            AND transaksi.status2='COMPLETED'
                            AND tanggal BETWEEN '$start' AND '$end'
                            GROUP BY transaksi.transaksi_detailID") or die (mysql_error());
    
    $ongkir = mysql_fetch_row(mysql_query("SELECT sum(totalOngkir) from transaksi
                         where status2='COMPLETED'
                         AND tanggal BETWEEN '$start' AND '$end'"));
    $ket  = date('d F Y', strtotime($_GET['start'])). " - ".date('d F Y', strtotime($_GET['end']));
    $print  = "BETWEEN '$start' AND '$end'";
  }else{
    $start  ="";
    $end  =date('y-m-d');
    $ket  = 'Awal - Akhir';
    $result = mysql_query("SELECT tanggal, transaksi.transaksi_detailID, hrg * sum(qty) as total
                            FROM transaksi, transaksi_detail, barang
                            WHERE transaksi.transaksi_detailID = transaksi_detail.transaksi_detailID
                            AND transaksi_detail.brgID = barang.brgID 
                            AND transaksi.status2='COMPLETED'
                            AND tanggal BETWEEN '$start' AND '$end'
                            GROUP BY transaksi.transaksi_detailID") or die (mysql_error());
    $ongkir = mysql_fetch_row(mysql_query("SELECT sum(totalOngkir) from transaksi where status2='COMPLETED' AND tanggal BETWEEN '$start' AND '$end'"));
  }
  $no = 1;
  
 ?>
<div class="panel-body">
  <p>Periode : <?php echo $ket ?></p>
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="warning">
          <th class='text-center'><small>#</small></th>
          <th class='text-center'>Tanggal</th>
          <th class='text-center'>Nota</th>
          <th class='text-center'>Total</th>  
        </tr>
      </thead>
      <tbody>
      <?php 
        $subTotal=0;
        while($rows = mysql_fetch_array($result)){
      
          $nama   = $rows['tanggal'];
          $hrg  = $rows['transaksi_detailID'];
          $total  = $rows['total'];
          $subTotal = $subTotal + $total;

         ?>
        <tr>
          <td class='text-center'><small><?php echo $no ?></small></td>
          <td><?php echo $nama ?></td>
          <td class='text-center'><small><?php echo $hrg ?></small></td>

          <td class='text-right'><?php echo number_format($total,0,',','.') ?></td>
<!--          <td class='text-center'>          
  <a href="index.php?f=pelanggan_edit&id=<?php echo $rows['pelangganID']; ?>" class="btn btn-default" title="Edit <?php echo $tgl ?>"><b class="glyphicon glyphicon-edit"></b></a>
  <a href="index.php?f=pelanggan_act&act=delete&id=<?php echo $rows['pelangganID']; ?>" class="btn btn-warning" title="Hapus <?php echo $tgl ?>"><b class="glyphicon glyphicon-trash"></b></a>    
</td> -->
        </tr>
        <?php 
          $no++;  
        }
       ?>
        <tr>    
          <td colspan="3" class='text-right'>
            SubTotal
          </td>   
          <td class='text-right'>
            <b><?php echo number_format($subTotal,0,',','.') ?></b>
          </td>

        </tr>
        <tr>
          <td colspan="3" class='text-right'>
            Total Ongkir
          </td>
          <td class='text-right'>
            <b><?php echo number_format($ongkir[0],0,',','.'); ?></b>
          </td>
        </tr>
        <tr>
          <td colspan="3" class='text-right'>
            GTotal
          </td>
          <td class='text-right'>
            <b><?php echo number_format(($ongkir[0]+$subTotal),0,',','.'); ?></b>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>