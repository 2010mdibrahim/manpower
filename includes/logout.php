<?php
include ('../template/database.php');
session_destroy();
// closing connection
mysqli_close($conn);
header("Location: ../index.php");
