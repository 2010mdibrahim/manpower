<?php
$qry = "select * from expenseheader";
$result = mysqli_query($conn,$qry);

?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Expense</h2>
    </div>
    <form action="template/newExpenseQry.php" method="post">
        
        <input type="hidden" value="insert" name="alter">

        <div class="form-group">
            <label for="sel1">Purpose:</label>
            <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose" required>
        </div>

        <h3 style="background-color: aliceblue; padding: 0.5%">Expense information</h3>
        <div class="form-group">
            <div class="form-group">
                <label for="sel1">Enter Amount:</label>
                <input class="form-control" type="number" name="amount" placeholder="BDT" required>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="from-group col-md-6">                
                        <label for="sel1">Advance:</label>
                        <input class="form-control" type="number" name="advance" placeholder="Enter Amount">
                    </div>
                    <div class="from-group col-md-6">                
                        <label for="sel1">Paydate:</label>
                        <input class="form-control" type="date" name="payDate">
                    </div>
                </div> 
            </div>                 
            <div class="form-group">
                <label for="sel1">Remark:</label>
                <input class="form-control" type="text" name="remark" placeholder="Any Remark....">
            </div>
            <div class="form-group">
                <input class="form-control" type="submit" value="Add" style="width:auto; margin: auto">
            </div>
            
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        $('#expenseNav').addClass('active');
    };
</script>