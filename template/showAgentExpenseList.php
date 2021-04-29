<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
 }else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Agent", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                    header("Location: ../index.php");
                    exit();
            } 
        }        
    }
 }
if(isset($_GET['ag'])){
    $agentEmail = base64_decode($_GET['ag']);
    $agentName = mysqli_fetch_assoc($conn -> query("SELECT agentName from agent where agentEmail = '$agentEmail'"));
}else{
    $agentEmail = '';
}
$today = date('Y-m-d');
$result_agent_expense = $conn -> query("SELECT candidateNID, candidateBirthNumber, payDate, agentExpenseId, candidateName, fullAmount, expensePurposeAgent, date(creationDate) as creationDate FROM agentexpense WHERE agentEmail = '$agentEmail'");
$result_comission = $conn -> query("SELECT jobs.creditType, agentcomission.amount, agentcomission.comissionId, passport.fName, passport.lName, passport.passportNum, passport.creationDate, ticket.flightDate FROM agentcomission INNER JOIN passport on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentcomission.passportCreationDate INNER JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate INNER JOIN jobs on jobs.jobId = passport.jobId WHERE agentcomission.agentEmail = '$agentEmail' AND ticket.flightDate < '$today' AND jobs.creditType = 'Comission'");
$result_expense = $conn -> query("SELECT passport.fName, passport.lName, passport.passportNum, passport.creationDate, candidateexpense.amount, candidateexpense.purpose, candidateexpense.payDate,candidateexpense.payMode, candidateexpense.expenseId from candidateexpense INNER JOIN passport on passport.passportNum = candidateexpense.passportNum AND passport.creationDate = candidateexpense.passportCreationDate where candidateexpense.agentEmail = '$agentEmail'");
$totalExpense = 0;
$totalComission = 0;
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .custom-round-button{
        display: inline-block;
        border: 1px black solid;
        padding: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        outline:none;
    }
    .custom-round-button:focus {
        outline: none;
    }
    .custom-span{
        display: grid;
        justify-content: center;
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

                        <input type="hidden" name="agentEmail" id="agentEmail">
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
    <div class="card-header">
        <div class="section-header">
            <h3>Payment information of <span><b><?php echo "'".$agentName['agentName']."'";?></b></span></h3>
        </div>
    </div>        
    <div class="card w-100">    
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover text-center"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Candidate Name</th>  
                        <th>Passport Number/NID</th>  
                        <th>Purpose</th>  
                        <th>Amount</th>  
                        <th>Payment Date</th>  
                        <th>Alter</th>  
                    </tr>
                    </thead>
                    <!-- Comission and Advance -->
                    <?php
                    $i = 2;
                    if(!is_null($result_comission)){
                        while( $comission = mysqli_fetch_assoc($result_comission) ){ ?> 
                            <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                                <td><?php echo $comission['fName']." ".$comission['lName'];?></td>
                                <td><a href="?page=listCandidate&pp=<?php echo base64_encode($comission['passportNum']); ?>&cd=<?php echo base64_encode($comission['creationDate']); ?>"><?php echo $comission['passportNum'];?></a></td>
                                <td> Comission </td>
                                <td>
                                <div>
                                    <?php 
                                    echo number_format($comission['amount']);
                                    $totalComission += (int)$comission['amount'];
                                    ?>
                                </td>
                                <td> - </td>
                                <td>
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">                                                
                                            <button class="btn btn-sm btn-primary" type='button' data-target="#comissionAmount" data-toggle="modal" onclick="comissionAmount(this.value)" value="<?php echo $comission['comissionId']."_".$comission['passportNum']."_".$comission['creationDate']."_".$agentEmail; ?>"><span class="fa fa-edit" aria-hidden="true"></span></button>
                                        </div>
                                        <div class="col-md-2">
                                            <form action="template/editCandidateQry.php" method="post">
                                                <input type="hidden" name="alter" value="delete">
                                                <input type="hidden" value="editCandidate" name="pagePost">
                                                <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                                <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                                <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Advance Comission -->
                            <?php 
                            $comissionAdvance = $conn->query("SELECT payDate, advanceAmount from advance where comissionId = ".$comission['comissionId']);
                            if(!is_null($comissionAdvance)){
                                while($advance = mysqli_fetch_assoc($comissionAdvance)){
                            ?>
                                <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                                    <td><?php echo $comission['fName']." ".$comission['lName'];?></td>
                                    <td><a href="?page=listCandidate&pp=<?php echo base64_encode($comission['passportNum']); ?>&cd=<?php echo base64_encode($comission['creationDate']); ?>"><?php echo $comission['passportNum'];?></a></td>
                                    <td> Advance </td>
                                    <td>
                                    <?php 
                                    echo number_format($advance['advanceAmount']);
                                    $totalExpense += (int)$advance['advanceAmount'];
                                    ?></td>
                                    <td><?php echo $advance['payDate'];?></td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-md-2">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="alter" value="update">
                                                    <input type="hidden" value="editCandidate" name="pagePost">
                                                    <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                                    <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                                    <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></></button>
                                                </form>
                                            </div>
                                            <div class="col-md-2">
                                                <form action="template/editCandidateQry.php" method="post">
                                                    <input type="hidden" name="alter" value="delete">
                                                    <input type="hidden" value="editCandidate" name="pagePost">
                                                    <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                                    <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                                    <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                            } ?>
                    <?php $i++; 
                        } 
                    }?>
                    <!-- Candidate Expense -->
                    <?php
                    while( $candidates = mysqli_fetch_assoc($result_expense) ){   
                    ?>
                        <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                            <td><?php echo $candidates['fName']." ".$candidates['lName'];?></td>
                            <td><a href="?page=listCandidate&pp=<?php echo base64_encode($candidates['passportNum']); ?>&cd=<?php echo base64_encode($candidates['creationDate']); ?>"><?php echo $candidates['passportNum'];?></a></td>
                            <td> <?php echo $candidates['purpose'];?> </td>
                            <td>
                            <?php 
                            echo number_format($candidates['amount']);
                            $totalExpense += (int)$candidates['amount'];
                            ?></td>
                            <td> <?php echo $candidates['payDate'];?> </td>
                            <td>
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="redir" value="<?php echo "showAgentExpenseList&ag=".base64_encode($agentEmail); ?>">
                                            <input type="hidden" name="pagePost" value="editCandidatePayment">
                                            <input type="hidden" name="candidateName" value="<?php echo $candidates['fName']." ".$candidates['lName'];?>">
                                            <input type="hidden" name="passport_info" value="<?php echo $candidates['passportNum']."_".$candidates['creationDate'];?>">
                                            <input type="hidden" name="agentEmail" value="<?php echo $agentEmail;?>">
                                            <input type="hidden" name="expenseId" value="<?php echo $candidates['expenseId'];?>">
                                            <input type="hidden" name="purpose" value="<?php echo $candidates['purpose'];?>">
                                            <input type="hidden" name="amount" value="<?php echo $candidates['amount'];?>">
                                            <input type="hidden" name="payMode" value="<?php echo $candidates['payMode'];?>">
                                            <input type="hidden" name="payDate" value="<?php echo $candidates['payDate'];?>">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></></button>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <form action="template/addCandidatePaymentQry.php" method="post">
                                            <input type="hidden" name="redir" value="<?php echo "showAgentExpenseList&ag=".base64_encode($agentEmail); ?>">
                                            <input type="hidden" name="alter" value="delete">                                        
                                            <input type="hidden" name="passport_info" value="<?php echo $candidates['passportNum']."_".$candidates['creationDate'];?>">
                                            <input type="hidden" name="expenseId" value="<?php echo $candidates['expenseId'];?>">
                                            <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $i++; 
                    } ?>
                    <!-- Agent Expense -->
                    <?php
                    while( $agent = mysqli_fetch_assoc($result_agent_expense) ){   
                    ?>
                        <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                            <td> <?php echo $agent['candidateName'];?> </td>
                            <td> <?php 
                            if($agent['candidateNID'] != ''){
                                echo $agent['candidateNID']." (NID)";
                            }else if($agent['candidateBirthNumber'] != ''){
                                echo $agent['candidateBirthNumber']." (Birth)";
                            }else{
                                echo ' - ';
                            } ?> </td>
                            <td> <?php echo $agent['expensePurposeAgent'];?> </td>
                            <td>
                            <?php 
                            echo number_format($agent['fullAmount']);
                            $totalExpense += (int)$agent['fullAmount'];
                            ?></td>
                            <td> <?php echo $agent['payDate'];?> </td>
                            <td>
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <form action="index.php" method="post">
                                            <input type="hidden" value="editAgentExpense" name="pagePost">
                                            <input type="hidden" value="<?php echo $agent['agentExpenseId']; ?>" name="agentExpenseId">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></></button>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <form action="template/addExpenseAgentQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" name="agentEmail" value="<?php echo $agentEmail;?>">
                                            <input type="hidden" value="<?php echo $agent['agentExpenseId']; ?>" name="agentExpenseId">
                                            <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Candidate Name</th>  
                        <th>Passport Number</th>  
                        <th>Expense</th>  
                        <th>Comission</th>
                        <th>Payment Date</th>  
                        <th>Alter</th>  
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header text-center">
                    Total Expense Amount
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><?php echo number_format($totalExpense)." Taka";?></p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header text-center">
                    Total Comission Amount
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><?php echo number_format($totalComission)." Taka";?></p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header text-center">
                    Remaining Balance
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><?php echo number_format($totalComission - $totalExpense)." Taka";?></p>
                </div>
            </div>
        </div>
    </div>        
</div>

<script>
    $('#agentNav').addClass('active');
    function comissionAmount(info){
        let info_split = info.split('_');
        $('#comissionId').val(info_split[0]);
        $('#passportNum').val(info_split[1]);
        $('#creationDate').val(info_split[2]);
        $('#agentEmail').val(info_split[3]);
    }
</script>