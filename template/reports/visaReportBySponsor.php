<?php
$by = $_GET['by'];
$qry = "select sponsorId, sponsorName from sponsor";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" value="visaSponsorReport" name="pagePost">
            <input type="hidden" name="reportType" value="reportBySponsor">
            <input type="hidden" value="<?php echo $by; ?>" name="by">
            <label for="sel1">Select Expense:</label>
            <select class="form-control" id="sponsorId" name="sponsorId">
                <option>Expenses Name</option>
                <?php while($sponsor = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $sponsor['sponsorId']; ?>"><?php echo $sponsor['sponsorName']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <input type="submit" value="Search">
</div>
</form>
</div>