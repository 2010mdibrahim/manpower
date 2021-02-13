<?php
$by = $_POST['by'];
if($by == 'name'){
    $expenseHeadId = $_POST['expenseHead'];
    $qry = "SELECT expense.amount,expense.paymode,expense.date,expense.remark,expenseheader.expenseName,expense.expenseId,expenseheader.expenseheadId FROM expense 
            INNER JOIN expenseheader ON expense.expenseheadId=expenseheader.expenseheadId where expenseheader.expenseheadId = $expenseHeadId";
}else if($by == 'date'){
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $qry = "SELECT expense.amount,expense.paymode,expense.date,expense.remark,expenseheader.expenseName,expense.expenseId,expenseheader.expenseheadId FROM expense 
            INNER JOIN expenseheader ON expense.expenseheadId=expenseheader.expenseheadId where expense.date between '$dateFrom' and '$dateTo'";
}else{
    $expenseHeadId = $_POST['expenseHead'];
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $qry = "SELECT expense.amount,expense.paymode,expense.date,expense.remark,expenseheader.expenseName,expense.expenseId,expenseheader.expenseheadId FROM expense 
            INNER JOIN expenseheader ON expense.expenseheadId=expenseheader.expenseheadId where expenseheader.expenseheadId = $expenseHeadId and expense.date between '$dateFrom' and '$dateTo'";
}

$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $(document).ready(function() {
        $('#expenseTable').DataTable();
    } );
</script>

<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table class="table col-12" id="expenseTable" style="width:100%">
            <thead>
            <tr>
                <th>Expense Header</th>
                <th>Amount</th>
                <th>Issue Date</th>
                <th>Paymode</th>
                <th>Remark</th>
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
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Expense Header</th>
                <th>Amount</th>
                <th>Issue Date</th>
                <th>Paymode</th>
                <th>Remark</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

