<?php
$by = $_GET['by'];
$qry = "select * from expenseheader";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" value="expenseReport" name="pagePost">
            <input type="hidden" name="reportType" value="reportByNameDate">
            <input type="hidden" value="<?php echo $by; ?>" name="by">
            <div class="row">
                <div class="col-md-12">
                    <label for="sel1">Select Expense:</label>
                    <select class="form-control" id="expenseHead" name="expenseHead">
                        <option>Expenses Name</option>
                        <?php while($expenseHeader = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $expenseHeader['expenseheadId']; ?>"><?php echo $expenseHeader['expenseName']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                </div>
                <div class="col-md-4">
                    <label for="dateFrom">From:</label>
                    <input type="date" name="dateFrom">
                </div>
                <div class="col-md-4">
                    <label for="dateTo">to:</label>
                    <input type="date" name="dateTo">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Search">
</div>
</form>
</div>