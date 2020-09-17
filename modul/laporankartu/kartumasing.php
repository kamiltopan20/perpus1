<?php
define('FPDF_FONTPATH','font/');
require('../../fpdf/fpdf.php');
include "../../koneksi/koneksi.php";
class PDF extends FPDF
{

//Page header
function Header()
{
    $this->SetFont('Arial','B',10);
    $this->Cell(100);
    $this->Cell(1,10,'Kartu Anggota',0,0,'C');
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
  //  $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$sql=mysql_query("select * from anggota where no_agt = '$_GET[no]'");
//$sql2=mysql_query("select count(*) as jumlah from kamar,jenis where jenis.no_jenis = kamar.no_jenis order by status");

//$data2 = mysql_fetch_array($sql2);
//$jumlah = $data2['jumlah'];
$i=25;
$h=0;
$pdf->SetY(25);
$pdf->SetX(5);
while ($data = mysql_fetch_array($sql)){ 
//$x = 79;
//$h+=38;;
//$pdf->SetX(10);
 // $pdf->Image('../../images/anggota/'.$data['no_agt'].'.jpg',12, $h, 16, 19);
$pdf->setFillColor(255,255,255);
$pdf->SetX(3);
$pdf->CELL(95,60,'',1,0,'C',1);
$pdf->CELL(95,60,'',1,0,'C',1);
$pdf->Ln(1);
$pdf->SetX(5);
$pdf->cell(28,3,$pdf->Image('header2copy.jpg'),0,1,'L',1);
$pdf->SetX(5);
$pdf->CELL(30,5,'No. Anggota',0,0,'L',1);
$pdf->SetX(35);
$pdf->SetFont('Arial','',9);
$pdf->cell(28,4,': '.$data['no_agt'],0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetX(60);

$pdf->SetX(75);
$pdf->cell(20,4,'',0,1,'L',1);
$pdf->SetX(5);
$pdf->CELL(30,4,'Nama',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(28,4,': '.$data['nama'],0,0,'L',1);
$pdf->SetX(132);
$pdf->cell(28,4,'Kartu Perpustakaan Digunakan Untuk Meminjam, Mengembalikan Buku,',0,1,'C',1);
$pdf->SetX(132);
$pdf->cell(28,4,'dan Pada Saat Mengurus Surat Bebas Pustaka',0,1,'C',1);
$pdf->SetX(15);
$pdf->cell(35,4,$pdf->Image('../../images/anggota/'.$data['no_agt'].'.jpg',$pdf->GetX(),$pdf->GetY()+5,16,19),0,0,'L',0);
$pdf->SetFont('Arial','',7);
$pdf->SetX(40);
$pdf->cell(28,3,'---------------------------------------------------------------',0,0,'L',1);
$pdf->SetX(132);
$pdf->cell(28,4,'Dilarang Meminjamkan Kartu Kepada Orang Lain',0,1,'C',1);
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$bulansekarang = date("m", $tanggal);
$tanggalsekarang = date("d", $tanggal);
$tahunsekarang = date("Y", $tanggal);
switch($bulansekarang){
case '01':
$bulan = 'Januari';
break;
case '02':
$bulan = 'Februari';
break;
case '03':
$bulan = 'Maret';
break;
case '04':
$bulan = 'April';
break;
case '05':
$bulan = 'Mei';
break;
case '06':
$bulan = 'Juni';
break;
case '07':
$bulan = 'Juli';
break;
case '08':
$bulan = 'Agustus';
break;
case '09':
$bulan = 'September';
break;
case '10':
$bulan = 'Oktober';
break;
case '11':
$bulan = 'November';
break;
case '12':
$bulan = 'Desember';
break;
}
$pdf->SetX(40);
$pdf->cell(28,3,"Tembilahan, $tanggalsekarang $bulan $tahunsekarang",0,0,'L',1);
$pdf->SetX(132);
$pdf->cell(28,4,'Jika Kartu Hilang, Segera Hubungi Petugas Perpustakaan',0,1,'C',1);
$pdf->SetX(40);
$pdf->cell(28,3,'Kepala Perpustakaan,',0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(28,3,'',0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(28,3,'',0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(28,3,'',0,1,'L',1);
$pdf->SetX(40);
//$tampilkepala = mysql_fetch_array(mysql_query("select * from kepala_perpustakaan where id=1"));
$pdf->cell(28,3,'( _______ )',0,1,'L',1);
$pdf->SetX(10);
$i++;
$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
}
/*$pdf->Cell(20,5,$data['no_jenis'],$i,0,1);
$pdf->Cell(58,5,$data['jns_kamar'],$i,0,1);
$pdf->Cell(45,5,$data['status'],$i,0,1);*/


//for($i=1;$i<=40;$i++)
$pdf->Output();
?>