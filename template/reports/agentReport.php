<?php
include ('../database.php');
$agent_info = explode('-',$_POST['agentInfo']);
$agentName = $agent_info[0];
$agentEmail = $agent_info[1];
$agentTotalAmountGiven = mysqli_fetch_assoc($conn->query("SELECT SUM(fullAmount) as fullSum from agentexpense where agentEmail = '$agentEmail'"));
$totalComission = mysqli_fetch_assoc($conn->query("SELECT jobs.creditType, sum(amount) as total from completedagentcomission INNER JOIN passportcompleted on completedagentcomission.passportNum = passportcompleted.passportNum AND completedagentcomission.passportCreationDate = passportcompleted.creationDate INNER JOIN jobs on jobs.jobId = passportcompleted.jobId where jobs.creditType = 'Comission' AND completedagentcomission.agentEmail = '$agentEmail'"));
$totalPaid = mysqli_fetch_assoc($conn->query("SELECT jobs.creditType, sum(amount) as total from completedagentcomission INNER JOIN passportcompleted on completedagentcomission.passportNum = passportcompleted.passportNum AND completedagentcomission.passportCreationDate = passportcompleted.creationDate INNER JOIN jobs on jobs.jobId = passportcompleted.jobId where jobs.creditType = 'Paid' AND completedagentcomission.agentEmail = '$agentEmail'"));
$totalComission = 0;
$totalReceive = 0;
$totalReturnLoss = 0;
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
        <div class="card-group">
            <div class="row" style="width: 100%; margin-right: 0; margin-left: 0;">
                <div class="col-md-8" style="padding: 0">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="dataTableSeaum" style="width:100%">
                            <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Candidate Passport</th>
                                <th>VISA</th>
                                <th>Total Expense</th>
                                <th>Money</th>
                                <th>Advance Comission</th>
                            </tr>
                            </thead>';
            $result = $conn->query("SELECT jobs.creditType, passportcompleted.fName, passportcompleted.lName, passportcompleted.passportNum, passportcompleted.creationDate, processingcompleted.sponsorVisa, processingcompleted.processingId, (SELECT sum(completedcandidateexpense.amount) from completedcandidateexpense where completedcandidateexpense.passportNum = passportcompleted.passportNum AND completedcandidateexpense.passportCreationDate = passportcompleted.creationDate) as expenseSum, completedagentcomission.paidAmount, (SELECT SUM(completedadvance.advanceAmount) from completedadvance where completedadvance.comissionId = completedagentcomission.comissionId) as advanceSum FROM passportcompleted INNER JOIN processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate INNER JOIN completedagentcomission on passportcompleted.passportNum = completedagentcomission.passportNum AND passportcompleted.creationDate = completedagentcomission.passportCreationDate INNER JOIN jobs USING (jobId) WHERE passportcompleted.agentEmail = '$agentEmail' AND processingcompleted.pending = 2 ORDER BY passportcompleted.creationDate");
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
                $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.(is_null($agent['expenseSum'])) ? 0 : $agent['expenseSum']."</a>";    
                $html .=            '</td>';
                $html .=            '<td>';
                if($agent['creditType'] == 'Comission'){
                    $totalComission += (int)$agent['paidAmount'];
                    $html .= $agent['paidAmount'] . ' (due comission)';
                }else{
                    $totalReceive += (int)$agent['paidAmount'];
                    $html .= $agent['paidAmount'] . ' (due receive)';
                }
                $html .=            '</td>';
                $html .=            '<td>';
                $html .= (is_null($agent['advanceSum'])) ? 0 : $agent['advanceSum'];
                $html .=            '</td>
                                </tr>';
            }
            $result = $conn->query("SELECT jobs.creditType, passportcompleted.fName, passportcompleted.lName, passportcompleted.passportNum, passportcompleted.creationDate, processingcompleted.sponsorVisa, processingcompleted.processingId, (SELECT sum(completedcandidateexpense.amount) from completedcandidateexpense where completedcandidateexpense.passportNum = passportcompleted.passportNum AND completedcandidateexpense.passportCreationDate = passportcompleted.creationDate) as expenseSum, completedagentcomission.paidAmount, (SELECT SUM(completedadvance.advanceAmount) from completedadvance where completedadvance.comissionId = completedagentcomission.comissionId) as advanceSum FROM passportcompleted INNER JOIN processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate INNER JOIN completedagentcomission on passportcompleted.passportNum = completedagentcomission.passportNum AND passportcompleted.creationDate = completedagentcomission.passportCreationDate INNER JOIN jobs USING (jobId) WHERE passportcompleted.agentEmail = '$agentEmail' AND processingcompleted.pending = 3 ORDER BY passportcompleted.creationDate");
            while($agent = mysqli_fetch_assoc($result)){
                $html .=        '<tr style="background-color: #e57373">';
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
                $expenseSum = (is_null($agent['expenseSum'])) ? 0 : $agent['expenseSum'];
                $html .= '<a href="?page=cec&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.$expenseSum."</a>";    
                $html .=            '</td>';
                $html .=            '<td> - </td>';
                $html .=            '<td>';
                $html .= (is_null($agent['advanceSum'])) ? 0 : $agent['advanceSum'];
                $html .=            '</td>
                                </tr>';
                $totalReturnLoss += (!is_null($agent['advanceSum'])) ? $agent['advanceSum'] : 0;
                $totalReturnLoss += (is_null($agent['expenseSum'])) ? 0 : $agent['expenseSum'];
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
                        <input type="hidden" id="okTesting" value="gotIt">
                        </div>
                    </div>                    
                    
                </div>
                <div class="col-md-4" style="padding: 0">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <p>Total Comission</p>
                                        <h3>'.number_format($totalComission).'</h3>
                                    </div>
                                    <div class="col-sm">
                                        <p>Total Amount to Received</p>
                                        <h3>'.number_format($totalReceive).'</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">                                        
                                        <p>Total Return Loss</p>
                                        <h3>'.number_format($totalReturnLoss).'</h3>
                                    </div>
                                    <div class="col-sm">                                        
                                        <p>Total Amount Given</p>
                                        <a href="?page=showAgentExpenseList&ag='.base64_encode($agentEmail).'" target="_blank"><h3>'.number_format($agentTotalAmountGiven['fullSum']).'</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
            </div>
        </div>
    </div>';
echo $html;