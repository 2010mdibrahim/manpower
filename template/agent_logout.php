<?php
include ('../template/database.php');
unset($_SESSION['agent_email']);
echo "<script> window.location.href='../index.php?page=agent_login'</script>";