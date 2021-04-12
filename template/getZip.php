<?php
include ('database.php');
$getZip = $_GET['doc'];
$files = explode('~',$getZip);
$zipname = 'file_'.time().'.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
    $name = explode('/',$file);
    $zip->addFile('../'.$file , end($name));
}
$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);