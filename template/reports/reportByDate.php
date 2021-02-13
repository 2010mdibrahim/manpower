<?php
$reportType = $_GET['reportType'];
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report by Date</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <?php if($reportType == 'employee'){ ?>
                <input type="hidden" value="employeeReportTable" name="pagePost">
            <?php }else if($reportType == 'mofa'){ ?>
                <input type="hidden" value="mofaReportTable" name="pagePost">
            <?php } ?>
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