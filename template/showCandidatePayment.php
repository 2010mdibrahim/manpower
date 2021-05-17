<?php
$passportNum = base64_decode($_GET['pn']);
$creationDate = base64_decode($_GET['cd']);
$today = date("Y-m-d");
// this is candidateinfo
$candidateInfo = mysqli_fetch_assoc($conn->query("SELECT jobs.creditType, processing.processingId, processing.visaStampingDate, count(ticketId) as count_ticket, passport.fName, passport.lName, passport.jobId, agent.agentName, agent.agentEmail FROM passport INNER JOIN jobs using(jobId) INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate INNER JOIN agent USING (agentEmail) LEFT JOIN ticket on passport.passportNum = ticket.passportNum AND passport.creationDate = ticket.passportCreationDate where passport.passportNum = '$passportNum' AND passport.creationDate = '$creationDate'"));
// this this candidate expenseces
$result_candidate_expense = $conn->query("SELECT candidateexpense.* FROM candidateexpense where candidateexpense.passportNum = '$passportNum' AND candidateexpense.passportCreationDate = '$creationDate'");
// this is candidate expenseces sum
$expense_sum = mysqli_fetch_assoc($conn->query("SELECT ticket.ticketPrice, manpowerjobprocessing.processingCost from passport INNER JOIN manpoweroffice on manpoweroffice.manpowerOfficeName = passport.manpowerOfficeName INNER JOIN manpowerjobprocessing on manpoweroffice.manpowerOfficeId = manpowerjobprocessing.manpowerOfficeId LEFT JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate where passport.passportNum = '$passportNum' AND passport.creationDate = '$creationDate' AND manpowerjobprocessing.jobId = ".$candidateInfo['jobId']));
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
                            <?php if($candidateInfo['creditType'] == 'Comission'){ ?>Comission<?php }else{ ?> Total amount to receive<?php } ?>
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
                                            <div class="col-sm">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="redir" value="<?php echo "ce&pn=".base64_encode($passportNum)."&cd=".base64_encode($creationDate);?>">
                                                    <input type="hidden" name="candidateName" value="<?php echo $candidateInfo['fName']." ".$candidateInfo['lName'];?>">
                                                    <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                                    <input type="hidden" name="agentEmail" value="<?php echo $comission['agentEmail'];?>">
                                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                                    <input type="hidden" name="purpose" value="Comission">
                                                    <input type="hidden" name="comission_amount" value="<?php echo $amount;?>">
                                                    <input type="hidden" name="comission_id" value="<?php echo $comission['comissionId'];?>">
                                                    <button class="btn btn-sm">Add Advance</button>
                                                </form>
                                            </div>
                                            <div class="col-sm">
                                                <button class="btn btn-sm" type='button' data-target="#comissionAmount" data-toggle="modal" onclick="comissionAmount(this.value)" value="<?php echo $comission['comissionId']."_".$passportNum."_".$creationDate; ?>">Edit</button>
                                            </div>
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
                                            <div class="col-sm">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="pagePost" value="editCandidatePayment">
                                                    <input type="hidden" name="candidateName" value="<?php echo $candidateInfo['fName']." ".$candidateInfo['lName'];?>">
                                                    <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                                    <input type="hidden" name="agentEmail" value="<?php echo $candidateInfo['agentEmail'];?>">
                                                    <input type="hidden" name="advanceId" value="<?php echo $comission['advanceId'];?>">
                                                    <input type="hidden" name="purpose" value="Comission">
                                                    <input type="hidden" name="amount" value="<?php echo $comission['amount'];?>">
                                                    <input type="hidden" name="advanceAmount" value="<?php echo $comission['advanceAmount'];?>">
                                                    <input type="hidden" name="advancePayMode" value="<?php echo $comission['advancePayMode'];?>">
                                                    <input type="hidden" name="payDate" value="<?php echo $comission['payDate'];?>">
                                                    <button class="btn btn-info btn-sm"><span class="fa fa-edit"></span></button>
                                                </form> 
                                            </div>
                                            <div class="col-sm">
                                                <form action="template/addCandidatePaymentQry.php" method="post">
                                                    <input type="hidden" name="alter" value="delete">
                                                    <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                                    <input type="hidden" name="advanceId" value="<?php echo $comission['advanceId'];?>">
                                                    <button class="btn btn-danger btn-sm"><span class="fa fa-close"></span></button>
                                                </form> 
                                            </div>
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
                                            <div class="col-sm">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="pagePost" value="editCandidatePayment">
                                                    <input type="hidden" name="candidateName" value="<?php echo $candidateInfo['fName']." ".$candidateInfo['lName'];?>">
                                                    <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                                    <input type="hidden" name="agentEmail" value="<?php echo $candidateInfo['agentEmail'];?>">
                                                    <input type="hidden" name="advanceId" value="<?php echo $advance_comission['advanceId'];?>">
                                                    <input type="hidden" name="purpose" value="Comission">
                                                    <input type="hidden" name="amount" value="<?php echo $advance_comission['amount'];?>">
                                                    <input type="hidden" name="advanceAmount" value="<?php echo $advance_comission['advanceAmount'];?>">
                                                    <input type="hidden" name="advancePayMode" value="<?php echo $advance_comission['advancePayMode'];?>">
                                                    <input type="hidden" name="payDate" value="<?php echo $advance_comission['payDate'];?>">
                                                    <button class="btn btn-info btn-sm"><span class="fa fa-edit"></span></button>
                                                </form>
                                            </div>
                                            <div class="col-sm">
                                                <form action="template/addCandidatePaymentQry.php" method="post">
                                                    <input type="hidden" name="alter" value="delete">
                                                    <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                                    <input type="hidden" name="advanceId" value="<?php echo $advance_comission['advanceId'];?>">
                                                    <button class="btn btn-danger btn-sm"><span class="fa fa-close"></span></button>
                                                </form> 
                                            </div>
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
                <div class="col-sm-4" style="padding: 0;">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="card-title">Total Expense</label>
                                <?php $result_expense_sum = mysqli_fetch_assoc($conn->query("SELECT sum(candidateexpense.amount) as expense_sum from candidateexpense where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'"));?>
                                <?php if($candidateInfo['agentEmail'] == 'maheeer2010@hotmail.com' AND $candidateInfo['visaStampingDate'] <= $today){ ?>
                                    <h4><?php $totalExpense = ($result_expense_sum) ? $result_expense_sum['expense_sum'] : 0 ; $totalExpense += + $expense_sum['ticketPrice'] + $expense_sum['processingCost']; echo number_format($totalExpense)." BDT";  ?></h4>
                                <?php }else{ ?>
                                    <h4><?php $totalExpense = ($result_expense_sum) ? $result_expense_sum['expense_sum'] : 0 ; echo number_format($totalExpense)." BDT"; ?></h4>
                                <?php } ?>
                            </div>
                            <?php if($candidateInfo['agentEmail'] == 'maheeer2010@hotmail.com'){?>
                                <?php if($candidateInfo['visaStampingDate'] <= $today){ ?>
                                    <div class="col-md-8">
                                        <label class="card-title">Total Office Expense: <span><?php echo number_format($expense_sum['ticketPrice']+$expense_sum['processingCost']);?> BDT</span></label>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Ticket Price: <span><?php echo number_format($expense_sum['ticketPrice']);?></span></li>
                                            <li class="list-group-item">Processing Cost: <span><?php echo number_format($expense_sum['processingCost']);?></span></li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="col-md-8">
                                    <label class="card-title">Total Office Expense: <span><?php echo number_format($expense_sum['ticketPrice']+$expense_sum['processingCost']);?> BDT</span></label>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Ticket Price: <span><?php echo number_format($expense_sum['ticketPrice']);?></span></li>
                                        <li class="list-group-item">Processing Cost: <span><?php echo number_format($expense_sum['processingCost']);?></span></li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if(empty($comission['comissionPayMode'])){ ?>
                                    <div class="col-sm">
                                        <label class="card-title"><?php if($candidateInfo['creditType'] == 'Comission'){ ?>Net Payable<?php }else{ ?> Net Due Receive<?php } ?></label>
                                        <h4><?php echo number_format(($amount - $total) - $totalExpense)." BDT";?></h4>
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
                    <th>Edit</th>
                </tr>
                </thead>                                
                <?php while($candidateExpense = mysqli_fetch_assoc($result_candidate_expense)){ ?>
                    <tr>                    
                        <td><?php echo $candidateExpense['purpose'];?></td>                        
                        <td><?php echo number_format($candidateExpense['amount']);?></td>
                        <td><?php echo $candidateExpense['payDate'];?></td>
                        <td><?php echo $candidateExpense['payMode'];?></td>
                        <td><?php echo $candidateExpense['comment'];?></td>  
                        <td>
                            <div class="row">
                                <div class="col-sm-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="redir" value="<?php echo "ce&pn=".base64_encode($passportNum)."&cd=".base64_encode($creationDate); ?>">
                                        <input type="hidden" name="pagePost" value="editCandidatePayment">
                                        <input type="hidden" name="candidateName" value="<?php echo $candidateInfo['fName']." ".$candidateInfo['lName'];?>">
                                        <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                        <input type="hidden" name="agentEmail" value="<?php echo $candidateInfo['agentEmail'];?>">
                                        <input type="hidden" name="expenseId" value="<?php echo $candidateExpense['expenseId'];?>">
                                        <input type="hidden" name="purpose" value="<?php echo $candidateExpense['purpose'];?>">
                                        <input type="hidden" name="amount" value="<?php echo $candidateExpense['amount'];?>">
                                        <input type="hidden" name="payMode" value="<?php echo $candidateExpense['payMode'];?>">
                                        <input type="hidden" name="payDate" value="<?php echo $candidateExpense['payDate'];?>">
                                        <button class="btn btn-info btn-sm"><span class="fa fa-edit"></span></button>
                                    </form>                                    
                                </div>
                                <div class="col-sm-3">
                                    <form action="template/addCandidatePaymentQry.php" method="post">
                                        <input type="hidden" name="alter" value="delete">                                        
                                        <input type="hidden" name="passport_info" value="<?php echo $passportNum."_".$creationDate;?>">
                                        <input type="hidden" name="expenseId" value="<?php echo $candidateExpense['expenseId'];?>">
                                        <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button></a>
                                    </form>
                                </div>
                            </div>
                        </td>                  
                    </tr>
                <?php } ?> 
                <tfoot hidden>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
                    <th>Pay Mode</th>
                    <th>Comment</th>
                    <th>Edit</th>
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

