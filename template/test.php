<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$result = $conn->query("SELECT * from account_maheer order by `date` desc");
if($result->num_rows != 0){
    $html = '   <div class="card" style="width: 100%; background-color: #dce775">
        <ul class="list-group list-group-flush list-overflow">
        <div class="card-header sticky">
            <div class="row">
                <div class="col-md-12">
                    <li class="list-group-item" style="background-color: #dce775">
                        <div class="row text-center">
                            <div class="col-print-3 center-column">Date</div>
                            <div class="col-print-3 center-column">PARTICULARS</div>
                            <div class="col-print-3 center-column">Debit</div>
                            <div class="col-print-2 exclude">Credit</div>
                            <div class="col-print-1 exclude">Alter</div>
                        </div>
                    </li>
                </div>
            </div>
        </div>';
    while($office = mysqli_fetch_assoc($result)){
    $html .= '<li class="list-group-item" style="background-color: #f9fbe7">
                <div class="row text-center">';
    $html .= '             <div class="col-print-3 center-column">'.$office['date'].'</div>';
    $html .= '              <div class="col-print-3 center-column">'.$office['particular'].' Taka</div>';
    $html .= '              <div class="col-print-3 center-column">'.$office['debit'].'</div>';
    $html .= '              <div class="col-print-2 exclude"><a href="'.$office['credit'].'" target="_blank"><button class="btn btn-sm btn-info" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button></a></div>';
    $html .= '              <div class="col-print-1 exclude">';
    $html .= '                  <div class="row justify-content-center">';
    $html .= '                      <div class="col-sm">';
    $html .= '                          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editOfficeExpense" value="'.$office['delegateTotalExpenseOfficeId'].'_'.$office['amount']."_".$office['date'].'_'.$delegateId.'" onclick="editOfficeExpense(this.value)"><span class="fa fa-edit"></span></button>';
    $html .= '                      </div>';
    $html .= '                      <div class="col-sm">';
    $html .= '                          <form method="post" action="template/editOfficeExpense.php">';
    $html .= '                              <input type="hidden" name="alter" value="delete">';
    $html .= '                              <input type="hidden" name="delegateId" value="'.$delegateId.'">';
    $html .= '                              <input type="hidden" name="delegateTotalExpenseOfficeId" value="'.$office['delegateTotalExpenseOfficeId'].'">';
   $html .= '                               <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>';
    $html .= '                          </form>';
    $html .= '                      </div>';
    $html .= '                  </div>';
    $html .= '              </div>';
    $html .= '          </div>
            </li>';
    }
    $html .= '      </ul>
    </div>';
}else{
    $html = '<div class="card text-center" style="width: 100%; background-color: #dce775"><div class="card-header"><h5>No Office Added</h5></div></div>';
}
echo $html;