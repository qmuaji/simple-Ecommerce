<?php

error_reporting(E_ALL);

require_once '../plugins/excel/PHPExcel.php';
require_once '../koneksi.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT harga, kokab_nama, provinsi_nama 
             FROM ongkir, kota_kab, master_provinsi 
             WHERE ongkir.ongkirID = kota_kab.kokabID 
             AND kota_kab.provinsi_ID=master_provinsi.provinsi_ID 
             order by provinsi_nama";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Daftar Ongkir .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Ongkir Qmusik");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Provinsi')
       ->setCellValue('B1', 'Kota/Kabupaten')
       ->setCellValue('C1', 'Harga /Kg (Rp)');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['provinsi_nama'])
       ->setCellValue("B$baris", $row['kokab_nama'])
       ->setCellValue("C$baris", $row['harga']);
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Ongkos Kirim Qmusik');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="DaftarOngkir.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 