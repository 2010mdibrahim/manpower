<?php
$qry = "select candidateId, fName, lName from candidate";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Transfer Visa</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" name="pagePost" value="transferVisaWithCandidate">
            <label for="sel1">Select Candidate:</label>
            <select class="form-control" id="candidateId" name="candidateId">
                <option>Select Candidate</option>
                <?php while($candidate = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $candidate['candidateId']; ?>"><?php echo $candidate['fName']." ".$candidate['lName']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <input type="submit" value="search">
</div>
</form>
</div>