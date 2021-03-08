<?php
if(isset($_GET['ag'])){
    $agentEmail = base64_decode($_GET['ag']);
    $agentName = mysqli_fetch_assoc($conn -> query("SELECT agentName from agent where agentEmail = '$agentEmail'"));
}else{
    $agentEmail = '';
}
$totalAmount = mysqli_fetch_assoc($conn->query("SELECT SUM(fullAmount) as fullSum from agentexpense where agentEmail = '$agentEmail'"));
$lendAmount = mysqli_fetch_assoc($conn->query("SELECT SUM(fullAmount) as fullSum, SUM(paidAmount) as paidSum from agentexpense where agentEmail = '$agentEmail' AND expenseMode = 'lend'"));
$result = $conn -> query("SELECT * from agentexpense where agentEmail = '$agentEmail'");

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
        <div class="card-group">
            <div class="card">
                <div class="card-header text-center">
                    Total Amount
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><?php echo number_format($totalAmount['fullSum'])." Taka";?></p>
                </div>
            </div>
        </div>
        <div class="card w-100">    
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableSeaum" class="table table-bordered table-hover text-center"  style="width:100%">
                        <thead>
                        <tr>
                            <th>Amount</th>  
                            <th>Expense Purpose</th>
                            <th>Pay Date</th>
                            <th>Pay Mode</th>
                            <th>Comment</th> 
                            <th>Alter</th>
                        </tr>
                        </thead>
                        <?php
                        while( $expense = mysqli_fetch_assoc($result) ){                
                        ?>
                            <tr>
                                <td><?php echo number_format($expense['fullAmount']);?></td>
                                <td><?php echo $expense['expensePurposeAgent'];?></td>
                                <td><?php echo $expense['payDate'];?></td>
                                <td><?php echo $expense['expenseMode'];?></td>
                                <td><?php echo $expense['comment'];?></td>
                                <td>
                                    <div class="flex-container">
                                        <div style="padding-right: 2%" >
                                            <form action="index.php" method="post">
                                                <input type="hidden" name="alter" value="update">
                                                <input type="hidden" value="editAgentExpense" name="pagePost">
                                                <input type="hidden" value="<?php echo $expense['agentExpenseId']; ?>" name="agentExpenseId">
                                                <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                            </form>
                                        </div>
                                        <div style="padding-left: 2%">
                                            <form action="template/addExpenseAgentQry.php" method="post">
                                                <input type="hidden" name="alter" value="delete">
                                                <input type="hidden" value="<?php echo $expense['agentExpenseId']; ?>" name="agentExpenseId">
                                                <input type="hidden" value="<?php echo $expense['agentEmail']; ?>" name="agentEmail">
                                                <button type="submit" class="btn btn-danger btn-sm" name="manpower">Delete</></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <tfoot>
                        <tr hidden>
                            <th>Amount</th>  
                            <th>Expense Purpose</th>
                            <th>Pay Date</th>
                            <th>Pay Mode</th>
                            <th>Comment</th> 
                            <th>Alter</th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
        
</div>

<script>
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>






