<?php
$expenseId = $_POST['expenseId'];
$expense = mysqli_fetch_assoc($conn->query("SELECT * from expense where expenseId = $expenseId"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Expense</h2>
    </div>
    <form action="template/newExpenseQry.php" method="post">
        <input type="hidden" name="expenseId" value="<?php echo $expenseId?>">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <label for="sel1">Purpose:</label>
            <input class="form-control" type="text" name="purpose" value="<?php echo $expense['purpose'];?>" required>
            <!-- <select class="form-control" id="expenseName" name="expenseName">
                <option>Select Expense Type</option>
                <?php while($expensehead = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $expensehead['expenseheadId'];?>"><?php echo $expensehead['expenseName']; ?></option>
                <?php } ?>
            </select> -->
        </div>
        <br>
        <h3 style="background-color: aliceblue; padding: 0.5%">Expense information</h3>
        <div class="form-group">
            <div class="form-group">
                <label for="sel1">Enter Amount:</label>
                <input class="form-control" type="number" name="amount" value="<?php echo $expense['amount'];?>" required>
            </div>
            <br>
            <div class="form-group">
                <div class="form-row">
                    <div class="from-group col-md-6">                
                        <label for="sel1">Advance:</label>
                        <input class="form-control" type="number" name="advance" value="<?php echo $expense['advance'];?>">
                    </div>
                    <div class="from-group col-md-6">                
                        <label for="sel1">Paydate:</label>
                        <input class="form-control" type="date" name="payDate" value="<?php echo $expense['payDate'];?>">
                    </div>
                </div>
            </div>        
            <div class="form-group">
                <label for="sel1">Remark:</label>
                <input class="form-control" type="text" name="remark" value="<?php echo $expense['comment'];?>">
            </div>
            <br>
            <input class="form-control" type="submit" value="Update" style="width:auto; margin: auto">
        </div>
</form>
</div>