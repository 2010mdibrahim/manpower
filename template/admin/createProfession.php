<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Create Department</h2>
    </div>
    <?php
    if(!empty($_POST['alter'])){
    $professionId = $_POST['professionId'];
    $qry = "select professionName, remark from profession where professionId = $professionId";
    $result = mysqli_query($conn,$qry);
    $profession = mysqli_fetch_assoc($result);
    ?>
    <form action="template/admin/createProfessionQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="professionId" value="<?php echo $professionId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Profession Name</label>
                    <input class="form-control" type="text" name="professionName" value="<?php echo $profession['professionName'];?>">
                </div>
                <div class="column col-md-6" >
                    <label>Any Remark</label>
                    <input class="form-control" type="text" name="remark" value="<?php echo $profession['remark'];?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
        <?php }else{ ?>
        <form action="template/admin/createProfessionQry.php" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <label>Profession Name</label>
                        <input class="form-control" type="text" name="professionName" placeholder="Enter Profession Name">
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