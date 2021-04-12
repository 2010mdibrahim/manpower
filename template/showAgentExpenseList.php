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
$result_comission = $conn -> query("SELECT jobs.creditType, agentcomission.amount, passport.fName, passport.lName, ticket.flightDate FROM agentcomission INNER JOIN passport on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentcomission.passportCreationDate INNER JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate INNER JOIN jobs on jobs.jobId = passport.jobId WHERE agentcomission.agentEmail = '$agentEmail' AND ticket.flightDate < '$today' AND jobs.creditType = 'Comission'");
$result_pass = $conn -> query("SELECT passport.fName, passport.lName, passport.passportNum, passport.creationDate, candidateexpense.amount from candidateexpense INNER JOIN passport on passport.passportNum = candidateexpense.passportNum AND passport.creationDate = candidateexpense.passportCreationDate where candidateexpense.agentEmail = '$agentEmail'");
print_r(mysqli_error($conn));
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
                        <th>Expense</th>  
                        <th>Comission</th>
                    </tr>
                    </thead>
                    <?php
                    if(!is_null($result_comission)){
                        while( $candidates = mysqli_fetch_assoc($result_comission) ){ ?> 
                        <tr>
                            <td><?php echo $candidates['fName']." ".$candidates['lName'];?></td>
                            <td> - </td>
                            <td>
                            <?php 
                            echo number_format($candidates['amount']);
                            $totalComission += (int)$candidates['amount'];
                            ?></td>
                        </tr>
                    <?php } 
                    }?>
                    <?php
                    while( $candidates = mysqli_fetch_assoc($result_pass) ){   
                    ?>
                        <tr>
                            <td><?php echo $candidates['fName']." ".$candidates['lName'];?></td>
                            <td>
                            <?php 
                            echo number_format($candidates['amount']);
                            $totalExpense += (int)$candidates['amount'];
                            ?></td>
                            <td> - </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Candidate Name</th>  
                        <th>Expense</th>  
                        <th>Comission</th>
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






