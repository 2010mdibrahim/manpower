<?php
include ('database.php');
$getZip = base64_decode($_GET['doc']);
$files = explode('~',$getZip);
$zipname = 'file_'.time().'.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
    $zip->addFile('../'.$file);
}
$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);