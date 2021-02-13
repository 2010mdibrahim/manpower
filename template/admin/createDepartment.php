<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Create Department</h2>
    </div>
    <?php
    if(!empty($_POST['alter'])){
    $departmentId = $_POST['departmentId'];
    $qry = "select departmentName, remark from department where departmentId = $departmentId";
    $result = mysqli_query($conn,$qry);
    $department = mysqli_fetch_assoc($result);
    ?>
    <form action="template/admin/createDepartmentQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="departmentId" value="<?php echo $departmentId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Department Name</label>
                    <input class="form-control" type="text" name="departmentName" value="<?php echo $department['departmentName'];?>">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" value="<?php echo $department['remark'];?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
        <?php }else{ ?>
        <form action="template/admin/createDepartmentQry.php" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <label>Department Name</label>
                        <input class="form-control" type="text" name="departmentName" placeholder="Enter Department Name">
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