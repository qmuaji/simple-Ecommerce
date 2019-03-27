<?php
require('../plugins/fpdf/mysql_table.php');
require('../koneksi.php');
require_once 'function.php';
class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Daftar Ongkos Kirim Qmusik',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}


$pdf=new PDF();
// $pdf->AddPage();
// //First table: put all columns automatically
// $pdf->Table('SELECT `employeeNumber`, `firstName`,`extension` from employees order by `employeeNumber`');
$pdf->AddPage();
//Second table: specify 3 columns

$pdf->AddCol('provinsi_nama',50,'Provinsi','L');
$pdf->AddCol('kokab_nama',70,'Kota/Kabupaten','L');
$pdf->AddCol('harga',40,'Harga /Kg (Rp)','R');
$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Table('SELECT harga, kokab_nama, provinsi_nama 
						 FROM ongkir, kota_kab, master_provinsi 
						 WHERE ongkir.ongkirID = kota_kab.kokabID 
						 AND kota_kab.provinsi_ID=master_provinsi.provinsi_ID 
						 order by provinsi_nama',$prop);

//$pdf->Output("C:\Users\John\Desktop/somename.pdf",'F'); 


$pdf->Output($downloadfilename.".pdf"); 
header('Location: '.$downloadfilename.".pdf");
?>
