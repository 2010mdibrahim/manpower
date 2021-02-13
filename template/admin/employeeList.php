<?php
$qry = "select companyId, companyName from company";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Select Visa</h2>
    </div>
    <form action="index.php" method="post">
        <input type="hidden" value="companyEmployeeList" name="pagePost">
        <div class="form-group">
            <label for="sel1">Select Visa:</label>
            <select class="form-control" id="companyId" name="companyId">
                <option>Select Company</option>
                <?php while($company = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $company['companyId']; ?>"><?php echo $company['companyName']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <input type="submit" value="search">
</div>
</form>
</div>