<?php
$qry = "select companyId, companyName from company";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Company wise Department</h3>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" name="pagePost" value="companyDepartmentListWithData">
            <div class="row">
                <div class="column col-md-6" >
                    <label for="sel1">Company:</label>
                    <select class="form-control" id="companyId" name="companyId">
                        <option>Select Company</option>
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