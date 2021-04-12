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
$result_agent_expense = $conn -> query("SELECT fullAmount, expensePurposeAgent, date(creationDate) as creationDate FROM agentexpense WHERE agentEmail = '$agentEmail'");
$result_comission = $conn -> query("SELECT jobs.creditType, agentcomission.amount, agentcomission.comissionId, passport.fName, passport.lName, ticket.flightDate FROM agentcomission INNER JOIN passport on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentcomission.passportCreationDate INNER JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate INNER JOIN jobs on jobs.jobId = passport.jobId WHERE agentcomission.agentEmail = '$agentEmail' AND ticket.flightDate < '$today' AND jobs.creditType = 'Comission'");
$result_expense = $conn -> query("SELECT passport.fName, passport.lName, passport.passportNum, passport.creationDate, candidateexpense.amount, candidateexpense.purpose, candidateexpense.payDate from candidateexpense INNER JOIN passport on passport.passportNum = candidateexpense.passportNum AND passport.creationDate = candidateexpense.passportCreationDate where candidateexpense.agentEmail = '$agentEmail'");
$totalExpense = 0;
$totalComission = 0;
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    
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
                        <th>Purpose</th>  
                        <th>Amount</th>  
                        <th>Payment Date</th>  
                    </tr>
                    </thead>
                    <!-- Comission and Advance -->
                    <?php
                    $i = 2;
                    if(!is_null($result_comission)){
                        while( $comission = mysqli_fetch_assoc($result_comission) ){ ?> 
                            <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                                <td><?php echo $comission['fName']." ".$comission['lName'];?></td>
                                <td> Comission </td>
                                <td>
                                <?php 
                                echo number_format($comission['amount']);
                                $totalComission += (int)$comission['amount'];
                                ?></td>
                                <td> - </td>
                            </tr>
                            <?php 
                            $comissionAdvance = $conn->query("SELECT payDate, advanceAmount from advance where comissionId = ".$comission['comissionId']);
                            if(!is_null($comissionAdvance)){
                                while($advance = mysqli_fetch_assoc($comissionAdvance)){
                            ?>
                                <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                                    <td><?php echo $comission['fName']." ".$comission['lName'];?></td>
                                    <td> Advance </td>
                                    <td>
                                    <?php 
                                    echo number_format($advance['advanceAmount']);
                                    $totalExpense += (int)$advance['advanceAmount'];
                                    ?></td>
                                    <td><?php echo $advance['payDate'];?></td>
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
                            <td> <?php echo $candidates['purpose'];?> </td>
                            <td>
                            <?php 
                            echo number_format($candidates['amount']);
                            $totalExpense += (int)$candidates['amount'];
                            ?></td>
                            <td> <?php echo $candidates['payDate'];?> </td>
                        </tr>
                    <?php $i++; 
                    } ?>
                    <!-- Agent Expense -->
                    <?php
                    while( $agent = mysqli_fetch_assoc($result_agent_expense) ){   
                    ?>
                        <tr <?php echo (fmod($i, 2) == 0) ? 'style="background-color: #e0e0e0"' : '';?>>
                            <td>Self</td>
                            <td> <?php echo $agent['expensePurposeAgent'];?> </td>
                            <td>
                            <?php 
                            echo number_format($agent['fullAmount']);
                            $totalExpense += (int)$agent['fullAmount'];
                            ?></td>
                            <td> <?php echo $agent['creationDate'];?> </td>
                        </tr>
                    <?php $i++;
                    } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Candidate Name</th>  
                        <th>Expense</th>  
                        <th>Comission</th>
                        <th>Payment Date</th>  
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
</script>






