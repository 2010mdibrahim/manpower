<?php
$passportNum = base64_decode($_GET['pn']);
$creationDate = base64_decode($_GET['cd']);
// this is candidateinfo
$candidateInfo = mysqli_fetch_assoc($conn->query("SELECT processingcompleted.processingId, count(ticketId) as count_ticket, passportcompleted.fName, passportcompleted.lName, agent.agentName, agent.agentEmail FROM passportcompleted INNER JOIN processingcompleted on processingcompleted.passportNum = passportcompleted.passportNum AND processingcompleted.passportCreationDate = passportcompleted.creationDate INNER JOIN agent USING (agentEmail) LEFT JOIN ticket on passportcompleted.passportNum = ticket.passportNum AND passportcompleted.creationDate = ticket.passportCreationDate where passportcompleted.passportNum = '$passportNum' AND passportcompleted.creationDate = '$creationDate'"));
// this this candidate expenseces
$result_candidate_expense = $conn->query("SELECT candidateexpense.* FROM candidateexpense where candidateexpense.passportNum = '$passportNum' AND candidateexpense.passportCreationDate = '$creationDate'");
// this is candidate expenseces sum
$expense_sum = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as expense_sum from candidateexpense where passportNum = '$passportNum' AND candidateexpense.passportCreationDate = '$creationDate' AND purpose != 'Comission'"));
// this is comission and advances
$result_comission = $conn->query("SELECT agentcomission.payMode as comissionPayMode, agentcomission.payDate as comissionPayDate, agentcomission.paidAmount as comissionPaidAmount, agentcomission.agentEmail, agentcomission.comissionId, agentcomission.amount, advance.advancePayMode, agentcomission.creationDate, agentcomission.comment, advance.advanceAmount, advance.payDate, advance.advanceId FROM agentcomission LEFT JOIN advance USING (comissionId) where agentcomission.passportNum = '$passportNum' AND agentcomission.passportCreationDate = '$creationDate'");
$total = 0;
$amount = 0;
?>

