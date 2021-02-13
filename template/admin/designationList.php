<?php
$qry = "select designationId, designationName, remark from designation";
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
        $('#salaryList').DataTable();
    });
</script>
<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table id="salaryList" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>Designation Name</th>
                <th>Remarks</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            while( $designation = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $designation['designationName'];?></td>
                    <td><?php echo $designation['remark'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editDesignation" name="pagePost">
                                    <input type="hidden" value="<?php echo $designation['designationId']; ?>" name="designationId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/admin/createDesignationQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $designation['designationId']; ?>" name="designationId">
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


