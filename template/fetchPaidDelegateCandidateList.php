<?php
include ('database.php');
$info = explode('_',$_POST['info']);
$delegateId = $info[0];
$paidStatus = $info[1];
$html = '<div class="modal-body">
        <p>Total Comission Received: <span id="totalComissionShow" style="font-weight: bold"></span></p>
        </div>
        <div class="table-responsive">
        <table id="dataTableSeaumPaid" class="table table-bordered table-hover" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Passport No</th>
                <th>VISA No</th>                
                <th>ID No</th>
                <th>Stamping</th>
                <th>Flight Date</th>
                <th>Comission</th>
                <th>Received In BDT</th>
            </tr>
            </thead>';
$today = date('Y-m-d');
$totalComission = 0;
$delegateList_result = $conn->query("SELECT processing.pending, delegate.delegateName, passport.fName, passport.lName, passport.passportNum, passport.delegateComissionPaid, passport.creationDate, processing.sponsorVisa, sponsor.sponsorNID, processing.visaStampingDate, passport.delegateComission, passport.id as passport_pk FROM passport INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN delegateoffice on delegateoffice.delegateOfficeId = sponsor.delegateOfficeId INNER JOIN delegate on delegate.delegateId = delegateoffice.delegateId WHERE delegate.delegateId = $delegateId AND processing.visaStampingDate < '$today' AND passport.delegateComissionPaid = 'paid' ORDER BY processing.pending");
while( $delegateList = mysqli_fetch_assoc($delegateList_result) ){
    $totalComission += (int)$delegateList['delegateComission'];
    $html .= '<tr>
                <td>'.$delegateList['fName']." ".$delegateList['lName'].'</td>
                <td>'.$delegateList['passportNum'].'</td>
                <td>'.$delegateList['sponsorVisa'].'</td>
                <td>'.$delegateList['sponsorNID'].'</td>
                <td>'.$delegateList['visaStampingDate'].'</td>';
    $ticket = mysqli_fetch_assoc($conn->query("SELECT flightDate from ticket where passportNum = '".$delegateList['passportNum']."' AND passportCreationDate = '".$delegateList['creationDate']."'"));
    if(is_null($ticket)){
        $html .= '<td> - </td>';
    }else{
        $html .= '<td>'.$ticket['flightDate'].'</td>';
    }
    $paid_comission = mysqli_fetch_assoc($conn->query("SELECT sum(amount * dollar_rate) as total_amount from delegate_comission_for_candidate where passport_id = ".$delegateList['passport_pk']));
    $html .=   '<td><span>&#x24; '.$delegateList['delegateComission'].' </span></td>
                <td>'.number_format($paid_comission['total_amount']).'</td>
            </tr>';
}
$html .=    '<tfoot>
            <tr hidden>
                <th>Name</th>
                <th>Passport No</th>
                <th>VISA No</th>                
                <th>ID No</th>
                <th>Stamping</th>
                <th>Flight Date</th>
                <th>Comission</th>
                <th>Received In BDT</th>
            </tr>
            </tfoot>
        </table>
        <input type="hidden" id="totalComission" value="'.$totalComission.'">
        </div>';
$header = 'Comission Complete List';
$data = array(
    'html' => $html,
    'header' => $header,
    'button' => ''
);
echo json_encode($data);