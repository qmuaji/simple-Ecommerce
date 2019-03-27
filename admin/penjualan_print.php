<?php 
if (isset($_SESSION['pengelola'])) {
  ?>
  <script type="text/javascript">
    if (window.print) {
      document.write();
    }
    setTimeout('window.print()', 1000);
    setTimeout('TO_INDEX()', 1200);
  </script>
  <div id="main">
    <?php
  if (isset($_GET['id'])) {
    $nota = $_GET['id'];

    $result = mysql_query("SELECT * FROM barang, transaksi_detail
             WHERE transaksi_detailID = '$nota'
             AND transaksi_detail.brgID = barang.brgID") or die (mysql_error());
    $pel  = mysql_query("SELECT * from pelanggan,transaksi, konfirmasi 
                 WHERE transaksi.pelangganID=pelanggan.pelangganID
                 -- AND transaksi.transaksi_detailID = konfirmasi.transaksi_detailID
                 AND transaksi.transaksi_detailID = '$nota'");
    $pel  = mysql_fetch_array($pel);
   ?>
  <div class="panel panel-default">
    <div class="text-center"><h3>QMusik Shop</h3></div>
    <div class="text-center"><h5>www.qmusik.com</h5></div>

      <div class="panel-body">
    <h3>Nota : <?php echo $nota ?></h3>
    <div class="table-responsive">
    <table class="table" >
      <tbody>
        <tr>
          <td>  
            <h5>Tanggal </h5>
            <h5>Nama Pelanggan</h5>
            <h5>No Tlp</h5>
            <h5>Email</h5>
            <h5>Alamat Kirim </h5>
          </td>
          <td>
            <h5>: <?php echo date('d F, Y', strtotime($pel['tanggal'])) ?></h5>
            <h5>: <?php echo $pel['nama_lengkap'] ?></h5>
            <h5>: <?php echo $pel['tlp'] ?></h5>
            <h5>: <?php echo $pel['email'] ?></h5>
            <h5><p>: <?php  echo $pel['alamatKirim'] ?></p></h5>
          </td>
        </tr>
      </tbody>  
    </table>
      <table class="table table-bordered table-hover">
        <thead>
          <tr class="warning">
            <th class='text-center'><small>#</small></th>
    
            <th class='text-center'>Nama Barang</th>
            <th class='text-center'>Harga <small>(Rp)</small></th>          
            <th class='text-center'>Qty</th>
            <th class='text-center'>Total <small>(Rp)</small></th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $tBerat   = 0;
          $subTotal   = 0;
          $no=1;
          $kodeUnik   = substr($nota, 6,10);
          while($rows = mysql_fetch_array($result)){
        
            $nm   = $rows['nama'];
            $harga  = $rows['hrg'];
            $stok   = $rows['qty'];       
            $berat  = $rows['berat'];
            $ongkos = $pel['totalOngkir'];

           ?>
          <tr>
            <td class='text-center'><small><?php echo $no ?></small></td>
            <td><small><?php echo $nm ?></small></td>
            <td class='text-right'><?php echo number_format($harga,0,',','.'); ?></td>          
            <td class='text-center'><?php echo $stok ?></td>
            <td class='text-right'><?php echo number_format($harga*$stok,0,',','.'); ?></td>
          </tr>
          <?php 
            $no++;
            $subTotal = $subTotal+($harga*$stok); 
            $tBerat   = $tBerat + $berat;
          }
         ?>
          <tr>
            <td align="right" colspan="4">Sub-Total </td>
            <td align="right"><b><?php echo number_format($subTotal,0,',','.') ?></b></td>  
          </tr>
          <tr>
            <td align="right" colspan="4">Total Berat </td>
            <td align="right"><b><?php echo $tBerat ?> Kg</b></td>  
          </tr>
          <tr>
            <td align="right" colspan="4">Ongkos kirim </td>
            <td align="right"><b><?php echo number_format($ongkos,0,',','.') ?></b></td>  
          </tr>
          <tr>
            <td align="right" colspan="4">Total bayar </td>
            <td align="right"><b><?php echo number_format($subTotal+$ongkos+$kodeUnik,0,',','.') ?> </b></td> 
          </tr>
          <tr>
            <td align="right" colspan="4">Total Transfer </td>
            <td align="right"><b><?php echo number_format($pel['jumlah_transfer'],0,',','.') ?> </b></td> 
          </tr>
          <tr>
            <td align="right" colspan="4">Kembali </td>
            <td align="right"><b><?php echo number_format(($pel['jumlah_transfer'])-($subTotal+$ongkos+$kodeUnik),0,',','.') ?> </b></td> 
          </tr>
        </tbody>
      </table>
      <p>* Demi keamanan, Total biaya di tambahkan kode unik sesuiai digit terakhir nota.</p>
     
    </div>
    </div>
  </div>
  <?php }
  ?></div>
  <?php 

}else{
  ?>
    <script>
        alert("Maaf Anda harus Login terlebihdahulu!");
        history.back();
    </script>
  <?php
}