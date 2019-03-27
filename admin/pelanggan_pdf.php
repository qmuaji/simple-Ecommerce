<?php
require('../plugins/fpdf/mysql_table.php');
require('../koneksi.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Daftar Pelanggan Qmusik',0,1,'C');
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

$pdf->AddCol('nama_lengkap',50,'Nama Pelanggan','L');
$pdf->AddCol('email',40,'Email','L');
$pdf->AddCol('alamat',100,'Alamat','L');
$pdf->AddCol('status',15,'Aktif','C');
$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Table('select nama_lengkap,  email, alamat, status from pelanggan order by nama_lengkap',$prop);

//$pdf->Output("C:\Users\John\Desktop/somename.pdf",'F'); 


$pdf->Output($downloadfilename.".pdf"); 
header('Location: '.$downloadfilename.".pdf");
?>
