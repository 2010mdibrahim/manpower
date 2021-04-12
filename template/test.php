<?php
// reference the Dompdf namespace
require_once '../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$test = $_GET['test'];
print_r($test);

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($test);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();
$f;
$l;
if(headers_sent($f,$l))
{
    echo $f,'<br/>',$l,'<br/>';
    die('now detect line');
}


// Output the generated PDF to Browser
$dompdf->stream();