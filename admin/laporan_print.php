<script type="text/javascript">
  if (window.print) {
    document.write();
  }
  setTimeout('window.print()', 1000);
  setTimeout('TO_INDEX()', 1200);
</script>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Laporan Penjualan QMusik </h3>
  </div>
<?php 
  if (!(empty($_GET['end']))){
    $start  = date('y-m-d', strtotime($_GET['start']));
    $end  = date('y-m-d', strtotime($_GET['end'])); 
    $result = mysql_query("SELECT *, sum(Q) as q2, sum(total) as total2 FROM v_totaljual WHERE tanggal BETWEEN '$start' AND '$end' group by nama") or die (mysql_error());
    $ongkir = mysql_fetch_row(mysql_query("SELECT sum(totalOngkir) from transaksi
                         where status='COMPLETED'
                         AND tanggal BETWEEN '$start' AND '$end'"));
    $ket  = date('d F Y', strtotime($_GET['start'])). " - ".date('d F Y', strtotime($_GET['end']));
  }else{
    $ket  = 'Awal - Akhir';
    $result = mysql_query("SELECT *, sum(Q) as q2, sum(total) as total2 FROM v_totaljual GROUP BY nama") or die (mysql_error());
    $ongkir = mysql_fetch_row(mysql_query("SELECT sum(totalOngkir) from transaksi where status='COMPLETED'"));
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
          <th class='text-center'>Nama Barang</th>
          <th class='text-center'>Harga / unit</th>
          <th class='text-center'>Qty</th>
          <th class='text-center'>Total</th>  
        </tr>
      </thead>
      <tbody>
      <?php 
        $subTotal=0;
        while($rows = mysql_fetch_array($result)){
      
          $nama   = $rows['nama'];
          $hrg  = $rows['hrg'];
          $qty  = $rows['q2'];
          $total  = $rows['total2'];
          $subTotal = $subTotal + $total;

         ?>
        <tr>
          <td class='text-center'><small><?php echo $no ?></small></td>
          <td><?php echo $nama ?></td>
          <td class='text-center'><small><?php echo $hrg ?></small></td>
          <td>
            <small>
              <?php echo $qty ?>
            </small> 
          </td>
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
          <td colspan="4" class='text-right'>
            SubTotal
          </td>   
          <td class='text-right'>
            <b><?php echo number_format($subTotal,0,',','.') ?></b>
          </td>

        </tr>
        <tr>
          <td colspan="4" class='text-right'>
            Total Ongkir
          </td>
          <td class='text-right'>
            <b><?php echo number_format($ongkir[0],0,',','.'); ?></b>
          </td>
        </tr>
        <tr>
          <td colspan="4" class='text-right'>
            GTotal
          </td>
          <td class='text-right'>
            <b><?php echo number_format(($ongkir[0]+$subTotal),0,',','.'); ?></b>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>