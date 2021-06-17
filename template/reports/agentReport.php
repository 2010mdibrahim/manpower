<?php
include ('../database.php');
$agent_info = explode('-',$_POST['agentInfo']);
$agentName = $agent_info[0];
$agentEmail = $agent_info[1];
$totalExpense = 0;
$totalComission = 0;
$totalComissionAdvance = 0;
$totalPaid = 0;
$totalPaidAdvance = 0;
$totalReturnLoss = 0;
$html = '<div class="card" style="height: 720px; overflow: auto;">
        <div class="card-header">
            <div class="section-header">
                <p style="font-size: 25px;">
                    Agent Report for                
                    <span style="font-size: 35px;">';
$html .= $agentName;
$html .=            '</span></p>
            </div>
        </div>
        <div class="card-group">
            <div class="row" style="width: 100%; margin-right: 0; margin-left: 0;">';
if(isset($agent_info[2])){
    $html .= '<div class="col-md-12" style="padding: 0">';
}else{
    $html .= '<div class="col-md-9" style="padding: 0">';
}
                
$html .=       '<div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="dataTableSeaum" style="width:100%">
                            <thead>
                            <tr>
                                <th>Payment Serial</th>
                                <th>Candidate Name</th>
                                <th>Candidate Passport</th>
                                <th>VISA</th>
                                <th>Total Expense</th>
                                <th>Money</th>
                                <th>Advance Comission</th>
                                <th>Payment Date</th>
                                <th>Purpose</th>
                            </tr>
                            </thead>';
            $result = $conn->query("SELECT jobs.creditType, fName, lName, passportNum, passport.creationDate, (SELECT sum(amount) from candidateexpense where candidateexpense.passportNum = passport.passportNum AND candidateexpense.passportCreationDate = passport.creationDate) as expenseSum from passport INNER JOIN jobs using (jobId) where agentEmail = '$agentEmail' AND status != 2 order by passport.creationDate desc");
            while($agent = mysqli_fetch_assoc($result)){
                $html .=        '<tr>';
                // this column for sorting the table
                $maxPayment = mysqli_fetch_assoc($conn->query("SELECT max(payDate) as maxPay FROM candidateexpense where passportNum = '".$agent['passportNum']."' AND passportCreationDate = '".$agent['creationDate']."'"));
                $html .= '<td>'.$maxPayment['maxPay'].'</td>';
                // end sorting column
                $html .=            '<td>'.$agent['fName'].' '.$agent['lName'].'</td>';
                $html .=            '<td><a href="?page=listCandidate&pp='.base64_encode($agent['passportNum'])."&cd=".base64_encode($agent['creationDate']).'">'.$agent['passportNum'].'</a></td>';
                $html .=            '<td>';
                $visa = mysqli_fetch_assoc($conn->query("SELECT sponsorVisa, processingId from processing where passportNum = '".$agent['passportNum']."' AND passportCreationDate = '".$agent['creationDate']."'"));
                if (!is_null($visa)){
                    $html .=                '<a href="?page=visaList&pi='.base64_encode($visa['processingId']).'">'.$visa['sponsorVisa'].'</a>';
                }else{
                    $html .=                '-';
                }
                $html .=            '</td>';
                $html .=            '<td>';
                $expns = (is_null($agent['expenseSum'])) ? 0 : $agent['expenseSum'];
                $totalExpense += $expns;
                $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.number_format($expns)."</a>";    
                $html .=            '</td>';
                $agent_comission = mysqli_fetch_assoc($conn->query("SELECT comissionId, agentcomission.amount from agentcomission INNER JOIN processing on processing.passportNum = agentcomission.passportNum AND processing.passportCreationDate = agentcomission.passportCreationDate where agentcomission.passportNum = '".$agent['passportNum']."' AND agentcomission.passportCreationDate = '".$agent['creationDate']."' AND processing.pending between 1 AND 2"));
                $agent_comission_returned = mysqli_fetch_assoc($conn->query("SELECT comissionId, agentcomission.amount from agentcomission INNER JOIN processing on processing.passportNum = agentcomission.passportNum AND processing.passportCreationDate = agentcomission.passportCreationDate where agentcomission.passportNum = '".$agent['passportNum']."' AND agentcomission.passportCreationDate = '".$agent['creationDate']."' AND processing.pending = 3"));
                $html .= (!is_null($agent_comission_returned)) ? '<td class="returned">' : '<td>';
                if(!is_null($agent_comission)){
                    if($agent['creditType'] == 'Comission'){
                        $totalComission += (int)$agent_comission['amount'];
                        $html .= number_format($agent_comission['amount']) . ' (comission)';
                    }else{
                        $totalPaid += (int)$agent_comission['amount'];
                        $html .= number_format($agent_comission['amount']) . ' (paid)';
                    }
                }else{
                    if(!is_null($agent_comission_returned)){
                        $totalReturnLoss += (int)$agent_comission_returned['amount'];
                        $html .= number_format($agent_comission_returned['amount']) . ' (returned)';
                    }else{
                        $html .= '-';
                    }
                }
                
                $html .=            '</td>';
                if(!is_null($agent_comission)){
                    $agent_comission_advance = mysqli_fetch_assoc($conn->query("SELECT sum(advanceAmount) as advanceSum from advance where comissionId = ".$agent_comission['comissionId']));
                }else{
                    $agent_comission_advance['advanceSum'] = null;
                }
                print_r(mysqli_error($conn));
                $html .=            '<td>';
                $advance = (is_null($agent_comission_advance['advanceSum'])) ? 0 : $agent_comission_advance['advanceSum'];
                if($agent['creditType'] == 'Comission'){
                    $totalComissionAdvance += $advance;
                }else{
                    $totalPaidAdvance += $advance;
                }
                $html .= $advance;
                $html .=            '</td>
                            <td> - </td>
                            <td> - </td>
                                </tr>';
            }
            $result = $conn->query("SELECT * from agentexpense where agentEmail = '".$agentEmail."'");
            while($agent_expense = mysqli_fetch_assoc($result)){
                $html .= '<tr>';
                $html .= '<td>'.$agent_expense['payDate'].'</td>';
                if($agent_expense['personal'] == 'yes'){
                    $html .= '<td>'.$agent_expense['candidateName'].'</td>';
                }else{
                    $html .= '<td>'.$agent_expense['candidateName'].'</td>';
                }
                $html .= '<td> - </td>';
                $html .= '<td> - </td>';
                $totalExpense += $agent_expense['fullAmount'];
                $html .= '<td>'.number_format($agent_expense['fullAmount']).'</td>';
                $html .= '<td> - </td>';
                $html .= '<td> - </td>';
                $html .= '<td>'.$agent_expense['payDate'].'</td>';
                $html .= '<td>'.$agent_expense['expensePurposeAgent'].'</td>';
                $html .= '</tr>';
            }
            $html .=        '<tfoot>
                                <tr hidden>
                                    <th>Payment Serial</th>
                                    <th>Candidate Name</th>
                                    <th>Candidate Passport</th>
                                    <th>VISA</th>
                                    <th>Total Expense</th>
                                    <th>Money</th>
                                    <th>Advance Comission</th>
                                    <th>Payment Date</th>
                                    <th>Purpose</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <input type="hidden" id="okTesting" value="gotIt">
                        </div>
                    </div>                    
                    
                </div>';
