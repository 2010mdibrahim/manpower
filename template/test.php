<?php

require 'C:/xampp/htdocs/mahfuza/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
// Download file
// header("Content-Disposition: attachment; filename=\"$writer\"");
// header("Content-Type: application/vnd.ms-excel");
// $writer->save('hello world.xlsx');
// $writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode('data.xlsx').'"');
$writer->save('php://output');