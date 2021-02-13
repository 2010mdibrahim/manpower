<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Create Company</h2>
    </div>
    <?php
        if(!empty($_POST['alter'])){
            $companyId = $_POST['companyId'];
            $qry = "select companyName, remark from company where companyId = $companyId";
            $result = mysqli_query($conn,$qry);
            $company = mysqli_fetch_assoc($result);
    ?>
        <form action="template/admin/createCompanyQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="companyId" value="<?php echo $companyId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Company Name</label>
                    <input class="form-control" type="text" name="companyName" value="<?php echo $company['companyName'];?>">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" value="<?php echo $company['remark'];?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
    <?php }else{ ?>
        <form action="template/admin/createCompanyQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Company Name</label>
                    <input class="form-control" type="text" name="companyName" placeholder="Enter Company Name">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" placeholder="Write Remark">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Add">
    <?php } ?>
</div>
</form>
</div>