<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$html = '<div class="table-responsive">
        <table id="dataTableSeaumNotPaid" class="table table-bordered table-hover  dataTable" style="width:100%">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Passport No</th>
                <th>VISA No</th>                
                <th>ID No</th>
                <th>Stamping</th>
                <th>Flight Date</th>
                <th>Comission</th>
            </tr>
            </thead>';
$today = date('Y-m-d');
$delegateList_result = $conn->query("SELECT processing.pending, delegate.delegateName, passport.fName, passport.lName, passport.passportNum, passport.creationDate, processing.sponsorVisa, sponsor.sponsorNID, processing.visaStampingDate, ticket.flightDate, passport.delegateComission FROM passport INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate INNER JOIN delegateoffice on delegateoffice.delegateOfficeId = sponsor.delegateOfficeId INNER JOIN delegate on delegate.delegateId = delegateoffice.delegateId WHERE delegate.delegateId = $delegateId AND processing.pending = 1 AND ticket.flightDate < '$today' AND passport.delegateComissionPaid = 'no' ORDER BY processing.pending");
while( $delegateList = mysqli_fetch_assoc($delegateList_result) ){
$html .=    '<tr>
                <td>
                <div class="form-group">
                <input type="checkbox" value="'.$delegateList['passportNum'].'_'.$delegateList['creationDate'].'" name="candidateList[]">
                </div>
                </td>
                <td>'.$delegateList['fName']." ".$delegateList['lName'].'</td>
                <td>'.$delegateList['passportNum'].'</td>
                <td>'.$delegateList['sponsorVisa'].'</td>
                <td>'.$delegateList['sponsorNID'].'</td>
                <td>'.$delegateList['visaStampingDate'].'</td>
                <td>'.$delegateList['flightDate'].'</td>
                <td><span>&#x24; </span>'.$delegateList['delegateComission'].'</td>
            </tr>';
}
$html .=    '<tfoot hidden>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Passport No</th>
                <th>VISA No</th>                
                <th>ID No</th>
                <th>Stamping</th>
                <th>Flight Date</th>
                <th>Comission</th>
            </tr>
            </tfoot>
        </table>
        </div>';
echo $html;