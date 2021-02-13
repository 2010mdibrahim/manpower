<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Create Department</h2>
    </div>
    <?php
    if(!empty($_POST['alter'])){
    $designationId = $_POST['designationId'];
    $qry = "select designationName, remark from designation where designationId = $designationId";
    $result = mysqli_query($conn,$qry);
    $designation = mysqli_fetch_assoc($result);
    ?>
    <form action="template/admin/createDesignationQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="designationId" value="<?php echo $designationId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Profession Name</label>
                    <input class="form-control" type="text" name="designationName" value="<?php echo $designation['designationName'];?>">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" value="<?php echo $designation['remark'];?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
        <?php }else{ ?>
        <form action="template/admin/createDesignationQry.php" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <label>Enter New Designation</label>
                        <input class="form-control" type="text" name="designationName" placeholder="Enter Designation Name">
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