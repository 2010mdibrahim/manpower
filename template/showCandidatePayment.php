<?php
$passportNum = base64_decode($_GET['pn']);
// $sponsorVisa = base64_decode($_GET['sv']);
$candidateInfo = mysqli_fetch_assoc($conn->query("SELECT count(candidateexpense.expenseId) as expenseCount, passport.fName, passport.lName, agent.agentName FROM candidateexpense INNER JOIN passport USING (passportNum) INNER JOIN agent on passport.agentEmail = agent.agentEmail where candidateexpense.passportNum = '$passportNum'"));
$expense_sum = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as expense_sum from candidateexpense where passportNum = '$passportNum' and purpose != 'Comission'"));
$comission_count = mysqli_fetch_assoc($conn->query("SELECT count(candidateexpense.expenseId) as expenseCount FROM candidateexpense where candidateexpense.passportNum = '$passportNum' AND candidateexpense.purpose = 'Comission'"));
$result_comission = $conn->query("SELECT candidateexpense.amount, advance.payDate, advance.advanceAmount FROM candidateexpense LEFT JOIN advance USING (expenseId) where candidateexpense.passportNum = '$passportNum' AND purpose = 'Comission'");
$result = $conn->query("SELECT candidateexpense.* FROM candidateexpense where candidateexpense.passportNum = '$passportNum' and purpose != 'Comission'");
$total = 0;
$amount = 0;
?>

<style>
    .btn{
        font-size: 11px;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    
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
            <div class="card" style="width: 10rem;">
                <div class="card-header text-center">
                    Comission
                </div>
                <?php if($comission_count['expenseCount'] != 0 ){?>
                <ul class="list-group list-group-flush">                    
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-3">
                                <span style="font-weight: 100; font-style: italic;">Total Amount: </span>
                            </div>
                            <div class="col-sm">
                                <?php echo  number_format($comission['amount'])." BDT"; $amount = intval($comission['amount']);?>
                            </div>
                        </div>                        
                    </li>
                </ul>
                <ul class="list-group list-group-flush" style="height: 100px; overflow: auto;">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm">
                                        <span style="font-weight: 100; font-style: italic;">Advance Amount: </span>
                                    </div>
                                    <div class="col-sm">
                                        <?php echo (!is_null($comission['advanceAmount'])) ? number_format($comission['advanceAmount'])." BDT" : 'Not Paid'; $total += (!is_null($comission['advanceAmount'])) ? intval($comission['advanceAmount']) : 0;?>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm">
                                        <span style="font-weight: 100; font-style: italic;">Pay Date: </span>
                                    </div>
                                    <div class="col-sm">
                                        <?php echo (!is_null($comission['payDate'])) ? $comission['payDate'] : 'Not Paid';?>
                                    </div>
                                </div>  
                            </div>                            
                        </div>                        
                    </li>
                    <?php while($comission = mysqli_fetch_assoc($result_comission)){?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm">
                                        <span style="font-weight: 100; font-style: italic;">Advance Amount: </span>
                                    </div>
                                    <div class="col-sm">
                                    <?php echo (!is_null($comission['advanceAmount'])) ? number_format($comission['advanceAmount'])." BDT" : 'Not Paid'; $total += (!is_null($comission['advanceAmount'])) ? intval($comission['advanceAmount']) : 0;?>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm">
                                        <span style="font-weight: 100; font-style: italic;">Pay Date: </span>
                                    </div>
                                    <div class="col-sm">
                                        <?php echo (!is_null($comission['payDate'])) ? $comission['payDate'] : 'Not Paid';?>
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
            <div class="card">
                <div class="card-body">
                <label class="card-title">Total Expense</label>
                <h4><?php echo number_format($expense_sum['expense_sum'])." BDT";?></h4>
                </div>
            </div>
        </div>
        <div class="card-body">
        
        <div class="table-responsive">
            <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
                    <th>Comment</th>
                    <th>Edit</th>
                </tr>
                </thead>   
                <?php if($candidateInfo['expenseCount'] != 0){ ?>                          
                    <?php while($candidateExpense = mysqli_fetch_assoc($result)){ ?>
                    <tr>                    
                        <td><?php echo $candidateExpense['purpose'];?></td>                        
                        <td><?php echo number_format($candidateExpense['amount']);?></td>
                        <td><?php echo $candidateExpense['creationDate'];?></td>
                        <td><?php echo $candidateExpense['comment'];?></td>  
                        <td>
                            <div class="row">
                                <div class="col-sm-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="pagePost" value="editCandidatePayment">
                                        <input type="hidden" name="candidateName" value="<?php echo $candidateInfo['fName']." ".$candidateInfo['lName'];?>">
                                        <input type="hidden" name="passportNum" value="<?php echo $passportNum;?>">
                                        <input type="hidden" name="agentEmail" value="<?php echo $candidateInfo['agentName'];?>">
                                        <button class="btn btn-info btn-sm"><span class="fa fa-edit"></span></button>
                                    </form>                                    
                                </div>
                                <div class="col-sm-3">
                                    <form action="template/saveVisa.php" method="post">
                                        <input type="hidden" name="alter" value="delete">
                                        <input type="hidden" name="processingId" value="<?php echo $visa['processingId'];?>">
                                        <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button></a>
                                    </form>
                                </div>
                            </div>
                        </td>                  
                    </tr>
                    <?php } ?>                
                <?php } ?> 
                <tfoot hidden>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
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
function trainingCard(info){
    let info_split = info.split('-');
    $('#passportNumCard').val(info_split[0]);
}

function visaStamping(info){
    let info_split = info.split('-');
    $('#passportNum').val(info_split[0]);
    $('#sponsorVisa').val(info_split[1]);
}

$('body').on('click', '#testMedicalFile', function(){
    $('#visaMedical').val($('#testMedicalFile').val());
});

$('body').on('click', '#finalMedicalFile', function(){
    $('#visaMedicalFinal').val($('#finalMedicalFile').val());
});

window.onload = function() {
    $('#visaNav').addClass('active');
};
</script>

