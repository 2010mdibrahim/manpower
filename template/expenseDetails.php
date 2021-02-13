<?php
$qry = "SELECT expense.amount,expense.paymode,expense.date,expense.remark,expenseheader.expenseName,expense.expenseId,expenseheader.expenseheadId FROM expense 
            INNER JOIN expenseheader ON expense.expenseheadId=expenseheader.expenseheadId";
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
                <th>Expense Header</th>
                <th>Amount</th>
                <th>Issue Date</th>
                <th>Paymode</th>
                <th>Remark</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            while( $expense = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $expense['expenseName'];?></td>
                    <td><?php echo number_format($expense['amount']);?></td>
                    <td><?php echo $expense['date'];?></td>
                    <td><?php echo $expense['paymode'];?></td>
                    <td><?php echo $expense['remark'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" value="editExpense" name="pagePost">
                                    <input type="hidden" value="<?php echo $expense['expenseheadId']; ?>" name="expenseheadId">
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

