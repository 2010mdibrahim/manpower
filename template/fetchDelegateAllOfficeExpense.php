<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$full_report = $_POST['full_report'];
if($full_report == 'yes'){
    $result = $conn->query("SELECT * from account_maheer order by `date` desc");
}else{
    $result = $conn->query("SELECT * from account_maheer order by `date` desc limit 100");
}
if($result->num_rows != 0){
    $html = '<li class="list-group-item">
            <h5 class="text-center"> Office List </h5>
        <div class="card" style="width: 100%; background-color: #dce775">
        <ul class="list-group list-group-flush list-overflow">
            <div class="row">
                <div class="col-md-12">
                    <li class="list-group-item" style="background-color: #dce775">
                        <div class="row text-center">
                            <div class="col-print-3 center-column-3">Date</div>
                            <div class="col-print-3 center-column-3">PARTICULARS</div>
                            <div class="col-print-2 center-column-2">Debit</div>
                            <div class="col-print-2 center-column-2">Credit</div>
                            <div class="col-print-1 exclude">Receipt</div>
                            <div class="col-print-1 exclude">Alter</div>
                        </div>
                    </li>
                </div>
            </div>';
    while($office = mysqli_fetch_assoc($result)){
    $html .= '<li class="list-group-item" style="background-color: #f9fbe7">
                <div class="row text-center">';
    $html .= '             <div class="col-print-3 center-column-3">'.$office['date'].'</div>';
    $html .= '              <div class="col-print-3 center-column-3">'.$office['particular'].'</div>';
    $html .= '              <div class="col-print-2 center-column-2">'.$office['debit'] * $office['dollar_rate_debit'].' Taka</div>';
    $html .= '              <div class="col-print-2 center-column-2">'.$office['credit'].' Taka</div>';
    if($office['debit_receipt'] != ''){
        $html .= '              <div class="col-print-1 exclude"><a href="'.$office['debit_receipt'].'" target="_blank"><button class="btn btn-sm btn-info" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button></a></div>';
    }else{
        $html .= '              <div class="col-print-1 exclude">-</div>';
    }
    $html .= '              <div class="col-print-1 exclude">';
    $html .= '                  <div class="row justify-content-center">';
    $html .= '                      <div class="col-sm">';
    $html .= '                          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editOfficeExpense" value="'.$office['id'].'_'.$office['debit'].'_'.$office['credit']."_".$office['date']."_".$office['particular']."_".$office['dollar_rate_debit'].'" onclick="editOfficeExpense(this.value)"><span class="fa fa-edit"></span></button>';
    $html .= '                      </div>';
    $html .= '                      <div class="col-sm">';
    $html .= '                          <form method="post" action="template/editOfficeExpense.php">';
    $html .= '                              <input type="hidden" name="alter" value="delete">';
    $html .= '                              <input type="hidden" name="account_maheer_id" value="'.$office['id'].'">';
   $html .= '                               <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>';
    $html .= '                          </form>';
    $html .= '                      </div>';
    $html .= '                  </div>';
    $html .= '              </div>';
    $html .= '          </div>
            </li>';
    }
    $html .= '      </ul>
    </div>
    </li>';
}else{
    $html = '<li class="list-group-item"><div class="card text-center" style="width: 100%; background-color: #dce775"><div class="card-header"><h5>No Office Added</h5></div></div></li>';
}
$result = $conn->query("SELECT jobs.creditType, fName, lName, passportNum, passport.creationDate, passport.jobId, (SELECT sum(amount) from candidateexpense where candidateexpense.passportNum = passport.passportNum AND candidateexpense.passportCreationDate = passport.creationDate) as expenseSum, manpoweroffice.manpowerOfficeId from passport INNER JOIN jobs using (jobId) LEFT JOIN manpoweroffice using (manpowerOfficeName) where agentEmail = 'maheeer2010@hotmail.com' AND status != 2 order by passport.creationDate desc");
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
                            <div class="col-print-3 center-column-3">VISA</div>
                            <div class="col-print-3 center-column-3">Total Expense</div>
                        </div>
                    </li>
                </div>
            </div>';
    while($candidate = mysqli_fetch_assoc($result)){
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
                $totalExpense += $manpowerJobProcessing['processingCost'] + $ticket_price;
            }
            $html .=    '<div class="col-print-3 center-column-3">'.$visa['sponsorVisa'].'</div>';
            $html .=    '<div class="col-print-3 center-column-3">'.number_format($candidate['expenseSum'] + $manpower_processing_cost + $ticket_price).'</div>';
        }else{
            $html .=    '<div class="col-print-3 center-column-3"> - </div>';
            $html .=    '<div class="col-print-3 center-column-3">'.number_format($candidate['expenseSum'] + $manpower_processing_cost + $ticket_price).'</div>';
        }
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