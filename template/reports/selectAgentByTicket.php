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
            <input type="hidden" value="agentReportWithTicket" name="pagePost">
            <input type="hidden" name="reportType" value="reportByTicket">
            <input type="hidden" value="<?php echo $by; ?>" name="by">
            <div class="row">
                <div class="col-md-12">
                    <label for="sel1">Select Agent:</label>
                    <select class="form-control" id="agentId" name="agentId">
                        <option>Select Agent Name</option>
                        <?php while($agent = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $agent['agentId']; ?>"><?php echo $agent['agentName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Search">
</div>
</form>
</div>