<?php
include ('class/changeCandidateStatus.class.php');
print_r('ok');
$test = new changeCandidateStatus();
$test->change();
echo 'this';