<?php
include ('../database.php');
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];

$html = '<div class="card">
        <div class="card-header">
            <div class="section-header">
                <p style="font-size: 18px;">
                    Candidate Report from:
                    <span style="font-size: 25px;">'.$date_from.'</span>
                    <span style="font-size: 25px;"> - '.$date_to.'</span>
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
$candidateInfo_comission = $conn->query("SELECT passport.passportNum,passport.creationDate, passport.fName, passport.lName, agentcomission.amount from passport INNER JOIN agentcomission on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentComission.passportCreationDate where passport.creationDate between '$date_from' AND '$date_to' order by passport.creationDate desc");
while($agent = mysqli_fetch_assoc($candidateInfo_comission)){
    $visa = mysqli_fetch_assoc($conn->query("SELECT processing.pending, processing.sponsorVisa, processing.processingId from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where passport.passportNum = '".$agent['passportNum']."' AND passport.creationDate = '".$agent['creationDate']."'"));
    if(is_null($visa)){
        $html .=        '<tr>';
    }else{
        if($visa['pending'] == '2'){
            $html .=        '<tr style="background-color: #e0f2f1;">';
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