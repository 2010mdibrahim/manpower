<?php 

include("../database.php");
include("../class/ssp.class.php");

$table = 'agent';
$primaryKey = 'id';
$where = "";
$columns = array(
    array(
		'db' => 'agentPhoto',
		'dt' => 0,
		'formatter' => function( $d, $row ) {
			return '<a target="_blank" href="'.$d.'">
                        <img class="agent thumbnail" src="'.$d.'" alt="Forest">
                    </a>';
		}
	),
    array( 'db' => 'agentEmail',   'dt' => 1 ),
    array( 'db' => 'agentName',   'dt' => 2 ),
    array( 'db' => 'agentPhone',   'dt' => 3 ),
    array(
		'db' => 'id',
		'dt' => 4,
		'formatter' => function( $d, $row ) {global $conn;
            $agent = mysqli_fetch_assoc($conn->query("SELECT agentPassport, agentPoliceClearance from agent where id = ".$d));
			return '<a href="'.$agent['agentPassport'].'" target="_blank"><button class="btn btn-warning">Passport</button></a>
                    <a href="'.$agent['agentPoliceClearance'].'" target="_blank" ><button class="btn btn-info">Clearance</button></a>';
		}
	),
    array(
		'db' => 'agentEmail',
		'dt' => 5,
		'formatter' => function( $d, $row ) {global $conn;
            $agent = mysqli_fetch_assoc($conn->query("SELECT agentName, agentPoliceClearance from agent where agentEmail = '".$d."'"));
			return '<abbr title="Add Candidate Expense"><a href="?page=addExpenseAgent&ag='.base64_encode($d).'"><button class="btn btn-sm btn-info"><span class="fas fa-plus"></span></button></a></abbr>
                    <abbr title="Add Agent Expense"><a href="?page=addExpenseAgentPersonal&ag='.base64_encode($d).'"><button class="btn btn-sm btn-info"><i class="fas fa-user-plus"></i></button></a></abbr>
                    <abbr title="Agent Report"><button data-target="#showAgentReport" data-toggle="modal" class="btn btn-info btn-sm" value="'.$agent['agentName']."-".$d.'" onclick="showReport(this.value)"><span class="fas fa-eye"></span></button></abbr>
                    <abbr title="Agent Report"><a href="index.php?page=showAgentExpenseList&ag='.base64_encode($d).'"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button></a></abbr>';
		}
	),
    array(
		'db' => 'agentEmail',
		'dt' => 6,
		'formatter' => function( $d, $row ) {
			return '<div class="flex-container">
                        <div style="padding-right: 2%">
                            <button data-toggle="modal" data-target="#update_password_modal" type="button" class="btn btn-info btn-sm" onclick="update_password_agent_val(\''.$d.'\')">Password</button>
                        </div>
                        <div style="padding-right: 2%">
                            <form action="index.php" method="post">
                                <input type="hidden" name="alter" value="update">
                                <input type="hidden" value="editAgent" name="pagePost">
                                <input type="hidden" value="'.$d.'" name="agentEmail">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                            </form>
                        </div>
                        <div style="padding-left: 2%">
                            <form action="template/addNewAgentQry.php" method="post">
                                <input type="hidden" name="alter" value="delete">
                                <input type="hidden" value="editAgent" name="pagePost">
                                <input type="hidden" value="'.$d.'" name="agentEmail">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                            </form>
                        </div>
                    </div>';
		}
	)
);
$sql_details = array( 'user' => $user, 'pass' => $pass, 'db'   => $db, 'host' => $host );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns , $where , null)
);
?>