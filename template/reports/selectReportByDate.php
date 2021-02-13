<?php
$by = $_GET['by'];
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report by Date</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" value="expenseReport" name="pagePost">
            <input type="hidden" name="reportType" value="reportByDate">
            <input type="hidden" value="<?php echo $by; ?>" name="by">

            <div class="row">
                <div class="col-sm">
                    <label for="dateFrom">From:</label>
                    <input type="date" name="dateFrom">
                </div>
                <div class="col-sm">
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