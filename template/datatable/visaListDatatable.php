<?php 

include("../database.php");
include("../class/ssp.class.php");

$table = '(SELECT 
                a.processingId,
                a.passportNum,
                a.passportCreationDate,
                a.sponsorVisa,
                a.empRqst,
                a.foreignMole,
                a.okala,
                a.okalaFile,
                a.mufa,
                a.mufaFile,
                a.medicalUpdate,
                a.visaStamping,
                a.notification,
                a.visaStampingDate,
                a.finger,
                a.manpowerCard,
                a.manpowerCardFile,
                a.pending,
                a.youtube,
                b.fName,
                b.lName
            FROM processing a
            INNER JOIN passport b ON a.passportNum = b.passportNum AND a.passportCreationDate = b.creationDate               
        ) temp';
$primaryKey = 'processingId';
$where = "";
$columns = array(
    array( 'db' => 'processingId',   'dt' => 0 ),
    array( 'db' => 'passportNum',   'dt' => 1 ),
    array( 'db' => 'passportCreationDate',   'dt' => 2 ),
    array( 'db' => 'fName',   'dt' => 3 ),
    array(
		'db' => 'lName',
		'dt' => 4,
		'formatter' => function( $d, $row ) {global $conn;
            $agent = mysqli_fetch_assoc($conn->query("SELECT agent.agentName, passport.agentEmail from passport INNER JOIN agent using (agentEmail) where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
			return '<p>'.$row[3].' '.$d.'</p>'.'<p><a href="?page=agentList&agE='.base64_encode($agent['agentEmail']).'">'.$agent['agentName'].'</a></p>';
		}
	),
    array(
		'db' => 'passportNum',
		'dt' => 5,
		'formatter' => function( $d, $row ) {
			return '<a href="?page=listCandidate&pp='.base64_encode($d).'&cd='.base64_encode($row[2]).'">'.$d.'</a>';
		}
	),
    array( 'db' => 'sponsorVisa',   'dt' => 6 ),
    array(
		'db' => 'sponsorVisa',
		'dt' => 7,
		'formatter' => function( $d, $row ) {
			return '<a href="?page=allVisaList&sv='.base64_encode($d).'">'.$d.'</a>';
		}
	),
    array(
		'db' => 'processingId',
		'dt' => 8,
		'formatter' => function( $d, $row ) {global $conn;
            $row_database = mysqli_fetch_assoc($conn->query("SELECT sponsor.sponsorName from processing INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID where passportNum  = '".$row[1]."' AND passportCreationDate = '".$row[2]."'"));
			return $row_database['sponsorName'];
		}
	),
    array(
		'db' => 'processingId',
		'dt' => 9,
		'formatter' => function( $d, $row ) {global $conn;
            $row_database = mysqli_fetch_assoc($conn->query("SELECT sponsorvisalist.sponsorNID from processing INNER JOIN sponsorvisalist USING (sponsorVisa) where passportNum  = '".$row[1]."' AND passportCreationDate = '".$row[2]."'"));
			return '<p>'.$row_database['sponsorNID'].'</p><p><a href="?page=sponsorList&spN='.base64_encode($row_database['sponsorNID']).'"></a></p>';
		}
	),
    array(
		'db' => 'processingId',
		'dt' => 10,
		'formatter' => function( $d, $row ) {global $conn;
            $country = mysqli_fetch_assoc($conn->query("SELECT country from passport where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
			return $country['country'];
		}
	),
    array( 'db' => 'empRqst',   'dt' => 11 ),
    array(
		'db' => 'processingId',
		'dt' => 12,
		'formatter' => function( $d, $row ) {global $conn;
            $country = mysqli_fetch_assoc($conn->query("SELECT country from passport where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(strtolower($country['country']) == 'saudi arabia'){
                if(empty($row[11]) || $row[11]=='no'){
                    $html .=    '<form action="template/visaProcessing.php" method="post">
                                    <input type="hidden" name="passportNum" value="'.$row[1].'">
                                    <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                    <input type="hidden" name="mode" value="empRqstMode">
                                    <button class="btn btn-secondary btn-sm" value="yes" name="empRqst">No</button>
                                </form>';
                } else {
                    $html .=    '<form action="template/visaProcessing.php" method="post">
                                    <input type="hidden" name="passportNum" value="'.$row[1].'">
                                    <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                    <input type="hidden" name="mode" value="empRqstMode">
                                    <button class="btn btn-primary btn-sm" value="no" name="empRqst">Done</button>
                                </form>';
                } 
            }else{
                $html .= " - ";
            }
			return $html;
		}
	),
    array( 'db' => 'foreignMole',   'dt' => 13 ),
    array(
		'db' => 'foreignMole',
		'dt' => 14,
		'formatter' => function( $d, $row ) {global $conn;
            $country = mysqli_fetch_assoc($conn->query("SELECT country from passport where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(strtolower($country['country']) == 'saudi arabia'){
                if(empty($row[11]) || $row[11]=='no'){
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else if(empty($row[13]) || $row[13] =='no'){
                    $html .=    '<form action="template/visaProcessing.php" method="post">
                                    <input type="hidden" name="passportNum" value="'.$row[1].'">
                                    <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                    <input type="hidden" name="mode" value="foreignMoleMode">
                                    <button class="btn btn-secondary btn-sm" value="yes" name="foreignMole">No</button>
                                </form>';
                } else {
                    $html .=    '<form action="template/visaProcessing.php" method="post">
                                    <input type="hidden" name="passportNum" value="'.$row[1].'">
                                    <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                    <input type="hidden" name="mode" value="foreignMoleMode">
                                    <button class="btn btn-primary btn-sm" value="no" name="foreignMole">Done</button>
                                </form>';
                } 
            }else{
                $html .= " - ";
            }
			return $html;
		}
	),
    array( 'db' => 'okala',   'dt' => 15 ),
    array( 'db' => 'okala',   'dt' => 16 ),
    array(
		'db' => 'processingId',
		'dt' => 17,
		'formatter' => function( $d, $row ) {global $conn;
            $row_database = mysqli_fetch_assoc($conn->query("SELECT agentEmail from passport INNER JOIN agent using (agentEmail) where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
			return $row_database['agentEmail'];
		}
	),
    array(
		'db' => 'okalaFile',
		'dt' => 18,
		'formatter' => function( $d, $row ) {
            global $conn;
            $row_database = mysqli_fetch_assoc($conn->query("SELECT passport.agentEmail, jobs.creditType, passport.country from passport INNER JOIN jobs using (jobId) where passportNum = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(strtolower($row_database['country']) == 'saudi arabia'){                          
                if(empty($row[13]) || $row[13] =='no'){ 
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else{
                    $html .= '<div class="row">';
                    if(empty($row[15]) || $row[15] =='no'){ 
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm" type="button" value="'.$row[0].'" name="okala" data-toggle="modal" data-target="#okalaFileSubmit" onclick="okalaFileSubmit(this.value)">No</button>
                                    </div>';
                    } else {                                 
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm" type="button" value="'.$row[0].'" name="okala" data-toggle="modal" data-target="#okalaFileSubmit" onclick="okalaFileSubmit(this.value)"><span class="fas fa-redo"></span></button>                                    
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="'.$d.'" target="_blank"><button class="btn btn-info btn-sm" type="button"><span class="fas fa-search"></span></button></a>
                                    </div>';
                    } 
                    if($row_database['creditType'] != 'Paid'){ 
                        $html .=    '<div class="col-sm-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="Okala">
                                            <input type="hidden" name="candidateName" value="'.$row[3].'">
                                            <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                            <input type="hidden" name="agentEmail" value="'.$row_database['agentEmail'].'">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>';
                    } 
                    $html .= '</div>';
                } 
            }else{
                $html .= " - ";
            } 
			return $html;
		}
	),
    array( 'db' => 'mufa',   'dt' => 19 ),
    array(
		'db' => 'mufaFile',
		'dt' => 20,
		'formatter' => function( $d, $row ) {global $conn;
            $row_database = mysqli_fetch_assoc($conn->query("SELECT passport.agentEmail, jobs.creditType, passport.country from passport INNER JOIN jobs using (jobId) where passportNum = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(strtolower($row_database['country']) == 'saudi arabia'){
                if(empty($row[15]) || $row[15]=='no'){
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else{
                    $html .= '<div class="row">';
                    if(empty($row[19]) || $row[19] =='no'){
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm" value="'.$row[0].'" name="mufa" data-toggle="modal" data-target="#mufaFileSubmit" onclick="mufaFileSubmit(this.value)">No</button>
                                    </div>';
                    } else {                                    
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm" value="'.$row[0].'" name="mufa" data-toggle="modal" data-target="#mufaFileSubmit" onclick="mufaFileSubmit(this.value)"><span class="fas fa-redo"></span></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="'.$d.'" target="_blank"><button class="btn btn-info btn-sm" type="button"><span class="fas fa-search"></span></button></a>
                                    </div>';
                    }
                    if($row_database['creditType'] != 'Paid'){
                        $html .=    '<div class="col-sm-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="MUFA">
                                            <input type="hidden" name="candidateName" value="'.$row[3].'">
                                            <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                            <input type="hidden" name="agentEmail" value="'.$row_database['agentEmail'].'">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>';
                    }
                    $html .= '</div>';
                } 
            }else{
                $html .= " - ";
            }
			return $html;
		}
	),
    array( 'db' => 'medicalUpdate',   'dt' => 21 ),
    array(
		'db' => 'medicalUpdate',
		'dt' => 22,
		'formatter' => function( $d, $row ) {global $conn;
            $country = mysqli_fetch_assoc($conn->query("SELECT country from passport where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(strtolower($country['country']) == 'saudi arabia'){
                if(empty($row[19]) || $row[19]=='no'){
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else if(empty($row[21]) || $row[21] == 'no'){
                    $html .=    '<form action="template/visaProcessing.php" method="post">
                                    <input type="hidden" name="passportNum" value="'.$row[1].'">
                                    <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                    <input type="hidden" name="mode" value="updateMedicalMode">
                                    <button class="btn btn-secondary btn-sm" value="yes" name="updateMedical">No</button>
                                </form>';
                } else {
                    $html .=    '<form action="template/visaProcessing.php" method="post">
                                    <input type="hidden" name="passportNum" value="'.$row[1].'">
                                    <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                    <input type="hidden" name="mode" value="updateMedicalMode">
                                    <button class="btn btn-primary btn-sm" value="no" name="updateMedical">Done</button>
                                </form>';
                } 
            }else{
                $html .=  " - ";
            }
			return $html;
		}
	),
    array( 'db' => 'visaStamping',   'dt' => 23 ),
    array( 'db' => 'notification',   'dt' => 24 ),
    array(
		'db' => 'visaStampingDate',
		'dt' => 25,
		'formatter' => function( $d, $row ) {global $conn;
            $country = mysqli_fetch_assoc($conn->query("SELECT country from passport where passportNum  = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(strtolower($country['country']) == 'saudi arabia'){
                if(empty($row[21]) || $row[21] == 'no'){
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else if(empty($row[23]) || $row[23]=='no'){
                    $html .= '<button class="btn btn-secondary btn-sm" data-target="#visaStampingDiv" data-toggle="modal" id="stampingButton" value="'.$row[0].'" onclick="visaStamping(this.value)">Enter VISA</button>';
                } else {
                    $html .=    '<div class="row">  
                                    <div class="col-md-3">
                                        <a href="?page=svf&p='.base64_encode($row[0]).'" target="_blank"><button class="btn btn-sm btn-info">'.$d.'</button></a>
                                    </div>                              
                                </div>
                                <div class="row">
                                    
                                </div>';
                }
            }else{
                if(empty($row[23]) || $row[23]=='no'){
                    $html .= '<button class="btn btn-secondary btn-sm" data-target="#visaStampingDiv" data-toggle="modal" id="stampingButton" value="'.$row[0].'" onclick="visaStamping(this.value)">Enter VISA</button>';
                } else {                            
                    $html .=    '<div class="row">  
                                    <div class="col-md-3">
                                        <a href="?page=svf&p='.base64_encode($row[0]).'" target="_blank"><button class="btn btn-sm btn-info">'.$d.'</button></a>
                                    </div>                              
                                </div>';
                }
            }
            if($row[24] == 'yes'){
                $html .= '<abbr title="Stop Notification"><button class="btn btn-sm btn-warning" value="'.$row[0].'" onclick="stopNotification(this.value)"><i class="far fa-bell-slash"></i></button></abbr>';
            }else{
                $html .= '<abbr title="No Notification for this candidate"><button class="btn btn-sm btn-danger"><i class="far fa-bell-slash"></i></button></abbr>';
            }
			return $html;
		}
	),
    array( 'db' => 'finger',   'dt' => 26 ),
    array(
		'db' => 'finger',
		'dt' => 27,
		'formatter' => function( $d, $row ) {global $conn;
            $row_database = mysqli_fetch_assoc($conn->query("SELECT passport.agentEmail, jobs.creditType from passport INNER JOIN jobs using (jobId) where passportNum = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            $html = '';
            if(empty($row[23]) || $row[23]=='no'){
                $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
            }else{
                $html .= '<div class="row">';
                if(empty($row[26]) || $row[26]=='no'){
                    $html .=    '<div class="col-md-4">
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="'.$row[1].'">
                                        <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                        <input type="hidden" name="mode" value="fingerMode">
                                        <button class="btn btn-secondary btn-sm" value="yes" name="finger">No</button>
                                    </form>
                                </div>';
                } else {
                    $html .=    '<div class="col-md-6">
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="'.$row[1].'">
                                        <input type="hidden" name="sponsorVisa" value="'.$row[6].'">
                                        <input type="hidden" name="mode" value="fingerMode">
                                        <button class="btn btn-primary btn-sm" value="no" name="finger">Done</button>
                                    </form>
                                </div>';
                }
                if($row_database['creditType'] != 'Paid'){
                    $html .=    '<div class="col-md-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="pagePost" value="addCandidatePayment">
                                        <input type="hidden" name="purpose" value="Finger">
                                        <input type="hidden" name="candidateName" value="'.$row[4].'">
                                        <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                        <input type="hidden" name="agentEmail" value="'.$row_database['agentEmail'].'">
                                        <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                    </form>
                                </div>';
                }
                $html .= '</div>';
            }
			return $html;
		}
	),
    array(
		'db' => 'finger',
		'dt' => 28,
		'formatter' => function( $d, $row ) {global $conn;
            $html = '';
            $trainingCard = mysqli_fetch_assoc($conn->query("SELECT trainingCard, trainingCardFile, departureSeal from passport where passportNum = '".$row[1]."' AND creationDate = '".$row[2]."'"));
            $row_database = mysqli_fetch_assoc($conn->query("SELECT passport.agentEmail, jobs.creditType from passport INNER JOIN jobs using (jobId) where passportNum = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            if( $trainingCard['departureSeal'] == 'yes'){
                $html .= '<a href="?page=cI&p='.base64_encode($row[1])."&cd=.".base64_encode($row[2])."&t=".time().'"><p class="text-center">Experienced</p></a>';
            }else{
                if(empty($row[26]) || $row[26] == 'no'){
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else{
                    $html .= '<div class="row">';
                    if(empty($trainingCard['trainingCard']) || $trainingCard['trainingCard'] == 'no'){
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm" value="'.$row[1]."-".$row[6].'" id="enterCard" data-target="#trainingCardFileSubmit" data-toggle="modal" onclick="trainingCard(this.value)">No</button>                                
                                    </div>';
                    }else{
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm" value="'.$row[1]."-".$row[6].'" id="enterCard" data-target="#trainingCardFileSubmit" data-toggle="modal" onclick="trainingCard(this.value)"><span class="fas fa-redo"></span></button>
                                    </div>
                                    <div class="col-sm-3">                                                     
                                        <a href="'.$trainingCard['trainingCardFile'].'" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                    </div>';
                    }
                    if($row_database['creditType'] != 'Paid'){
                        $html .=    '<div class="col-sm-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="Training Card">
                                            <input type="hidden" name="candidateName" value="'.$row[3].'">
                                            <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                            <input type="hidden" name="agentEmail" value="'.$row_database['agentEmail'].'">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>';
                    }
                    $html .= '</div>';
                }
            }
			return $html;
		}
	),
    array( 'db' => 'manpowerCard',   'dt' => 29 ),
    array(
		'db' => 'manpowerCardFile',
		'dt' => 30,
		'formatter' => function( $d, $row ) {global $conn;
            $html = '';
            $trainingCard = mysqli_fetch_assoc($conn->query("SELECT trainingCard, departureSeal from passport where passportNum = '".$row[1]."' AND creationDate = '".$row[2]."'"));
            $row_database = mysqli_fetch_assoc($conn->query("SELECT passport.agentEmail, jobs.creditType from passport INNER JOIN jobs using (jobId) where passportNum = '".$row[1]."' AND passport.creationDate = '".$row[2]."'"));
            if($trainingCard['departureSeal'] != 'yes'){
                if(empty($trainingCard['trainingCard']) || $trainingCard['trainingCard'] == 'no' || empty($row[26]) || $row[26] == 'no'){
                    $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
                }else{
                    $html .= '<div class="row">';
                    if(empty($row[29]) || $row[29] == 'no'){
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm" value="'.$row[0].'" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)">No</button>
                                    </div>';
                    }else{
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm" value="'.$row[0].'" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)"><span class="fas fa-redo"></span></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="'.$d.'" target="_blank"><button class="btn btn-sm btn-info"><span class="fas fa-search"></span></button></a>
                                    </div>';
                    }
                    if($row_database['creditType'] != 'Paid'){
                        $html .=    '<div class="col-sm-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="Manpower">
                                            <input type="hidden" name="candidateName" value="'.$row[3].'">
                                            <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                            <input type="hidden" name="agentEmail" value="'.$row_database['agentEmail'].'">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>';
                    }
                    $html .=    '</div>';
                }
            }else{
                $html .= '<div class="row">';
                    if(empty($row[29]) || $row[29] == 'no'){
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm" value="'.$row[0].'" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)">No</button>
                                    </div>';
                    }else{
                        $html .=    '<div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm" value="'.$row[0].'" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)"><span class="fas fa-redo"></span></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="'.$d.'" target="_blank"><button class="btn btn-sm btn-info"><span class="fas fa-search"></span></button></a>
                                    </div>';
                    }
                    if($row_database['creditType'] != 'Paid'){
                        $html .=    '<div class="col-sm-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="Manpower">
                                            <input type="hidden" name="candidateName" value="'.$row[3].'">
                                            <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                            <input type="hidden" name="agentEmail" value="'.$row_database['agentEmail'].'">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>';
                    }
                    $html .= '</div>';
            }
			return $html;
		}
	),
    array( 'db' => 'pending',   'dt' => 31 ),
    array(
		'db' => 'manpowerCardFile',
		'dt' => 32,
		'formatter' => function( $d, $row ) {global $conn;
            $html = '';
            $ticket = mysqli_fetch_assoc($conn->query("SELECT ticketId, flightDate, count(ticketId) as existTicket from ticket where passportNum = '".$row[1]."' AND passportCreationDate = '".$row[2]."'"));
            $ticketId = '';
            if(empty($row[29]) || $row[29] == 'no'){
                $html .= '<button class="btn btn-warning btn-sm">Do Previous</button>';
            }else if($ticket['existTicket'] == 0){
                $html .= '<a href="?page=newTicket&p='.base64_encode($row[1]).'&cd='.base64_encode($row[2]).'"><button class="btn btn-secondary btn-sm">No Ticket</button></a>';
            } else { 
                $ticketId = base64_encode($ticket['ticketId']);
                $html .= '<input type="hidden" name="pagePost" value="ticketInfo">';
                $html .= '<a href="?page=tN&tI='.$ticketId.'" target="_blank"><button class="btn btn-info btn-sm">'.$ticket['flightDate'].'</button></a>';
                if($row[31] == 0){
                    $html .=    '<button type="button" class="btn btn-sm btn-secondary" onclick="pending_list(\''.$row[1].'\', \''.$row[2].'\')"><i class="fas fa-plane"></i></button>';
                }else{
                    $html .= '<button type="button" class="btn btn-sm btn-success mt-1"><i class="fas fa-plane"></i></button>';
                }
            }
			return $html;
        }
	),
    array(
		'db' => 'youtube',
		'dt' => 33,
		'formatter' => function( $d, $row ) {global $conn;
            $passport = mysqli_fetch_assoc($conn->query("SELECT agentEmail, passport.disableReason, passport.status, delegateComission from passport where passportNum = '".$row[1]."' AND creationDate = '".$row[2]."'"));
            $visa = mysqli_fetch_assoc($conn->query("SELECT sponsorvisalist.visaGenderType, sponsorvisalist.visaAmount from processing INNER JOIN sponsorvisalist USING (sponsorVisa) where passportNum = '".$row[1]."' AND passportCreationDate = '".$row[2]."'"));
            $html = '';
            $html .= '<div class="row">';
            if($d == ''){
                $html .= '<abbr title="Add YouTube Link"><button data-toggle="modal" data-target="#youtube" class="btn btn-sm btn-warning ml-1 mt-1" value="'.$row[0].'" onclick="youtubeLink(this.value)"><i class="fab fa-youtube"></i></button></abbr>';
            }else{
                $html .= '<abbr title="Go to YouTube"><a href="'.$d.'" target="_blank"><button data-toggle="modal" data-target="#youtube" class="btn btn-sm btn-success ml-1 mt-1"><i class="fab fa-youtube"></i></button></a></abbr>';
            }
            $html .=    '<div class="ml-1 mt-1">
                            <abbr title="Show Expenseces of Candidate"><a href="?page=ce'."&pn=".base64_encode($row[1])."&cd=".base64_encode($row[2]).'" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a></abbr>
                        </div>
                        <form class="ml-1 mt-1" action="index.php" method="post">
                            <input type="hidden" name="pagePost" value="exchangeVisa">
                            <input type="hidden" name="info" value="'.$row[3]."-".$row[0]."-".$row[6]."-".$visa['visaAmount'].'"-"'.$visa['visaGenderType'].'">
                            <abbr title="Exchange VISA"><button class="btn btn-danger btn-sm"><span class="fas fa-exchange-alt"></span></button></abbr>
                        </form>                                    
                        <form class="ml-1 mt-1" action="template/saveVisa.php" method="post">
                            <input type="hidden" name="alter" value="delete">
                            <input type="hidden" name="processingId" value="'.$row[0].'">
                            <abbr title="Delete Candidate VISA"><button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button></a></abbr>
                        </form>
                        <div class="ml-1 mt-1">
                            <form action="index.php" method="post">
                                <input type="hidden" name="redir" value="visaList">
                                <input type="hidden" name="pagePost" value="addCandidatePayment">
                                <input type="hidden" name="purpose" value="">
                                <input type="hidden" name="notAdvance" value="notAdvance">
                                <input type="hidden" name="candidateName" value="'.$row[3].'">
                                <input type="hidden" name="passport_info" value="'.$row[1]."_".$row[2].'">
                                <input type="hidden" name="agentEmail" value="'.$passport['agentEmail'].'">
                                <abbr title="Extra Expense"><button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button></abbr>
                            </form>
                        </div>
                    <div class="ml-1 mt-1">';
            if($passport['delegateComission'] == 0){
                $html .= '<abbr title="Add Delegate Comission"><button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#delegateComissionCandidate" value="'.$row[1]."_".$row[2].'" onclick="addDelegateExpense(this.value)"><span class="fa fa-dollar" aria-hidden="true"><span class="fa fa-plus" aria-hidden="true"></span></span></button></abbr>';
            }else{
                $html .= '<abbr title="Edit Delegate Comission"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#delegateComissionCandidate" value="'.$row[1]."_".$row[2]."_".$passport['delegateComission'].'" onclick="editDelegateExpense(this.value)"><span class="fa fa-dollar" aria-hidden="true"><span class="fa fa-check" aria-hidden="true"></span></span></button></abbr>';
            }                                            
            $html .=    '</div>
                        <div class="ml-1 mt-1">
                            <abbr title="Return or Complete candidate"><button data-target="#returnCandidate" data-toggle="modal" class="btn btn-sm btn-danger" type="button" value="'.$row[0]."_".$passport['status'].'" onclick="getReturnValue(this.value)"><i class="fas fa-user-times"></i></button></abbr>
                        </div>
                <div class="ml-1 mt-1">';
            if($passport['status'] != 2){
                $html .= '<abbr title="Disable candidate"><button data-target="#disableCandidate" data-toggle="modal" class="btn btn-sm btn-danger" type="button" value="'.$row[1]."_".$row[2].'" onclick="getDisableValue(this.value)"><i class="fas fa-ban"></i></button></abbr>';
            }else{
                $html .= '<abbr title="Show Disable Reason"><button data-target="#disableCandidateReason" data-toggle="modal" class="btn btn-sm btn-success" type="button" value="'.$row[1]."_".$row[2]."_".$passport['disableReason'].'" onclick="showDisableValue(this.value)"><i class="fas fa-ban"></i></button></abbr>';
            }
            $html .= '</div>
            </div>';
			return $html;
        }
	),
    array(
		'db' => 'youtube',
		'dt' => 34,
		'formatter' => function( $d, $row ) {global $conn;
            $passport = mysqli_fetch_assoc($conn->query("SELECT passport.status from passport where passportNum = '".$row[1]."' AND creationDate = '".$row[2]."'"));
			return $passport['status'];
        }
	)
);
$sql_details = array( 'user' => $user, 'pass' => $pass, 'db'   => $db, 'host' => $host );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns , $where , null)
);
?>