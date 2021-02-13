<div class="container" style="padding: 2%">

    <?php
    if(!empty($_POST['alter'])){
    $branchId = $_POST['branchId'];
    $qry = "select branchName, remark from branch where branchId = $branchId";
    $result = mysqli_query($conn,$qry);
    $branch = mysqli_fetch_assoc($result);
    ?>
    <div class="section-header">
        <h2>Update Branch</h2>
    </div>
    <form action="template/admin/createBranchQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="branchId" value="<?php echo $branchId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Branch Name</label>
                    <input class="form-control" type="text" name="branchName" value="<?php echo $branch['branchName'];?>">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" value="<?php echo $branch['remark'];?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
        <?php }else{ ?>
        <div class="section-header">
            <h2>Create Branch</h2>
        </div>
        <form action="template/admin/createBranchQry.php" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <label>Branch Name</label>
                        <input class="form-control" type="text" name="branchName" placeholder="Enter Branch Name">
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