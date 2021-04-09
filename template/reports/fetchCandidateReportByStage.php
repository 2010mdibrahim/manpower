<?php
include ('../database.php');
$stage = $_POST['stage'];

$html = '<div class="card">
        <div class="card-header">
            <div class="section-header">
                <p style="font-size: 25px;">
                Stage Wise Candidate Report
                </p>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="dataTableSeaum" style="width:100%">
                <thead>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Passport</th>
                    <th>VISA</th>
                    <th>Total Expense</th>
                    <th>Comission</th>
                </tr>
                </thead>';
switch($stage){
    case 'testMedical':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate where passport.testMedical = 'yes' order by passport.creationDate desc");
        break;       
    case 'finalMedical':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate where passport.finalMedical = 'yes' order by passport.creationDate desc");
        break;
    case 'empRqst':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.foreignMole = 'yes' order by passport.creationDate desc");
        break;
        
    case 'okala':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.okala = 'yes' order by passport.creationDate desc");
        break;
        
    case 'mufa':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.mufa = 'yes' order by passport.creationDate desc");
        break;
            
    case 'medicalUpdate':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.medicalUpdate = 'yes' order by passport.creationDate desc");
        break;
            
    case 'visaStamping':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.foreignMole = 'yes' order by passport.creationDate desc");
        break;
            
    case 'finger':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.finger = 'yes' order by passport.creationDate desc");
        break;

    case 'foreignMole':
        $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate INNER JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.finger = 'yes' order by passport.creationDate desc");
        break;
}
while($agent = mysqli_fetch_assoc($candidateInfo_comission)){
    $html .=        '<tr>';
    $html .=            '<td>'.$agent['fName'].' '.$agent['lName'].'</td>';
    $visa = mysqli_fetch_assoc($conn->query("SELECT processing.pending, processing.sponsorVisa, processing.processingId from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where passport.passportNum = '".$agent['passportNum']."' AND passport.creationDate = '".$agent['creationDate']."'"));
    if (!is_null($visa)){
        if($visa['pending'] == 0){
            $html .=            '<td><a href="?page=listCandidate&pp='.base64_encode($agent['passportNum'])."&cd=".base64_encode($agent['creationDate']).'">'.$agent['passportNum'].'</a></td>';
        }else{
            $html .=            '<td><a href="?page=pendingListCandidate&pp='.base64_encode($agent['passportNum'])."&cd=".base64_encode($agent['creationDate']).'">'.$agent['passportNum'].'</a></td>';
        }
    }else{
        $html .=                '<td><a href="?page=listCandidate&pp='.base64_encode($agent['passportNum'])."&cd=".base64_encode($agent['creationDate']).'">'.$agent['passportNum'].'</a></td>';
    }
    $html .=            '<td>';
    if (!is_null($visa)){
        if($visa['pending'] == 0){
            $html .=                '<a href="?page=visaList&pi='.base64_encode($visa['processingId']).'">'.$visa['sponsorVisa'].'</a>';
        }else{
            $html .=                '<a href="?page=pendingVisaList&pi='.base64_encode($visa['processingId']).'">'.$visa['sponsorVisa'].'</a>';
        }
    }else{
        $html .=                '-';
    }
    $html .=            '</td>';
    $html .=            '<td>';
    $candidateExpense = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as expenseSum from candidateexpense INNER JOIN passport on passport.passportNum = candidateexpense.passportNum AND passport.creationDate = candidateexpense.passportCreationDate where passport.passportNum = '".$agent['passportNum']."' AND passport.creationDate = '".$agent['creationDate']."'"));
    if(!is_null($candidateExpense['expenseSum'])){    
        $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.number_format($candidateExpense['expenseSum'])."</a>";
    }else{
        $html .= '-';
    };
    $html .=            '</td>';
    $html .=            '<td>';
    $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.number_format($agent['amount'])."</a>";
    $html .=            '</td>';
    $html .=            '</tr>';
}
$html .=        '<thead hidden>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Passport</th>
                    <th>VISA</th>
                    <th>Total Expense</th>
                    <th>Comission</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>';
echo $html;