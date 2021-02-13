<?php
$by = $_GET['by'];
$qry = "select agentId, agentName from agent";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" value="candidateReport" name="pagePost">
            <input type="hidden" name="reportType" value="reportByMedical">
            <input type="hidden" value="<?php echo $by; ?>" name="by">
            <div class="row">
                <div class="col-md-12">
                    <label for="sel1">Select Stage:</label>
                    <select class="form-control" id="stage" name="stage">
                        <option>Select Stage</option>
                        <option>Medical</option>
                        <option>Emigration</option>
                        <option>Stamping</option>
                        <option>Ticket</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Search">
</div>
</form>
</div>