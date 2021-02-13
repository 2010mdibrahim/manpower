<?php
$qry = "select salaryId, salaryAmount, remark from salary";
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
                <th>Salary Amount</th>
                <th>Remarks</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            while( $salary = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $salary['salaryAmount'];?></td>
                    <td><?php echo $salary['remark'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editSalary" name="pagePost">
                                    <input type="hidden" value="<?php echo $salary['salaryId']; ?>" name="salaryId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/admin/createSalaryQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $salary['salaryId']; ?>" name="salaryId">
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


