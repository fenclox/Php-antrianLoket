<?php
include 'koneksi.php';

$now = date('Y-m-d');

$query = mysqli_query($koneksi, "SELECT MAX(no_urut) as no_urut
                                FROM  ex_antrian
                                WHERE DATE(tanggal_ins) = '$now'");
                                
$row = mysqli_fetch_array($query);

// Get value dari form
$no_urut   = $row['no_urut']+=1;

// Melakukan query insert
$sql = "INSERT INTO ex_antrian (no_urut) VALUES ('$no_urut')";

if(mysqli_query($koneksi, $sql)){
// if($no_urut){
     // manggil file fpdf untuk report
     require('fpdf182/fpdf.php');

     //Create a new PDF file
     $pdf = new FPDF('L','mm',array(80,50));

     $pdf->AddPage();
     $pdf->SetAutoPageBreak(false);

     $pdf->SetFont('Arial','b',12);
     $pdf->Cell(0,-5,'RS Bunda Mulia',0,0,'C');
     // Line break
     $pdf->Ln(1);

     $pdf->SetFont('Arial','b',8);
     $pdf->Cell(0,5,'Jl. Raya Imam Bonjol No.80A, Sukadanau, Cikarang Bar.',0,0,'C');
     // Line break
     $pdf->Ln(5);
     
     $pdf->SetFont('Arial','b',50);
     $pdf->Cell(0,25,$no_urut,0,0,'C');
     // Line break
     $pdf->Ln(5);

     $pdf->SetFont('Arial','b',8);
     $pdf->Cell(0,41,'"Kesehatan anda adalah kebahagiaan kami"',0,0,'C');

     // $pdf->SetY( -15 );
     // $pdf->Cell(0,10,'Left text',0,0,'L');
     // $pdf->SetX($pdf->lMargin);
     // $pdf->Cell(0,10,'Center text:',0,0,'C');
     // $pdf->SetX($pdf->lMargin);
     // $pdf->Cell( 0, 10, 'Right text', 0, 0, 'R' ); 

     // $pdf->SetFont('Arial','B',16);
     // // Move to 8 cm to the right
     // $pdf->Cell(80);
     // // Centered text in a framed 20*10 mm cell and line break
     // $pdf->Cell(20,10,'Title',1,1,'C');

     $pdf->Output();

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($koneksi);
}
 
// Menutup connection
mysqli_close($koneksi);
?>