<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$full_report = $_POST['full_report'];
$totalDebit = 0;
$totalCredit = 0;
// if($full_report == 'yes'){
//     $result = $conn->query("SELECT * from account_maheer");
// }else{
//     $result = $conn->query("SELECT * from account_maheer limit 100");
// }
$result = $conn->query("SELECT * from account_maheer order by date");
if($result->num_rows != 0){
    $html = '';
    while($office = mysqli_fetch_assoc($result)){
        $temp_html = '';
        $temp_html .= '<li class="list-group-item" style="background-color: #f9fbe7">
                    <div class="row text-center">';
        $temp_html .= '             <div class="col-print-2 center-column-2">'.$office['date'].'</div>';
        $temp_html .= '              <div class="col-print-3">'.$office['particular'].'</div>';
        $totalDebit += ( $office['debit'] * $office['dollar_rate_debit'] );
        $totalCredit += $office['credit'];
        $temp_html .= '              <div class="col-print-2">'.$office['debit'] * $office['dollar_rate_debit'].' Taka</div>';
        $temp_html .= '              <div class="col-print-2">'.$office['credit'].' Taka</div>';
        $temp_html .= '              <div class="col-print-1 center-column-3">'.( $totalDebit - $totalCredit ).' Taka</div>';
        if($office['debit_receipt'] != ''){
            $temp_html .= '              <div class="col-print-1 exclude"><a href="'.$office['debit_receipt'].'" target="_blank"><button class="btn btn-sm btn-info" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button></a></div>';
        }else{
            $temp_html .= '              <div class="col-print-1 exclude">-</div>';
        }
        $temp_html .= '              <div class="col-print-1 exclude">';
        $temp_html .= '                  <div class="row justify-content-center">';
        $temp_html .= '                      <div class="col-sm">';
        $temp_html .= '                          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editOfficeExpense" value="'.$office['id'].'_'.$office['debit'].'_'.$office['credit']."_".$office['date']."_".$office['particular']."_".$office['dollar_rate_debit'].'" onclick="editOfficeExpense(this.value)"><span class="fa fa-edit"></span></button>';
        $temp_html .= '                      </div>';
        $temp_html .= '                      <div class="col-sm">';
        $temp_html .= '                          <form method="post" action="template/editOfficeExpense.php">';
        $temp_html .= '                              <input type="hidden" name="alter" value="delete">';
        $temp_html .= '                              <input type="hidden" name="account_maheer_id" value="'.$office['id'].'">';
        $temp_html .= '                               <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>';
        $temp_html .= '                          </form>';
        $temp_html .= '                      </div>';
        $temp_html .= '                  </div>';
        $temp_html .= '              </div>';
        $temp_html .= '          </div>
                </li>';
        $html = $temp_html . $html;
    }
    $html = '<li class="list-group-item">
                <h5 class="text-center"> Office List </h5>
            <div class="card" style="width: 100%; background-color: #dce775">
            <ul class="list-group list-group-flush list-overflow">
                <div class="row">
                    <div class="col-md-12">
                        <li class="list-group-item" style="background-color: #dce775">
                            <div class="row text-center">
                                <div class="col-print-2 center-column-2">Date</div>
                                <div class="col-print-3">PARTICULARS</div>
                                <div class="col-print-2">Debit</div>
                                <div class="col-print-2">Credit</div>
                                <div class="col-print-1 center-column-3">Adjust Money</div>
                                <div class="col-print-1 exclude">Receipt</div>
                                <div class="col-print-1 exclude">Alter</div>
                            </div>
                        </li>
                    </div>
                </div>' . $html;
    $html .= '      </ul>
                </div>
            </li>';
}else{
    $html = '<li class="list-group-item"><div class="card text-center" style="width: 100%; background-color: #dce775"><div class="card-header"><h5>No Office Added</h5></div></div></li>';
}
$result = $conn->query("SELECT jobs.creditType, fName, lName, passportNum, passport.creationDate, passport.jobId, manpoweroffice.manpowerOfficeId from passport INNER JOIN jobs using (jobId) LEFT JOIN manpoweroffice using (manpowerOfficeName) where agentEmail = 'maheeer2010@hotmail.com' AND status != 2 order by passport.creationDate desc");
$totalExpense = 0;
$today = date("Y-m-d");
if($result->num_rows != 0){
    $html .= '<li class="list-group-item">
            <h5 class="text-center"> Candidate List </h5>
        <div class="card" style="width: 100%; background-color: #dce775">
        <ul class="list-group list-group-flush list-overflow">
            <div class="row">
                <div class="col-md-12">
                    <li class="list-group-item" style="background-color: #dce775">
                        <div class="row text-center">
                            <div class="col-print-3 center-column-3">Candidate Name</div>
                            <div class="col-print-3 center-column-3">Passport</div>
                            <div class="col-print-2 center-column-2">VISA</div>
                            <div class="col-print-2 center-column-2">Expense Details</div>
                            <div class="col-print-2 center-column-2">Total Expense</div>
                        </div>
                    </li>
                </div>
            </div>';
    while($candidate = mysqli_fetch_assoc($result)){
        $totalExpense = 0;
        $expense_row = $conn->query("SELECT amount, purpose from candidateexpense where candidateexpense.passportNum = '".$candidate['passportNum']."' AND candidateexpense.passportCreationDate = '".$candidate['creationDate']."'");
        $ticket_price = 0;
        $manpower_processing_cost = 0;
        $html .= '<li class="list-group-item" style="background-color: #f9fbe7">
                    <div class="row text-center">';
        $html .= '  <div class="col-print-3 center-column-3">'.$candidate['fName'].' '.$candidate['fName'].'</div>';
        $html .= '  <div class="col-print-3 center-column-3">'.$candidate['passportNum'].'</div>';
        
        $visa = mysqli_fetch_assoc($conn->query("SELECT manpowerCard, sponsorVisa, processingId, visaStampingDate from processing where passportNum = '".$candidate['passportNum']."' AND passportCreationDate = '".$candidate['creationDate']."'"));
        if (!is_null($visa)){
            if($visa['manpowerCard'] == 'yes'){
                $manpowerJobProcessing = mysqli_fetch_assoc($conn->query("SELECT processingCost from manpowerjobprocessing where manpowerOfficeId = ".$candidate['manpowerOfficeId']." AND jobId = ".$candidate['jobId']));
                $ticket = mysqli_fetch_assoc($conn->query("SELECT ticketPrice from ticket where passportNum = '".$candidate['passportNum']."' AND passportCreationDate = '".$candidate['creationDate']."' AND flightDate < '".$today."'"));
                $ticket_price = (is_null($ticket)) ? 0 : $ticket['ticketPrice'];
                $manpower_processing_cost = $manpowerJobProcessing['processingCost'];
            }
            $html .=    '<div class="col-print-2 center-column-2">'.$visa['sponsorVisa'].'</div>';
        }else{
            $html .=    '<div class="col-print-2 center-column-2"> - </div>';
        }
        $html .= '  <div class="col-print-2 center-column-2">';
        $tmp = '';
        if($manpower_processing_cost != 0){
            $tmp .= 'Manpower, ';
        }
        if($ticket_price != 0){
            $tmp .= 'Ticket, ';
        }
        while($expense = mysqli_fetch_assoc($expense_row)){
            $totalExpense += $expense['amount'];
            $tmp .= $expense['purpose'].', ';
        }
        $html .= rtrim($tmp,', ').'.';
        $html .= '</div>';
        $html .= '<div class="col-print-2 center-column-2">'.number_format($totalExpense + $manpower_processing_cost + $ticket_price).'</div>';
        $html .= '</div>
                </li>';
    }
    $html .= '      </ul>
    </div>
    </li>';
}else{
    $html = '<li class="list-group-item"><div class="card text-center" style="width: 100%; background-color: #dce775"><div class="card-header"><h5>No Candidate Expense</h5></div></div></li>';
}
echo $html;