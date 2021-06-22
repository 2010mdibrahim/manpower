<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$html = '<div class="table-responsive">
        <table id="dataTableSeaumNotPaid" class="table table-bordered table-hover  dataTable" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Passport No</th>
                <th>VISA No</th>                
                <th>ID No</th>
                <th>Stamping</th>
                <th>Flight Date</th>
                <th>Comission</th>
                <th>Amount Received</th>
                <th>In BDT</th>
                <th>Option</th>
            </tr>
            </thead>';
$today = date('Y-m-d');
$delegateList_result = $conn->query("SELECT processing.pending, delegate.delegateName, passport.fName, passport.lName, passport.passportNum, passport.creationDate, processing.sponsorVisa, sponsor.sponsorNID, processing.visaStampingDate, passport.delegateComission, passport.id as passport_id FROM passport INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN delegateoffice on delegateoffice.delegateOfficeId = sponsor.delegateOfficeId INNER JOIN delegate on delegate.delegateId = delegateoffice.delegateId WHERE delegate.delegateId = $delegateId AND processing.visaStampingDate < '$today' AND passport.delegateComissionPaid = 'no' AND passport.delegateComission != 0 AND passport.status = 0 ORDER BY processing.pending");
// print_r(mysqli_error($conn));
while( $delegateList = mysqli_fetch_assoc($delegateList_result) ){
    $html .=    '<tr>
                    
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
        $html .=     '<td><span>&#x24; </span>'.$delegateList['delegateComission'].'</td>';
        // $html .=     '<td>'.$delegateList['dollarRate'].'</td>';
        // $html .=     '<td><span>&#2547; </span>'.number_format($delegateList['delegateComission']*$delegateList['dollarRate']).'</td>';
        $amount_payed = mysqli_fetch_assoc($conn->query("SELECT sum(amount * dollar_rate) as amount_received_in_taka, sum(amount) as amount_received_in_dollar from delegate_comission_for_candidate where passport_id = ".$delegateList['passport_id']));
        if(is_null($amount_payed)){
            $amount_received_in_taka = 0;
            $amount_received_in_dollar = 0;
        }else{
            $amount_received_in_taka = $amount_payed['amount_received_in_taka'];
            $amount_received_in_dollar = $amount_payed['amount_received_in_dollar'];
        }
        $html .=     '<td><span>&#x24; </span>'.number_format($amount_received_in_dollar).'</td>';
        $html .=     '<td><span>&#2547; </span>'.number_format($amount_received_in_taka).'</td>';
        $remaining = $delegateList['delegateComission'] - $amount_received_in_dollar;
        $html .=     '<td><button data-toggle="modal" data-target="#add_comission_delegate" class="btn btn-success btn-sm" value="" onclick="add_delegate_expense(\''.$delegateList['passport_id'].'\', \''.$remaining.'\')">Comission +</button></td>
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
                <th>Amount Received</th>
                <th>In BDT</th>
                <th>Option</th>
            </tr>
            </tfoot>
        </table>
        </div>';
$header = 'Delegate Candidate List';
$data = array(
    'html' => $html,
    'header' => $header,
    'button' => '<button type="submit" class="btn btn-primary">Submit</button>'
);
echo json_encode($data);