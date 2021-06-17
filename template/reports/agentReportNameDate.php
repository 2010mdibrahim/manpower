<?php
include ('../database.php');
$agent_info = explode('-',$_POST['agentInfo']);
$agentName = $agent_info[0];
$agentEmail = $agent_info[1];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$totalExpense = 0;
$totalComission = 0;

$html = '<div class="card">
        <div class="card-header">
            <div class="section-header">
                <p style="font-size: 25px;">
                    Agent Report for                
                    <span style="font-size: 35px;">';
$html .= $agentName;
$html .=            '</span></p>
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
if(isset($_POST['completeReport'])){
    $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate where passport.agentEmail = '$agentEmail' order by passport.creationDate desc");
}else{
    $candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate where passport.agentEmail = '$agentEmail' AND passport.creationDate between '$date_from' AND '$date_to' order by passport.creationDate desc");
}
while($agent = mysqli_fetch_assoc($candidateInfo_comission)){
    $visa = mysqli_fetch_assoc($conn->query("SELECT processing.pending, processing.sponsorVisa, processing.processingId from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where passport.passportNum = '".$agent['passportNum']."' AND passport.creationDate = '".$agent['creationDate']."'"));
    if(is_null($visa)){
        $html .=        '<tr>';
    }else{
        if($visa['pending'] == '2'){
            $html .=        '<tr style="background-color: #e0f2f1;">';
        }else{
            $html .=        '<tr>';
        }
    }
    $html .=            '<td>'.$agent['fName'].' '.$agent['lName'].'</td>';
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
        $totalExpense += $candidateExpense['expenseSum'];   
        $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.number_format($candidateExpense['expenseSum'])."</a>";
    }else{
        $html .= '-';
    };
    $html .=            '</td>';
    $html .=            '<td>';
    if (!is_null($visa)){
        if($visa['pending'] == 1){
            $totalComission += $agent['amount'];   
            $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.number_format($agent['amount'])."</a>";
        }else{
            $html .= '0';
        }
    }
    $html .=            '</td>';
    $html .=            '</tr>';
}
$html .=        '<tfoot hidden>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Passport</th>
                    <th>VISA</th>
                    <th>Total Expense</th>
                    <th>Comission</th>
                </tr>
                </tfoot>
            </table>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-Sm box">Total Expense = '.number_format($totalExpense).'</div>
                <div class="col-Sm box">Total Comission = '.number_format($totalComission).'</div>
                <div class="col-Sm box">Grand Total = '.number_format((intval($totalComission) - intval($totalExpense))).'</div>
            </div>
        </div>
    </div>';
echo $html;