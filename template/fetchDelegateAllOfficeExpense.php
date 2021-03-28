<?php
include ('database.php');
$delegateTotalExpenseId = $_POST['delegateTotalExpenseId'];
$result = $conn->query("SELECT office.officeName, delegatetotalexpenseoffice.amount, delegatetotalexpenseoffice.delegateTotalExpenseOfficeId, delegatetotalexpenseoffice.date from delegatetotalexpenseoffice inner join office using (officeId) where delegateTotalExpenseId = $delegateTotalExpenseId");
$html = '   <div class="card" style="width: 100%; background-color: #dce775">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="background-color: #dce775">
                        <div class="row text-center">
                            <div class="col-md-4">Office Name</div>
                            <div class="col-md-4">Amount</div>
                            <div class="col-md-3">Date</div>
                            <div class="col-md-1">Alter</div>
                        </div>
                    </li>';
while($office = mysqli_fetch_assoc($result)){
    $html .= '      <li class="list-group-item" style="background-color: #f9fbe7">
                        <div class="row text-center">';                        
    $html .= '              <div class="col-md-4">'.$office['officeName'].'</div>';
    $html .= '              <div class="col-md-4">'.number_format($office['amount']).' Taka</div>';
    $html .= '              <div class="col-md-3">'.$office['date'].'</div>';
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