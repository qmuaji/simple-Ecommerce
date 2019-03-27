<div class="panel panel-default">

	<div class="panel-heading">
		<h3>Grafik Penjualan / Jenis Produk</h3>
	</div>
	<div class="panel-body">
		<html>
	<head>
<script src="../dist/js/jquery.min.js" type="text/javascript"></script>
<script src="../dist/js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'Produk',
            type: 'column'
         },   
         title: {
            text: 'Grafik Penjualan / Jenis Produk'
         },
         xAxis: {
            categories: ['Total Terjual']
         },
         yAxis: {
            title: {
               text: 'Terjual '
            }
         },
              series:             
            [
            <?php 

           $sql   = "SELECT distinct jenisID,nama  FROM jenisbarang ";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
              $a=$ret[0];
            	$nama=$ret[1];                     
                 $sql_jumlah   = "SELECT sum(qty)as Total from transaksi,transaksi_detail,barang,jenisbarang,kategori WHERE barang.kategoriID = kategori.kategoriID and jenisbarang.jenisID=kategori.jenisID and transaksi_detail.brgID=barang.brgID and jenisbarang.jenisID= '$a' and transaksi.transaksi_detailID=transaksi_detail.transaksi_detailID and status2='COMPLETED'";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data[0];                 
                  }             
                  ?>
                  {
                      name: "<?php echo $nama; ?>",
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
	</head>
	<body>
		<div id='Produk'></div>		
	</body>
</html>
	</div>

</div>
