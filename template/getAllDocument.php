<?php
$test = 'uploads/passport/passport_BG0078911_2021-04-07 070644.jpg~uploads/medical/testMedical_BG0078911_2021-04-07 070644.jpg~uploads/policeVerification/policeVerification_BG0078911_2021-04-07 070644.jpg';
$documentation = explode('~',$test);

$zipname = 'file.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($documentation as $file) {
  $zip->addFile($file);
}
// $zip->close();   
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);