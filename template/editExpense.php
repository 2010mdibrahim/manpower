<?php
$expenseId = $_POST['expenseId'];
$expenseheadId = $_POST['expenseheadId'];
$qry = "select * from expenseheader where expenseheadId = $expenseheadId";
$result = mysqli_query($conn,$qry);
$expensehead = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Edit Expense</h2>
    </div>
    <form action="template/newExpenseQry.php" method="post">
        <div class="form-group">
            <input type="hidden" value="update" name="alter">
            <input type="hidden" value="<?php echo $expenseId;?>" name="expenseId">
            <label for="sel1">Select Type of Expense:</label>
            <select class="form-control" id="expenseName" name="expenseName">
                <option value="<?php echo $expensehead['expenseheadId'];?>"><?php echo $expensehead['expenseName']; ?></option>
                <?php
                $qry = "select * from expenseheader where expenseheadId != $expenseheadId";
                $result = mysqli_query($conn,$qry);
                while($expensehead = mysqli_fetch_assoc($result)){
                ?>
                    <option value="<?php echo $expensehead['expenseheadId'];?>"><?php echo $expensehead['expenseName']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <?php
        $qry = "select * from expense where expenseId = $expenseId";
        $result = mysqli_query($conn,$qry);
        $expense = mysqli_fetch_assoc($result);
        ?>
        <h3 style="background-color: aliceblue; padding: 0.5%">Expense information</h3>
        <div class="form-group flex-container"">
        <br>
        <div >
            <label for="sel1">Enter Amount:</label>
            <input class="form-control" type="number" name="amount" value="<?php echo $expense['amount'];?>">
        </div>
        <br>
        <div >
            <label for="sel1">Receipt Date:</label>
            <input class="form-control" type="date" name="date" value="<?php echo $expense['date'];?>">
        </div>
        <br>
        <div class="form-group">
            <label for="sel1">Paymode: </label>
            <select class="form-control" id="paymode" name="paymode">
                <?php if($expense['paymode'] == 'Cash'){ ?>
                    <option>Cash</option>
                    <option>Cheque</option>
                <?php }else{ ?>
                    <option>Cheque</option>
                    <option>Cash</option>
                <?php } ?>
            </select>
        </div>
        <br>
        <div >
            <label for="sel1">Remark:</label>
            <input class="form-control" type="text" name="remark" value="<?php echo $expense['remark'];?>">
        </div>
        <br>
        <input type="submit" value="Update">
</div>
</form>
</div>