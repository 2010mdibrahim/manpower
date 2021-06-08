<?php 
$file = $_SERVER['DOCUMENT_ROOT'].'/datatables/pdo.php';
if ( is_file( $file ) ) {
	include( $file );
}
include ('../class/ssp.class.php'); 
include ('../template/database.php'); 

$table = 'passport';
$primaryKey = 'passportNum';
$where = "";
$columns = array(
    array(
        'db' => 'id',
        'dt' => 0,
        'formatter' => function( $d, $row ) { global $conn;
            $result = mysqli_fetch_assoc($conn->query("SELECT passport.creationDate, agent.  "));
			$methods = explode(",",$d);
            $methods_html = '';
			foreach($methods as $idx => $method){
                if($idx == 0){
                    $methods_html .= $method;
                }else if($method != ''){
                    $methods_html .= ' | '.$method;
                }
            }
			return $methods_html;
        }
    ),
	array('db' => 'total_amount','dt' => 1 ),
	array('db' => 'payed_amount','dt' => 2 ),
    array(
        'db'        => 'payment_method',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
			$methods = explode(",",$d);
            $methods_html = '';
			foreach($methods as $idx => $method){
                if($idx == 0){
                    $methods_html .= $method;
                }else if($method != ''){
                    $methods_html .= ' | '.$method;
                }
            }
			return $methods_html;
        }
    ),
    array('db' => 'purses_date','dt' => 4 ),
	array(
        'db'        => 'purses_code',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {global $mysqli;
            $total_amount = mysqli_fetch_assoc($mysqli->query("SELECT total_amount from ipo_purses_information where purses_code = '$d'"));
            if($total_amount['total_amount'] == 0){
                return 'Transferred';
            }else{
                return '
                    <abbr title="Show agreements"><button type="button" data-toggle="modal" data-target="#show_aggrements" class="btn btn-xs btn-info" onclick="get_aggrement(\''.$d.'\')"><i class="fas fa-eye"></i></button></abbr>
                ';
            }
			
        }
    )
);

$sql_details = array( 'user' => $user, 'pass' => $pass, 'db'   => $db, 'host' => $host );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns , $where , null)
);
?>