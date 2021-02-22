<?php
$qry = "SELECT * from expense order by creationDate";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>

<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>Expense Details</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12" style="width:100%">
            <thead>
            <tr>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Advance</th>                
                <th>Balance</th>
                <th>Pay Date</th>
                <th>Comment</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            while( $expense = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $expense['purpose'];?></td>
                    <td><?php echo number_format($expense['amount']);?></td>
                    <td><?php echo $expense['advance'];?></td>
                    <td><?php echo (intval($expense['amount']) - intval($expense['advance']));?></td>
                    <td><?php
                    if($expense['payDate'] == '0000-00-00'){
                        echo 'No Date';
                    }else{
                        echo $expense['payDate'];
                    }
                     
                    ?></td>
                    <td><?php echo $expense['comment'];?></td>                    
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" value="editExpense" name="pagePost">
                                    <input type="hidden" value="<?php echo $expense['expenseId']; ?>" name="expenseId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/newExpenseQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $expense['expenseId']; ?>" name="expenseId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Expense Header</th>
                <th>Amount</th>
                <th>Issue Date</th>
                <th>Paymode</th>
                <th>Remark</th>
                <th>Alter</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>


<script>
    window.onload = function() {
        $('#expenseNav').addClass('active');
    };
</script>
