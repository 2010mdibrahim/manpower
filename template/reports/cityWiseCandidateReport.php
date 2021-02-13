<?php
$qry = "select city from candidate group by city";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" value="cityWiseCandidateReportWithData" name="pagePost">
            <input type="hidden" name="reportType" value="reportByTicket">
            <div class="row">
                <div class="col-md-12">
                    <label for="sel1">Cities:</label>
                    <select class="form-control" id="candidateCity" name="candidateCity">
                        <option>Select City Name</option>
                        <?php while($city = mysqli_fetch_assoc($result)){ ?>
                            <option><?php echo $city['city']; ?></option>
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