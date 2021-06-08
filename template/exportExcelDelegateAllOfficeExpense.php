<?php
include ('database.php');
require $base_dir.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Date');
$sheet->setCellValue('B1', 'Particular');
$sheet->setCellValue('C1', 'Debit');
$sheet->setCellValue('D1', 'Credit');
$sheet->getStyle('A1:D1')->getFont()->setBold(true);
$i = 2;

$delegateId = base64_decode($_GET['delegateId']);
$full_report = $_GET['full_report'];
if($full_report == 'yes'){
    $result = $conn->query("SELECT * from account_maheer order by `date` desc");
}else{
    $result = $conn->query("SELECT * from account_maheer order by `date` desc limit 100");
}
$total_debit = 0;
$total_credit = 0;
// var_dump($result);
// exit();
if($result->num_rows != 0){
    while($office = mysqli_fetch_assoc($result)){
        $sheet->setCellValue('A'.$i, $office['date']);
        $sheet->setCellValue('B'.$i, $office['particular']);
        $sheet->setCellValue('C'.$i, $office['debit'] * $office['dollar_rate_debit']);
        $sheet->setCellValue('D'.$i, $office['credit']);
        $i++;
        $total_credit += $office['credit'];
        $total_debit += $office['debit'] * $office['dollar_rate_debit'];
    }
}else{
    
}
$sheet->setCellValue('A'.$i, 'SUM');
$sheet->setCellValue('C'.$i, $total_debit);
$sheet->setCellValue('D'.$i, $total_credit);
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode('Office_Expense_List.xlsx').'"');
$writer->save('php://output');