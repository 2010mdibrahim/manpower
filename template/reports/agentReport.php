<?php
include ('../database.php');
$agent_info = explode('-',$_POST['agentInfo']);
$agentName = $agent_info[0];
$agentEmail = $agent_info[1];
$totalComission = mysqli_fetch_assoc($conn->query("SELECT jobs.creditType, sum(amount) as total from completedagentcomission INNER JOIN passportcompleted on completedagentcomission.passportNum = passportcompleted.passportNum AND completedagentcomission.passportCreationDate = passportcompleted.creationDate INNER JOIN jobs on jobs.jobId = passportcompleted.jobId where jobs.creditType = 'Comission' AND completedagentcomission.agentEmail = '$agentEmail'"));
$totalPaid = mysqli_fetch_assoc($conn->query("SELECT jobs.creditType, sum(amount) as total from completedagentcomission INNER JOIN passportcompleted on completedagentcomission.passportNum = passportcompleted.passportNum AND completedagentcomission.passportCreationDate = passportcompleted.creationDate INNER JOIN jobs on jobs.jobId = passportcompleted.jobId where jobs.creditType = 'Paid' AND completedagentcomission.agentEmail = '$agentEmail'"));
$totalPaidDue = 0;
$totalPaidAdvance = 0;
$totalComissionDue = 0;
$totalComissionAdvance = 0;
$completedTotalPaidDue = 0;
$completedTotalPaidAdvance = 0;
$completedTotalComissionDue = 0;
$completedTotalComissionAdvance = 0;
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
                                <th>Comission</th>
                                <th>Advance Comission</th>
                            </tr>
                            </thead>';
            $result = $conn->query("SELECT jobs.creditType, ticket.ticketPrice, passport.passportNum,passport.creationDate, passport.fName, passport.lName,processing.processingId, processing.sponsorVisa, (SELECT SUM(candidateexpense.amount) FROM candidateexpense WHERE candidateexpense.passportNum = passport.passportNum AND candidateexpense.passportCreationDate = passport.creationDate) as candidate_expense, (SELECT SUM(advance.advanceAmount) from advance WHERE advance.comissionId = agentcomission.comissionId) as advance_sum, agentcomission.amount FROM agent INNER JOIN passport USING (agentEmail) LEFT JOIN processing ON passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate LEFT JOIN agentcomission ON passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentcomission.passportCreationDate LEFT JOIN ticket on ticket.passportNum= passport.passportNum AND ticket.passportCreationDate = passport.creationDate INNER JOIN jobs on passport.jobId = jobs.jobId WHERE agent.agentEmail = '$agentEmail' order by passport.creationDate desc");
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
                $advanceSum = (!is_null($agent['advance_sum'])) ? $agent['advance_sum'] : 0;
                $html .=            '</td>';
                $html .=            '<td>';
                // calculate total price
                $candidateExpense = (is_null($agent['candidate_expense'])) ? 0 : $agent['candidate_expense'];
                $ticketPrice = (is_null($agent['ticketPrice'])) ? 0 : $agent['ticketPrice'];
                $totalPrice = $candidateExpense + $ticketPrice;
                // 
                $html .= '<a href="?page=ce&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.$totalPrice."</a>";    
                $html .=            '</td>';
                $html .=            '<td>';
                if($agent['creditType'] == 'Comission'){
                    $totalComissionDue += ($agent['amount'] - $totalPrice);
                }else{
                    $totalPaidDue += $agent['amount'];
                }
                $due = $agent['amount'] - $totalPrice - $advanceSum;
                $due = $agent['amount'] - $totalPrice - $advanceSum;
                if(!is_null($agent['amount'])){
                    $html .= $due;
                }
                if($agent['creditType'] == 'Comission'){
                    $html .= ' (due comission)';
                }else{
                    $html .= ' (due receive)';
                }
                $html .=            '</td>';
                $html .=            '<td>';
                if($agent['creditType'] == 'Comission'){
                    $totalComissionAdvance += $advanceSum;
                }else{
                    $totalPaidAdvance += $advanceSum;
                }
                $html .= ($advanceSum != 0) ? $advanceSum : '-';
                $html .=            '</td>
                                </tr>';
            }
            $result = $conn->query("SELECT ticket.ticketPrice, passportcompleted.passportNum,passportcompleted.creationDate, passportcompleted.fName, passportcompleted.lName,processingcompleted.processingId, processingcompleted.sponsorVisa, (SELECT SUM(completedcandidateexpense.amount) FROM completedcandidateexpense WHERE completedcandidateexpense.passportNum = passportcompleted.passportNum AND completedcandidateexpense.passportCreationDate = passportcompleted.creationDate) as candidate_expense, (SELECT SUM(advance.advanceAmount) from advance WHERE advance.comissionId = completedagentcomission.comissionId) as advance_sum, completedagentcomission.amount, completedagentcomission.paidAmount FROM agent INNER JOIN passportcompleted USING (agentEmail) LEFT JOIN processingcompleted ON passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate LEFT JOIN completedagentcomission ON passportcompleted.passportNum = completedagentcomission.passportNum AND passportcompleted.creationDate = completedagentcomission.passportCreationDate LEFT JOIN ticket on ticket.passportNum= passportcompleted.passportNum AND ticket.passportCreationDate = passportcompleted.creationDate WHERE agent.agentEmail = '$agentEmail' order by passportcompleted.creationDate desc");
            print_r(mysqli_error($conn));
            while($agent = mysqli_fetch_assoc($result)){
                $html .=        '<tr style="background-color: #c8e6c9">';
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
                $candidateExpense = (is_null($agent['candidate_expense'])) ? 0 : $agent['candidate_expense'];
                $totalPrice = $candidateExpense + intval($agent['ticketPrice']);
                $html .= '<a href="?page=cec&pn='.base64_encode($agent['passportNum']).'&cd='.base64_encode($agent['creationDate']).'">'.$totalPrice."</a>";
                $html .=            '</td>';
                $html .=            '<td>';
                $html .= (!is_null($agent['paidAmount'])) ? $agent['paidAmount'].' (paid)' : '-';
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
                        <input type="hidden" id="okTesting" value="gotIt">
                        </div>
                    </div>                    
                    
                </div>
                <div class="col-md-4" style="padding: 0">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <p>Total Paid Comission</p>
                                        <h3>'.number_format($totalComission['total']).'</h3>
                                    </div>
                                    <div class="col-sm">
                                        <p>Total Amount Received</p>
                                        <h3>'.number_format($totalPaid['total']).'</h3>
                                    </div>
                                </div>                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">                                        
                                        <p>Total Due Comission</p>
                                        <h3>'.number_format($totalComissionDue - $totalComissionAdvance).'</h3>
                                    </div>
                                    <div class="col-sm">
                                        <p>Total Advance Comission</p>
                                        <h3>'.number_format($totalComissionAdvance).'</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">                                        
                                        <p>Total Due Amount to receive</p>
                                        <h3>'.number_format($totalPaidDue - $totalPaidAdvance).'</h3>
                                    </div>
                                    <div class="col-sm">
                                        <p>Total Recieved Advance</p>
                                        <h3>'.number_format($totalPaidAdvance).'</h3>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
            </div>
        </div>
    </div>';
echo $html;