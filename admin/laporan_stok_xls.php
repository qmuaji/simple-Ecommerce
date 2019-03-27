<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../koneksi.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

if($_GET['cari'] != ""){

  $cari = $_GET['cari'];
  $qStok = "select brgID, nama,  stok, hrg, (hrg*stok) as nilai from barang WHERE nama like '%$cari%' order by stok";

}else{

  $qStok ='select brgID, nama,  stok, hrg, (hrg*stok) as nilai from barang order by stok';
}

$hasil = mysql_query($qStok);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Stok Produk .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Stok Produk Qmusik");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Kode')
       ->setCellValue('B1', 'Nama Produk')
       ->setCellValue('C1', 'Harga (Rp)')
       ->setCellValue('D1', 'Stok')
       ->setCellValue('E1', 'Nilai Rp');
 
$baris = 2;
$no = 0;      
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['brgID'])
       ->setCellValue("B$baris", $row['nama'])
       ->setCellValue("C$baris", number_format($row['hrg']))
       ->setCellValue("D$baris", $row['stok'])
       ->setCellValue("E$baris", number_format($row['nilai']));
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Stok');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Data_Stok_Produk.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 