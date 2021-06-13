<?php 

include("../database.php");
include("../class/ssp.class.php");

$table = 'notifications';
$primaryKey = 'id';
$where = "";
$columns = array(
    array( 'db' => 'notification',   'dt' => 0 ),
    array(
		'db' => 'passport_id',
		'dt' => 1,
		'formatter' => function( $d, $row ) {global $conn;
            $name = mysqli_fetch_assoc($conn->query("SELECT fName, lName from passport where id = ".$d));
			return $name['fName'].' '.$name['lName'];
		}
	),
    array( 'db' => 'notification_date',    'dt' => 2 )
);
$sql_details = array( 'user' => $user, 'pass' => $pass, 'db'   => $db, 'host' => $host );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns , $where , null)
);
?>