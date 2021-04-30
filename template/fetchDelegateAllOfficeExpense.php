<?php
include ('database.php');
$delegateTotalExpenseId = $_POST['delegateTotalExpenseId'];
$result = $conn->query("SELECT * from delegatetotalexpenseoffice where delegateTotalExpenseId = $delegateTotalExpenseId");
$html = '   <div class="card" style="width: 100%; background-color: #dce775">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="background-color: #dce775">
                        <div class="row text-center">
                            <div class="col-md-3">Office Name</div>
                            <div class="col-md-3">Amount</div>
                            <div class="col-md-3">Date</div>
                            <div class="col-md-2">Receipt</div>
                            <div class="col-md-1">Alter</div>
                        </div>
                    </li>';
while($office = mysqli_fetch_assoc($result)){
    $html .= '      <li class="list-group-item" style="background-color: #f9fbe7">
                        <div class="row text-center">';
    if($office['type'] == 'outside'){
        $officeName = mysqli_fetch_assoc($conn->query("SELECT officeName from office where officeId = ".$office['officeId']));
        $html .= '             <div class="col-md-3">'.$officeName['officeName'].'</div>';
    }else if($office['type'] == 'manpower'){
        $officeName = mysqli_fetch_assoc($conn->query("SELECT manpowerOfficeName from manpoweroffice where manpowerOfficeId = ".$office['officeId']));
        $html .= '             <div class="col-md-3">'.$officeName['manpowerOfficeName'].'</div>';
    }else{
        $html .= '             <div class="col-md-3">'.$office['officeId'].'</div>';
    }
    $html .= '              <div class="col-md-3">'.number_format($office['amount']).' Taka</div>';
    $html .= '              <div class="col-md-3">'.$office['date'].'</div>';
    $html .= '              <div class="col-md-2"><a href="'.$office['receipt'].'" target="_blank"><button class="btn btn-sm btn-info" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button></a></div>';
    $html .= '              <div class="col-md-1">';
    $html .= '                  <div class="row justify-content-center">';
    $html .= '                      <div class="col-sm">';
    $html .= '                          <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editOfficeExpense" value="'.$office['delegateTotalExpenseOfficeId'].'_'.$office['amount']."_".$office['date'].'" onclick="editOfficeExpense(this.value)"><span class="fa fa-edit"></span></button>';
    $html .= '                      </div>';
    $html .= '                      <div class="col-sm">';
    $html .= '                          <form method="post" action="template/editOfficeExpense.php">';
    $html .= '                              <input type="hidden" name="alter" value="delete">';
    $html .= '                              <input type="hidden" name="delegateTotalExpenseOfficeId" value="'.$office['delegateTotalExpenseOfficeId'].'">';
    $html .= '                              <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>';
    $html .= '                          </form>';
    $html .= '                      </div>';
    $html .= '                  </div>';
    $html .= '              </div>';
    $html .= '          </div>
                    </li>';
}
$html .= '      </ul>
            </div>';
echo $html;