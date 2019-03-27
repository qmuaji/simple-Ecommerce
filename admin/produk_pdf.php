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
	$this->Cell(0,6,'Daftar Produk Qmusik',0,1,'C');
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

$pdf->AddCol('nama',100,'Nama Barang','L');
$pdf->AddCol('hrg',40,'Harga (Rp)','R');
$pdf->AddCol('stok',15,'stok','C');
$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Table('select nama,  stok, hrg from barang order by stok',$prop);

//$pdf->Output("C:\Users\John\Desktop/somename.pdf",'F'); 


$pdf->Output($downloadfilename.".pdf"); 
header('Location: '.$downloadfilename.".pdf");
?>
