<?php
$qry = "select branchId, branchName, remark from branch";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $('document').ready(function() {
        $('#companyList').DataTable();
    });
</script>
<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table id="companyList" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>department Name</th>
                <th>Remarks</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            while( $branch = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $branch['branchName'];?></td>
                    <td><?php echo $branch['remark'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editBranch" name="pagePost">
                                    <input type="hidden" value="<?php echo $branch['branchId']; ?>" name="branchId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/admin/createBranchQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $branch['branchId']; ?>" name="branchId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr>
                <th>Company Name</th>
                <th>Remarks</th>
                <th>Edit</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>


