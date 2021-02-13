<?php
$qry = "select * from expenseheader";
$result = mysqli_query($conn,$qry);

?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Expense</h2>
    </div>
    <form action="template/newExpenseQry.php" method="post">
        <div class="form-group">
            <input type="hidden" value="insert" name="alter">
            <label for="sel1">Select Type of Expense:</label>
            <select class="form-control" id="expenseName" name="expenseName">
                <option>Select Expense Type</option>
                <?php while($expensehead = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $expensehead['expenseheadId'];?>"><?php echo $expensehead['expenseName']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <h3 style="background-color: aliceblue; padding: 0.5%">Expense information</h3>
        <div class="form-group flex-container"">
        <br>
        <div >
            <label for="sel1">Enter Amount:</label>
            <input class="form-control" type="number" name="amount" placeholder="BDT">
        </div>
        <br>
        <div >
            <label for="sel1">Receipt Date:</label>
            <input class="form-control" type="date" name="date">
        </div>
        <br>
        <div class="form-group">
            <label for="sel1">Paymode: </label>
            <select class="form-control" id="paymode" name="paymode">
                <option>Select Paymode</option>
                <option>Cash</option>
                <option>Cheque</option>
            </select>
        </div>
        <br>
        <div >
            <label for="sel1">Remark:</label>
            <input class="form-control" type="text" name="remark" placeholder="Any Remark....">
        </div>
        <br>
        <input type="submit" value="Add">
</div>
</form>
</div>