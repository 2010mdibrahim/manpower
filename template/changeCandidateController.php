<?php
include ('database.php');
$today = date('Y-m-d');
$result_completed = $conn->query("UPDATE processing set pending = 2 where processing.pending = 1 AND processing.pendingTill < '$today'");
return $result_completed;