<?php
if(isset($_POST['agentEmail'])){
    $agentEmail = $_POST['agentEmail'];
    $agentName = mysqli_fetch_assoc($conn -> query("SELECT agentName from agent where agentEmail = '$agentEmail'"));
}else{
    $agentEmail = '';
}
$result = $conn -> query("SELECT * from agentexpense where agentEmail = '$agentEmail'");
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h3>Payment information of <span><b><?php echo "'".$agentName['agentName']."'";?></b></span></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Expense Purpose</th>
                        <th>Full Amount</th> 
                        <th>Paid Amount</th>                
                        <th>Due Amount</th>
                        <th>Pay Date</th>
                        <th>Comment</th> 
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    while( $expense = mysqli_fetch_assoc($result) ){                
                    ?>
                        <tr>
                            <td><?php echo $expense['expensePurposeAgent'];?></td>
                            <td><?php echo $expense['fullAmount'];?></td>
                            <td><?php echo $expense['paidAmount'];?></td>
                            <td><?php echo (intval($expense['fullAmount']) - intval($expense['paidAmount']));?></td>
                            <td>
                            <?php if($expense['payDate'] == '0000-00-00'){ ?>
                                        'No Date'
                            <?php   }else{ 
                                        echo $expense['payDate'];
                                    } ?>
                            </td>
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
                                        <form action="template/manpowerQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $expense['agentExpenseId ']; ?>" name="agentExpenseId ">
                                            <button type="submit" class="btn btn-danger btn-sm" name="manpower">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Expense Purpose</th>
                        <th>Full Amount</th> 
                        <th>Paid Amount</th>                
                        <th>Balance</th>
                        <th>Pay Date</th>
                        <th>Comment</th>
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