<style>
    .btn{
        font-size: 11px;
    }
    .comission-box{
        border-left: 1px solid gray;
    }
    .list-group-item.advance{
        background-color: #e3f2fd;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <!-- Edit Comission Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="comissionAmount">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editComission.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Comission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="comissionId" id="comissionId">
                        <input type="hidden" name="passportNum" id="passportNum">
                        <input type="hidden" name="creationDate" id="creationDate">
                        <input class="form-control" type="number" name="amount" placeholder="Enter New Amount">
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Full Payment Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="adjustComissionAmount">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editComission.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Make Full Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="alter" value="adjust">
                        <input type="hidden" name="comissionId" id="comissionIdAdjust">
                        <input type="hidden" name="passportNum" id="passportNumAdjust">
                        <input type="hidden" name="creationDate" id="creationDateAdjust">
                        <input type="hidden" name="processingId" id="processingId">
                        <div class="form-group">
                            <input class="form-control" type="number" name="amount" id="adjuctAmount" readonly>                      
                        </div>
                        <div class="form-group">
                            <?php $payMode_result = $conn->query("SELECT * from paymentmethod");?>
                            <select class="form-control" name="payMode" id="payMode" required>
                                <option value="">-- Select Payment Method --</option>
                                <?php while($payMode = mysqli_fetch_assoc($payMode_result)){ ?>
                                    <option><?php echo $payMode['paymentMode'];?></option>
                                <?php } ?>
                            </select>                      
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Expense Information</h2>
            </div>
        </div>
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <label class="card-title">Candidate Name</label>
                    <h4><?php echo $candidateInfo['fName']." ".$candidateInfo['lName'];?></h4></span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <label class="card-title">Passport Number</label>
                <h4><?php echo $passportNum;?></h4>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <label class="card-title">Agent Name</label>
                <h4><?php echo $candidateInfo['agentName'];?></h4>
                </div>
            </div>
        </div>
        <?php $comission = mysqli_fetch_assoc($result_comission);?>
        <div class="card-group">
            <div class="row" style="width: 100%; margin:0;">
                <div class="col-sm-8" style="padding: 0;">
                    <div class="card">
                        <div class="card-header text-center">
                            Comission
                        </div>
                        <?php if(!is_null($comission)){?>
                        <ul class="list-group list-group-flush">                    
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-sm">
                                                <span style="font-weight: 100; font-style: italic;">Total Amount: </span>
                                            </div>
                                            <div class="col-sm">
                                                <?php echo  number_format($comission['amount'])." BDT"; $amount = intval($comission['amount']);?>
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>                        
                            </li>
                        </ul>
                        <ul class="list-group list-group-flush" style="height: 100px; overflow: auto;">
                            <li class="list-group-item advance">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <span style="font-weight: 100; font-style: italic;">Advance Amount: </span>
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo (!is_null($comission['advanceAmount'])) ? number_format($comission['advanceAmount'])." BDT" : 'Not Paid'; $total += (!is_null($comission['advanceAmount'])) ? intval($comission['advanceAmount']) : 0;?>
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="col-sm-3 comission-box">
                                        <div class="row">
                                            <div class="col-sm">
                                                <span style="font-weight: 100; font-style: italic;">Pay Mode: </span>
                                            </div>
                                            <div class="col-sm">
                                                <?php echo (!is_null($comission['advancePayMode'])) ? $comission['advancePayMode'] : 'Not Paid';?>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3 comission-box">
                                        <div class="row">
                                            <div class="col-sm">
                                                <span style="font-weight: 100; font-style: italic;">Pay Date: </span>
                                            </div>
                                            <div class="col-sm">
                                                <?php echo (!is_null($comission['payDate'])) ? $comission['payDate'] : 'Not Paid';?>
                                            </div>
                                        </div>  
                                    </div> 
                                    <div class="col-sm-2 comission-box">
                                        <div class="row">
                                        </div>
                                    </div>                           
                                </div>                        
                            </li>
                            <?php while($advance_comission = mysqli_fetch_assoc($result_comission)){?>
                            <li class="list-group-item advance">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <span style="font-weight: 100; font-style: italic;">Advance Amount: </span>
                                            </div>
                                            <div class="col-sm-4">
                                            <?php echo (!is_null($advance_comission['advanceAmount'])) ? number_format($advance_comission['advanceAmount'])." BDT" : 'Not Paid'; $total += (!is_null($advance_comission['advanceAmount'])) ? intval($advance_comission['advanceAmount']) : 0;?>
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="col-sm-3 comission-box">
                                        <div class="row">
                                            <div class="col-sm">
                                                <span style="font-weight: 100; font-style: italic;">Pay Mode: </span>
                                            </div>
                                            <div class="col-sm">
                                                <?php echo (!is_null($advance_comission['advancePayMode'])) ? $advance_comission['advancePayMode'] : 'Not Paid';?>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3 comission-box">
                                        <div class="row">
                                            <div class="col-sm">
                                                <span style="font-weight: 100; font-style: italic;">Pay Date: </span>
                                            </div>
                                            <div class="col-sm">
                                                <?php echo (!is_null($advance_comission['payDate'])) ? $advance_comission['payDate'] : 'Not Paid';?>
                                            </div>
                                        </div>  
                                    </div> 
                                    <div class="col-sm-2 comission-box">
                                        <div class="row">                                            
                                        </div>
                                    </div>                           
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <span style="font-weight: 100; font-style: italic;">Balance: </span>
                                    </div>
                                    <div class="col-sm">
                                        <?php echo number_format($amount - $total)." BDT";?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php }else{?>
                        <div class="card-body text-center">
                            Not Specified
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <?php $ticket = mysqli_fetch_assoc($conn->query("SELECT count(ticketId) as ticket_count, ticketId, ticketPrice, comment from ticket where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'")); ?>
                <div class="col-sm-4" style="padding: 0;">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <label class="card-title">Total Expense</label>
                            <h4><?php 
                            if($ticket['ticket_count'] > 0){
                                $totalExpense = intval($ticket['ticketPrice']) + intval($expense_sum['expense_sum']);
                            }else{
                                $totalExpense = $expense_sum['expense_sum'];
                            }
                            echo number_format($totalExpense)." BDT";
                            ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if(empty($comission['comissionPayMode'])){ ?>
                                    <div class="col-sm">
                                        <label class="card-title">Net Payable</label>
                                        <h4><?php echo number_format(($amount - $total) - $totalExpense)." BDT";?></h4>
                                    </div>
                                    <div class="col-sm text-center">
                                        <?php if($candidateInfo['count_ticket'] > 0){?>
                                            <button class="btn btn-info" data-target="#adjustComissionAmount" data-toggle="modal" value="<?php echo $comission['comissionId']."_".$passportNum."_".$creationDate."_".(($amount - $total) - $totalExpense)."_".$candidateInfo['processingId'];?>" onclick="adjustComissionAmount(this.value)">Full Payment</button>
                                        <?php }else{ ?>
                                            <button class="btn btn-secondary">Finish Previous Steps</button>
                                        <?php } ?>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-sm">
                                        <label class="card-title">Paid Amount</label>
                                        <h4><?php echo number_format($comission['comissionPaidAmount'])." BDT";?></h4>
                                    </div>
                                    <div class="col-sm">
                                        <label class="card-title">Pay Date</label>
                                        <h4><?php echo $comission['comissionPayDate'];?></h4>
                                    </div>
                                    <div class="col-sm">
                                        <label class="card-title">Pay Mode</label>
                                        <h4><?php echo $comission['comissionPayMode'];?></h4>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">        
        <div class="table-responsive">
            <table id="dataTableSeaum" class="table table-bordered table-hover text-center" style="width:100%">
                <thead>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
                    <th>Pay Mode</th>
                    <th>Comment</th>
                </tr>
                </thead>    
                <?php
                if($ticket['ticket_count']){ ?>   
                    <tr>
                        <td>Ticket</td>
                        <td><?php echo number_format($ticket['ticketPrice']);?></td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo $ticket['comment'];?></td>
                    </tr>   
                <?php } ?>                  
                <?php while($candidateExpense = mysqli_fetch_assoc($result_candidate_expense)){ ?>
                    <tr>                    
                        <td><?php echo $candidateExpense['purpose'];?></td>                        
                        <td><?php echo number_format($candidateExpense['amount']);?></td>
                        <td><?php echo $candidateExpense['creationDate'];?></td>
                        <td><?php echo $candidateExpense['payMode'];?></td>
                        <td><?php echo $candidateExpense['comment'];?></td>                 
                    </tr>
                <?php } ?> 
                <tfoot hidden>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
                    <th>Pay Mode</th>
                    <th>Comment</th>
                </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>

<script>
function comissionAmount(info){
    let info_split = info.split('_');
    $('#comissionId').val(info_split[0]);
    $('#passportNum').val(info_split[1]);
    $('#creationDate').val(info_split[2]);
}
function adjustComissionAmount(info){
    let info_split = info.split('_');
    alert(info_split);
    $('#comissionIdAdjust').val(info_split[0]);
    $('#passportNumAdjust').val(info_split[1]);
    $('#creationDateAdjust').val(info_split[2]);
    $('#adjuctAmount').val(info_split[3]);
    $('#processingId').val(info_split[4]);
}
window.onload = function() {
    $('#visaNav').addClass('active');
};
</script>
