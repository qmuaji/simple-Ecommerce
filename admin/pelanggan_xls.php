<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../koneksi.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT nama_lengkap, email, alamat, status from pelanggan ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Daftar Pelanggan .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Pelanggan Qmusik");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Nama Pelanggan')
       ->setCellValue('B1', 'Email')
       ->setCellValue('C1', 'Alamat')
       ->setCellValue('D1', 'Aktif');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['nama_lengkap'])
       ->setCellValue("B$baris", $row['email'])
       ->setCellValue("C$baris", $row['alamat'])
       ->setCellValue("D$baris", $row['status']);
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Pelanggan');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="DaftarPelanggan.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 