if(!isset($agent_info[2])){
    $html .=       '<div class="col-md-3" style="padding: 0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <p>Total Comission</p>
                        <h3><span id="pdf_total_comission">'.number_format($totalComission).'</span></h3>
                    </div>
                    <div class="col-sm">
                        <p>Total Expense</p>
                        <h3><span id="pdf_total_expense">'.number_format($totalExpense).'</span></h3>
                    </div>
                </div>
            </div>';
    $finalTotal = $totalComission - $totalExpense - $totalComissionAdvance;
    $html .=                    '<div class="card-body">
                <div class="row">';
    $html .=                        '<div class="col-sm">                                        
                        <p>Remaining Balance</p>';
    if($finalTotal < 0){                                        
    $html .= '<h3 class="text-danger"><span id="pdf_total_final">'.number_format($finalTotal).'</span></h3>';
    }else{
    $html .= '<h3>'.number_format($finalTotal).'</h3>';
    }
    $html .=                            '</div>
                    <div class="col-sm">                                        
                        <p>Total Returned Loss</p>
                        <a href="?page=returnedListCandidate&ag='.base64_encode($agentEmail).'" target="_blank"><h3><span id="pdf_total_loss">'.number_format($totalReturnLoss).'</span></h3></a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    </div>';
}

$html .=    '</div>
    </div>';
echo $html;