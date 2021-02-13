<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Create Department</h2>
    </div>
    <?php
    if(!empty($_POST['alter'])){
    $salaryId = $_POST['salaryId'];
    $qry = "select salaryAmount, remark from salary where salaryId = $salaryId";
    $result = mysqli_query($conn,$qry);
    $salary= mysqli_fetch_assoc($result);
    ?>
    <form action="template/admin/createSalaryQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="salaryId" value="<?php echo $salaryId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Branch Name</label>
                    <input class="form-control" type="text" name="salaryAmount" value="<?php echo $salary['salaryAmount'];?>">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" value="<?php echo $salary['remark'];?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
        <?php }else{ ?>
        <form action="template/admin/createSalaryQry.php" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <label>Branch Name</label>
                        <input class="form-control" type="number" name="salaryAmount" placeholder="Enter Salary Amount">
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