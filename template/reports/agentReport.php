<?php
include ('../database.php');
$agent_info = explode('-',$_POST['agentInfo']);
$agentName = $agent_info[0];
$agentEmail = $agent_info[1];

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
                    <th>Advance Comission</th>
                </tr>
                </thead>';
$result = $conn->query("SELECT ticket.ticketPrice, passport.passportNum,passport.creationDate, passport.fName, passport.lName,processing.processingId, processing.sponsorVisa, (SELECT SUM(candidateexpense.amount) FROM candidateexpense WHERE candidateexpense.passportNum = passport.passportNum AND candidateexpense.passportCreationDate = passport.creationDate) as candidate_expense, (SELECT SUM(advance.advanceAmount) from advance WHERE advance.comissionId = agentcomission.comissionId) as advance_sum, agentcomission.amount FROM agent INNER JOIN passport USING (agentEmail) LEFT JOIN processing ON passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate LEFT JOIN agentcomission ON passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentcomission.passportCreationDate LEFT JOIN ticket on ticket.passportNum= passport.passportNum AND ticket.passportCreationDate = passport.creationDate WHERE agent.agentEmail = '$agentEmail' order by passport.creationDate desc");
while($agent = mysqli_fetch_assoc($result)){
$html .=        '<tr>';
$html .=            '<td>'.$agent['fName'].' '.$agent['lName'].'</td>';
$html .=            '<td><a href="?page=listCandidate&pp='.base64_encode($agent['passportNum'])."&cd=".base64_encode($agent['creationDate']).'">'.$agent['passportNum'].'</a></td>';
$html .=            '<td>';
if (!is_null($agent['sponsorVisa'])){
    $html .=                '<a href="?page=visaList&pi='.base64_encode($agent['processingId']).'">'.$agent['sponsorVisa'].'</a>';
}else{
    $html .=                '-';
}
$html .=            '</td>';
$html .=            '<td>';
if(!is_null($agent['candidate_expense'])){
    if(!is_null($agent['ticketPrice'])){
        $totalPrice = intval($agent['candidate_expense']) + intval($agent['ticketPrice']);
        $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.$totalPrice."</a>";
    }else{
        $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.intval($agent['candidate_expense'])."</a>";
    }
}else{
    '-';
};
$html .=            '</td>';
$html .=            '<td>';
$html .= (!is_null($agent['amount'])) ? $agent['amount'] : '-';
$html .=            '</td>';
$html .=            '<td>';
$html .= (!is_null($agent['advance_sum'])) ? $agent['advance_sum'] : '-';
$html .=            '</td>
                </tr>';
}
$html .=        '<thead hidden>
                <tr>
                    <th>Candidate Name</th>
                    <th>Candidate Passport</th>
                    <th>VISA</th>
                    <th>Total Expense</th>
                    <th>Comission</th>
                    <th>Advance Comission</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>';
echo $html;