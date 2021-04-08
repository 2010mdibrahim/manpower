<?php
include ('class/homeInformations.class.php');
$test = new HomeInformation();
$result = $test->getCandidateExpenseMonthly();
print_r($result['candidateExpense']);