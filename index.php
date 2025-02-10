<?php

// show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('fpdf.php');
require('mailer.php');

// Read data from CSV file
$csvFile = fopen('data/workshop-data-main.csv', 'r');
$csvData = file_get_contents('data/workshop-data-main.csv');
$rows = array_map('str_getcsv', explode("\n", $csvData));
$header = array_shift($rows);



// Loop through data to create images
foreach($rows as $row){

$data = array_combine($header, $row);

// Get S-no and Name from CSV data
$sno = $data['S-no'];
$uname = $data['Name'];
$email= $data['Email'];
$file_name="stmc".$sno;

$font = 'fonts/Allura-Regular.ttf';
$image = imagecreatefrompng('templates/web3.png');
$name = "$uname";

$color = imagecolorallocate($image, 109, 64, 6);
$black = imagecolorallocate($image, 0, 0, 0);

//image size
$width = imagesx($image);
$height = imagesy($image);

// Logic to centre the text boxes w.r.t to image.
//text size
$text_size = imagettfbbox(260, 0, $font, $name);
$text_width = max([$text_size[2], $text_size[2]]) - min([$text_size[0], $text_size[6]]);
$text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

//centre the text
$centerX = CEIL(($width - $text_width) / 2);
$centerY = CEIL(($height - $text_height) / 2);
$centerX = $centerX < 0 ? 0 : $centerX;
$centerY = $centerY < 0 ? 0 : $centerY;

if ($centerX < 0 || $centerY < 0) {
    die("Error: Text box is out of bounds.");
}

//write
if (!imagettftext($image, 260, 0, $centerX, $centerY, $color, $font, $name)) {
    die("Error: Failed to write text to image.");
}

$idfilepath = "output/" . $file_name . ".png";

if (!imagepng($image, $idfilepath)) {
    die("Error: Failed to save image to file.");
}

// Free up memory
imagedestroy($image);

// Create a new PDF document
$pdf = new FPDF('L','mm','A4');

// Add a new page to the document
$pdf->AddPage();

// Set the document title
$pdf->SetTitle("Certificate");

// Load the PNG image
$image = $idfilepath;

// Set the position and dimensions of the image
$pdf->Image($image, 0, 0, 297, 210);

// Output path and file name
$pdfpath="pdf/" . $file_name . ".pdf";

// Output the PDF document to the browser
$pdf->Output('F', $pdfpath);

// Send mail
mailer($email,$name,$pdfpath);
}

?>