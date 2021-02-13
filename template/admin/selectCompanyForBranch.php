<?php
$qry = "select companyId, companyName from company";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h3>Branch list company wise</h3>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" name="pagePost" value="companyBranchListWithData">
            <div class="row">
                <div class="column col-md-6" >
                    <label for="sel1">Select Company:</label>
                    <select class="form-control" id="companyId" name="companyId">
                        <option>Company Name</option>
                        <?php while($company = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $company['companyId'];?>"><?php echo $company['companyName']; ?></option>
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