<?php 

include("../database.php");
include("../class/ssp.class.php");

$table = 'passport';
$primaryKey = 'id';
$where = "";
$columns = array(
    array( 'db' => 'creationDate', 'dt' => 0 ),
    array( 'db' => 'fName', 'dt' => 1 ),
    array( 'db' => 'lName', 'dt' => 2 ),
    array(
		'db' => 'agentEmail',
		'dt' => 3,
		'formatter' => function( $d, $row ) {global $conn;
            $agentInfo = mysqli_fetch_assoc($conn->query("SELECT agentName from agent where agentEmail = '".$d."'"));
			return '<p>'.$row[5].'</p>
                    <p><a href="?page=agentList&agE='.base64_encode($d).'">'.$agentInfo['agentName'].'</a></p>';
		}
	),
    array(
		'db' => 'gender',
		'dt' => 4,
		'formatter' => function( $d, $row ) {
			return '<a href="?page=cI&p='.base64_encode($row[5])."&cd=.".base64_encode($row[5])."&t=".time().'" target="_blank">'.$row[1]." ".$row[2].'</a>
                    <p>('.$d.')</p>';
		}
	),
    array( 'db' => 'passportNum', 'dt' => 5 ),
    array( 'db' => 'mobNum', 'dt' => 6 ),
    array(
		'db' => 'dob',
		'dt' => 7,
		'formatter' => function( $d, $row ) {
            $today = new Datetime(date('Y-m-d'));
            $bday = new Datetime($d);
            $age = $today->diff($bday);
			return $age->y;
		}
	),
    array( 'db' => 'issueDate', 'dt' => 8 ),
    array(
		'db' => 'validity',
		'dt' => 9,
		'formatter' => function( $d, $row ) {
            $expiryDate = new DateTime($row[8]); // will add validity to this date thats why it is expiry date
            $today = new DateTime(date('Y-m-d'));
            $format = "P".$d."Y";
            $expiryDate->add(new DateInterval($format));
            $validity = $expiryDate->diff($today);
            $noVal = true;
            $html = '';
            if($validity->y != 0){
                $html .= $validity->y.' Years; ';
                $noVal = false;
            }
            if($validity->m != 0){
                $html .= $validity->m.' Months; ';   
                $noVal = false;                     
            }
            if($validity->d != 0){
                $html .= $validity->d.' Days.';
                $noVal = false;
            }
            if($noVal){
                $html .= 'No Validity';
            }
			return $html;
		}
	),
    array( 'db' => 'arrivalDate', 'dt' => 10 ),
    array(
		'db' => 'departureDate',
		'dt' => 11,
		'formatter' => function( $d, $row ) {
            $arrivalDate = new DateTime($row[10]);
            $departureDate = new DateTime($d);
            $experience = $departureDate->diff($arrivalDate);
            $noExp = true;
            $html = '';
            if($experience->y != 0){
                $html .= $experience->y.' Years; ';
                $noExp = false;
            }
            if($experience->m != 0){
                $html .= $experience->m.' Months; ';
                $noExp = false;                        
            }
            if($experience->d != 0){
                $html .= $experience->d.' Days.';
                $noExp = false;
            }
            if($noExp){
                $html .= 'New';
            }
			return $html;
		}
	),
    array( 'db' => 'country', 'dt' => 12 ),
    array(
		'db' => 'jobId',
		'dt' => 13,
		'formatter' => function( $d, $row ) {global $conn;
            $job = mysqli_fetch_assoc($conn->query("SELECT jobType from jobs where jobId = '".$d."'"));
            $html = '<p style="font-size: 11px;">('.(!is_null($job['jobType'])) ? $job['jobType'] : 'Not Assigned'.')</p>';
			return '<p>'.$row[12].'</p>'.$html;
		}
	),
    array(
		'db' => 'jobId',
		'dt' => 14
	),
    array( 'db' => 'agentEmail', 'dt' => 15 ),
    array( 'db' => 'testMedical', 'dt' => 16 ),
    array( 'db' => 'testMedicalFile', 'dt' => 17 ),
    array(
		'db' => 'testMedicalStatus',
		'dt' => 18,
		'formatter' => function( $d, $row ) {global $conn;
            $job = mysqli_fetch_assoc($conn->query("SELECT creditType from jobs where jobId = '".$row[14]."'"));
            $html = '<div class="row justify-content-center">';             
            if(empty($row[16]) || $row[16]=='no'){
                $html .= '  <div class="btn_custom">
                                <button class="btn btn-secondary btn-sm" value="'.$row[5].'_'.$row[0].'" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)">No</button>
                            </div>';                           
            } else { 
                $html .=   '<div class="btn_custom">
                                <button class="btn btn-danger btn-sm" value="'.$row[5]."_".$row[0].'" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)"><span class="fas fa-redo"></span></button>
                            </div>
                            <div class="btn_custom">
                                <a href="'.$row[17]."?t=".time().'" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                            </div>
                            <div class="btn_custom">';
                    if($d == 'fit'){
                        $html .=    '<form action="template/medicalFittness.php" method="post">
                                        <input type="hidden" name="medical" value="testMedicalStatus">
                                        <input type="hidden" name="passportNum" value="'.$row[5].'">
                                        <input type="hidden" name="creationDate" value="'.$row[0].'">
                                        <input type="hidden" name="medicalStatus" value="'.$d.'">
                                        <button class="btn btn-primary btn-sm"><span class="fa fa-check"></span></button>
                                    </form>';
                    }else{
                        $html .=    '<form action="template/medicalFittness.php" method="post">
                                        <input type="hidden" name="medical" value="testMedicalStatus">
                                        <input type="hidden" name="passportNum" value="'.$row[5].'">
                                        <input type="hidden" name="creationDate" value="'.$row[0].'">
                                        <input type="hidden" name="medicalStatus" value="'.$d.'">
                                        <button class="btn btn-warning btn-sm"><span class="fa fa-minus-circle"></span></button>
                                    </form>';
                    }
                    $html .= '</div>';
            }
            if($job['creditType'] != 'Paid'){
                $html .=    '<div class="btn_custom">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="redir" value="listCandidate">
                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                    <input type="hidden" name="purpose" value="Test Medical">
                                    <input type="hidden" name="candidateName" value="'.$row[1]." ".$row[2].'">
                                    <input type="hidden" name="passport_info" value="'.$row[5]."_".$row[0].'">
                                    <input type="hidden" name="agentEmail" value="'.$row[15].'">
                                    <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                </form>
                            </div>';
            }
            $html .= '</div>';
			return $html;
		}
	),
    array( 'db' => 'finalMedical', 'dt' => 19 ),
    array( 'db' => 'finalMedicalFile', 'dt' => 20 ),
    array( 'db' => 'notification', 'dt' => 21 ),
    array( 'db' => 'finalMedicalReport', 'dt' => 22 ),
    array(
		'db' => 'finalMedicalStatus',
		'dt' => 23,
		'formatter' => function( $d, $row ) {global $conn;
            $job = mysqli_fetch_assoc($conn->query("SELECT creditType from jobs where jobId = '".$row[14]."'"));
            $html = '';
            if(empty($row[16]) || $row[16]=='no'){
                $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
            }else{
                $html .= '<div class="row justify-content-center" style="padding-bottom: 5%;">';
                if(empty($row[19]) || $row[19]=='no'){                                
                    $html .=    '<div class="btn_custom">
                                    <button class="btn btn-secondary btn-sm" value="'.$row[5]."_".$row[0].'" name="finalMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile" onclick="finalMedical(this.value)">No</button>
                                </div>';
                } else {                            
                    $html .=    '<div class="btn_custom">
                                    <button class="btn btn-danger btn-sm" value="'.$row[5]."_".$row[0]."_".$row[22].'" name="finalMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile" onclick="finalMedical(this.value)"><span class="fas fa-redo"></span></button>
                                </div>
                                <div class="btn_custom"> 
                                    <a href="'.$row[20]."?t=".time().'" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                </div>
                    <div class="btn_custom">';
                        if($d == 'fit'){
                            $html .=    '<form action="template/medicalFittness.php" method="post">
                                            <input type="hidden" name="medical" value="finalMedicalStatus">
                                            <input type="hidden" name="passportNum" value="'.$row[5].'">
                                            <input type="hidden" name="creationDate" value="'.$row[0].'">
                                            <input type="hidden" name="medicalStatus" value="'.$d.'">
                                            <button class="btn btn-primary btn-sm"><span class="fa fa-check"></span></button>
                                        </form>';
                        }else{
                            $html .=    '<form action="template/medicalFittness.php" method="post">
                                            <input type="hidden" name="medical" value="finalMedicalStatus">
                                            <input type="hidden" name="passportNum" value="'.$row[5].'">
                                            <input type="hidden" name="creationDate" value="'.$row[0].'">
                                            <input type="hidden" name="medicalStatus" value="'.$d.'">
                                            <button class="btn btn-warning btn-sm"><span class="fa fa-minus-circle"></span></button>
                                        </form>';
                        }
                    $html .= '</div>';
                }
                if($job['creditType'] != 'Paid'){
                    $html .=    '<div class="btn_custom">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="redir" value="listCandidate">
                                        <input type="hidden" name="pagePost" value="addCandidatePayment">
                                        <input type="hidden" name="purpose" value="Final Medical">
                                        <input type="hidden" name="candidateName" value="'.$row[1]." ".$row[2].'">
                                        <input type="hidden" name="passport_info" value="'.$row[5]."_".$row[0].'">
                                        <input type="hidden" name="agentEmail" value="'.$row[15].'">
                                        <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                    </form>
                                </div>';
                }
                $html .= '<div class="btn_custom">';
                        if($row[21] == 'yes'){
                            $html .= '<abbr title="Stop Notification"><button class="btn btn-sm btn-info" value="'.$row[5]."_".$row[0].'" onclick="stopNotification(this.value)"><i class="far fa-bell-slash"></i></button></abbr>';
                        }else{
                            $html .= '<abbr title="No Notification for this candidate"><button class="btn btn-sm btn-danger"><i class="far fa-bell-slash"></i></button></abbr>';
                        }
                $html .=    '</div>
                        </div>
                <div class="btn_custom">';
                    if($row[19] == 'yes') {
                        $html .= '<button class="btn btn-info btn-sm">'.$row[22].'</button>';
                    }
                $html .= '</div>';
            }
            $html .= '</div>';
			return $html;
		}
	),
    array( 'db' => 'policeClearance', 'dt' => 24 ),
    array(
		'db' => 'policeClearanceFile',
		'dt' => 25,
		'formatter' => function( $d, $row ) {global $conn;
            $job = mysqli_fetch_assoc($conn->query("SELECT creditType from jobs where jobId = '".$row[14]."'"));
            $html = '<div class="row">';                            
                if($row[24] == 'yes'){
                    $html .=    '<div class="col-sm-3">
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#policeClearanceFileSubmit" id="policeClearancePassport" value="'.$row[5]."_".$row[0].'" onclick="policeClearance(this.value)"><span class="fas fa-redo"></span></button>
                                </div>
                                <div class="col-sm-3"> 
                                    <a href="'.$d."?t=".time().'" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                </div>';
                }else{
                    $html .=    '<div class="col-sm-3">
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#policeClearanceFileSubmit" id="policeClearancePassport" value="'.$row[5]."_".$row[0].'" onclick="policeClearance(this.value)">No</button>                            
                                </div>';
                }
                if($job['creditType'] != 'Paid'){
                    $html .=    '<div class="col-sm-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="redir" value="listCandidate">
                                        <input type="hidden" name="pagePost" value="addCandidatePayment">
                                        <input type="hidden" name="purpose" value="Police Clearance">
                                        <input type="hidden" name="candidateName" value="'.$row[1]." ".$row[2].'">
                                        <input type="hidden" name="passport_info" value="'.$row[5]."_".$row[0].'">
                                        <input type="hidden" name="agentEmail" value="'.$row[15].'">
                                        <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                    </form>
                                </div>';
                }
            $html .=    '</div>';
			return $html;
		}
	),
    array( 'db' => 'experienceStatus',   'dt' => 26 ),
    array( 'db' => 'trainingCard',   'dt' => 27 ),
    array( 'db' => 'trainingCardFile',   'dt' => 28 ),
    array(
		'db' => 'policeClearanceFile',
		'dt' => 29,
		'formatter' => function( $d, $row ) {global $conn;
            $job = mysqli_fetch_assoc($conn->query("SELECT creditType from jobs where jobId = '".$row[14]."'"));
            $html = '<div class="row">';
            if($row[26] == 'new'){
                if($row[27] == 'yes'){
                    $html .=    '<div class="col-sm-3">
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#trainingCardFileSubmit" id="trainingPassport" value="'.$row[5].'" onclick="trainingCard(this.value)"><span class="fas fa-redo"></span></button>
                                </div>
                                <div class="col-sm-3"> 
                                    <a href="'.$row[28].'" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                </div>';
                    }else{
                    $html .=    '<div class="col-sm-3"> 
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#trainingCardFileSubmit" id="trainingPassport" value="'.$row[5].'" onclick="trainingCard(this.value)">No</button>
                                </div>';
                    }
                if($job['creditType'] != 'Paid'){
                    $html .=    '<div class="col-sm-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="redir" value="listCandidate">
                                        <input type="hidden" name="pagePost" value="addCandidatePayment">
                                        <input type="hidden" name="purpose" value="Training Card">
                                        <input type="hidden" name="candidateName" value="'.$row[1]." ".$row[2].'">
                                        <input type="hidden" name="passport_info" value="'.$row[5]."_".$row[0].'">
                                        <input type="hidden" name="agentEmail" value="'.$row[15].'">
                                        <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                    </form>
                                </div>';
                }                     
            }else{
            $html .=    '<div class="col-sm">
                            <a href="?page=cI&p='.base64_encode($row[5])."&cd=.".base64_encode($row[0])."&t=".time().'"><p class="text-center">Experienced</p></a>
                        </div>';
            }
            $html .= '</div>';
			return $html;
		}
	),
    array( 'db' => 'status',   'dt' => 30 ),
    array( 'db' => 'disableReason',   'dt' => 31 ),
    array(
		'db' => 'status',
		'dt' => 32,
		'formatter' => function( $d, $row ) {
            $html = '<div class="container">
                        <div class="row">
                            <div class="ml-1 mt-1">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="'.$row[5].'" name="passportNum">
                                    <input type="hidden" value="'.$row[0].'" name="creationDate">
                                    <abbr title="Edit Candidate"><button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></></button></abbr>
                                </form>
                            </div>
                            <div class="ml-1 mt-1">
                                <form action="template/editCandidateQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="'.$row[5].'" name="passportNum">
                                    <input type="hidden" value="'.$row[0].'" name="creationDate">
                                    <abbr title="Delete Candidate"><button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button></abbr>
                                </form>                                    
                            </div>
                            <div class="ml-1 mt-1">
                                <abbr title="Show Expenseces of Candidate"><a href="?page=ce'."&pn=".base64_encode($row[5])."&cd=".base64_encode($row[0]).'" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a></abbr>
                            </div>
                            <div class="ml-1 mt-1">
                                <abbr title="See Candidate Info"><a href="?page=candidateInfo&passportNum='.$row[5].'&creationDate='.$row[0].'" target="_blank"><button class="btn btn-sm btn-warning" type="button" id="add_visa" ><span class="fa fa-eye" aria-hidden="true"></span></button></a></abbr>
                            </div>
                            
                            <div class="ml-1 mt-1">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="redir" value="listCandidate">
                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                    <input type="hidden" name="purpose" value="">
                                    <input type="hidden" name="notAdvance" value="notAdvance">
                                    <input type="hidden" name="candidateName" value="'.$row[1]." ".$row[2].'">
                                    <input type="hidden" name="passport_info" value="'.$row[5]."_".$row[0].'">
                                    <input type="hidden" name="agentEmail" value="'.$row[15].'">
                                    <abbr title="Extra Expense"><button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button></abbr>
                                </form>
                            </div>
                            <div class="ml-1 mt-1">';
                            if($row[30] != 2){
                                $html .= '<abbr title="Disable candidate"><button data-target="#disableCandidate" data-toggle="modal" class="btn btn-sm btn-danger" type="button" value="'.$row[5]."_".$row[0].'" onclick="getDisableValue(this.value)"><i class="fas fa-ban"></i></button></abbr>';
                            }else{
                                $html .= '<abbr title="Show Disable Reason"><button data-target="#disableCandidateReason" data-toggle="modal" class="btn btn-sm btn-success" type="button" value="'.$row[5]."_".$row[0]."_".$row[31].'" onclick="showDisableValue(this.value)"><i class="fas fa-ban"></i></button></abbr>';
                            }
            $html .=        '</div>
                        </div>
                    </div>';
			return $html;
		}
	),
    array( 'db' => 'testMedicalStatus', 'dt' => 33 ),
    array( 'db' => 'finalMedicalStatus', 'dt' => 34 ),
    array(
		'db' => 'status',
		'dt' => 35,
		'formatter' => function( $d, $row ) {global $conn;
            $hasVisa = mysqli_fetch_assoc($conn->query("SELECT processingId, pending from processing where passportNum = '".$row[5]."' AND passportCreationDate = '".$row[0]."'"));
            $hasTicket = mysqli_fetch_assoc($conn->query("SELECT ticketId from ticket where passportNum = '".$row[5]."' AND passportCreationDate = '".$row[0]."'"));
            if(is_null($hasVisa)){
                return 'null';
            }else{
                if($hasVisa['pending'] == 3){
                    return 'pending_3';
                }else if(!is_null($hasTicket)){
                    return 'yes_ticket';
                }else{
                    return 'no_ticket';
                }
            }
            
		}
	)
);
$sql_details = array( 'user' => $user, 'pass' => $pass, 'db'   => $db, 'host' => $host );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns , $where , null)
);
?>