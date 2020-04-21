<?php
try {
    $bdd = new PDO('mysql:host=cfaifrnfzyg5.mysql.db;dbname=cfaifrnfzyg5;charset=utf8', 'cfaifrnfzyg5', 'Aiut2020');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}
require('../public/pdf/fpdf.php');
$pdf = new FPDF();

$reponse = $bdd->query('SELECT * FROM membre ORDER BY date_inscription');
while ($donnees = $reponse->fetch()) {
    $pdf->AddPage();
    $file = '../public/image/web/placeholder.jpg';
    $pdf->Image($file, 150, 6, 50);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Statu :');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, $donnees['statu']);
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Pseudo :');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, $donnees['pseudo']);
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Nom :');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, $donnees['nom']);
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Prenom :');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, $donnees['prenom']);
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Email :');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, $donnees['email']);
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Telephone :');
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, $donnees['telephone']);
}
$reponse->closeCursor();
$pdf->Output();
