<?php
define('FPDF_FONTPATH','font/');
require('../../fpdf/fpdf.php');
include "../../koneksi/koneksi.php";
class PDF extends FPDF
{
function Header()
{
    $this->SetFont('Arial','B',13);
    $this->Cell(100);
    $this->Cell(1,10,'Katalog Buku',0,0,'C');
	$this->SetFont('Arial','I',10);
    $this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
	//$this->Ln(10);
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF('P','mm','Legal');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
//$pdf->SetX(25);
//$pdf->Cell(30,6,'Dari Tanggal',0,0,'L');
//$pdf->Cell(0,6,':  '.$tanggal1,0,0,'L');
//$pdf->Ln(5);
//$pdf->SetX(25);
//$pdf->Cell(30,6,'Sampai Tanggal',0,0,'L');
//$pdf->Cell(0,6,':  '.$tanggal2,0,0,'L');

$pdf->SetX(25);
$sql=mysql_query("select * from buku where call_number_1 = '$_GET[nocall1]' and call_number_2 = '$_GET[nocall2]' and call_number_3 = '$_GET[nocall3]' and no_induk_buku = '$_GET[noinduk]'");
$no=1;
$i=1;
$pdf->setFillColor(255,255,255);
$pdf->CELL(155,90,'',1,0,'C',1);
$pdf->SetX(25);
$pdf->SetY(31);
while ($data = mysql_fetch_array($sql)){ 
$pdf->SetX(26);
$pdf->setFillColor(255,255,255);
$pdf->cell(30,6,$data['call_number_1'],0,1,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_2'],0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(80,6,$data['pengarang'],0,0,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_3'],0,1,'L',1);
$pdf->SetX(70);
$pdf->MultiCell(110,6,$data['judul']."/",0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(80,6,$data['pengarang'],0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(110,6,"__Ed".$data['edisi_ke']."__Cet.".$data['cetakan_ke']."__".$data['kota_terbit'].": ".$data['penerbit'].".".$data['tahun_terbit'],0,1,'L',1);
$pdf->SetX(50);
$pdf->cell(80,6,"Ix, ".$data['jumlah_halaman']." p.; Ilus.".$data['ilustrasi'].".".$data['tinggi_buku']." cm",0,1,'L',1);
$pdf->SetX(50);
$pdf->cell(80,6,"Bibl. ".$data['bibliografi'],0,1,'L',1);
$pdf->SetX(50);
$pdf->cell(80,6,"ISBN. ".$data['ISBN'],0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(50,6,"1. ".$data['tajuk_subjek'],0,0,'L',1);
$pdf->cell(50,6,"I. ".$data['judul'],0,0,'L',1);
$pdf->SetY(125);
$pdf->SetX(25);
$pdf->CELL(155,90,'',1,0,'C',1);
$pdf->SetY(126);
$pdf->SetX(66);
$pdf->multicell(90,6,$data['judul'],0,1,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_1'],0,1,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_2'],0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(80,6,$data['pengarang'],0,0,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_3'],0,1,'L',1);
$pdf->SetX(70);
$pdf->multicell(110,6,$data['judul']."/",0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(80,6,$data['pengarang'],0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(110,6,"__Ed".$data['edisi_ke']."__Cet.".$data['cetakan_ke']."__".$data['kota_terbit'].": ".$data['penerbit'].".".$data['tahun_terbit'],0,1,'L',1);
$pdf->SetX(50);
$pdf->cell(80,6,"Ix, ".$data['jumlah_halaman']." p.; Ilus.".$data['ilustrasi'].".".$data['tinggi_buku']." cm",0,1,'L',1);


//KATALOG TAJUK
$pdf->SetY(220);
$pdf->SetX(25);
$pdf->CELL(155,90,'',1,0,'C',1);
$pdf->SetY(221);
$pdf->SetX(66);
$pdf->cell(90,6,$data['tajuk_subjek'],0,1,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_1'],0,1,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_2'],0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(80,6,$data['pengarang'],0,0,'L',1);
$pdf->SetX(26);
$pdf->cell(30,6,$data['call_number_3'],0,1,'L',1);
$pdf->SetX(70);
$pdf->multicell(110,6,$data['judul']."/",0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(80,6,$data['pengarang'],0,1,'L',1);
$pdf->SetX(60);
$pdf->cell(110,6,"__Ed".$data['edisi_ke']."__Cet.".$data['cetakan_ke']."__".$data['kota_terbit'].": ".$data['penerbit'].".".$data['tahun_terbit'],0,1,'L',1);
$pdf->SetX(50);
$pdf->cell(80,6,"Ix, ".$data['jumlah_halaman']." p.; Ilus.".$data['ilustrasi'].".".$data['tinggi_buku']." cm",0,1,'L',1);
//END KATALOG TAJUK

//LABEL BUKU
$pdf->SetFont('Arial','',16);
$pdf->SetY(370);
$pdf->SetX(68);
$pdf->CELL(93,25,'',1,0,'C',1);
$pdf->SetY(32);
$pdf->SetFont('Arial','',7);
$pdf->SetX(70);
$pdf->CELL(90,10,"PERPUSTAKAAN HARUN AL-RASYID STAI AULIAURRASYIDIN",1,1,'R',1);
$pdf->SetFont('Arial','',16);
$pdf->SetX(70);
$pdf->CELL(90,10,$data['no_induk_buku'],0,1,'C',1);
$pdf->Image('logo.jpg',75,33,8,8);
//END LABEL BUKU
}

$pdf->setX(135);
//$pdf->cell(50,6,$q,1,0,'L',1);
$pdf->Output();
?>