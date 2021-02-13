<?php
$companyId = $_POST['companyId'];
$qry = "select companyName from company where companyId = $companyId";
$result = mysqli_query($conn,$qry);
$companyName = mysqli_fetch_assoc($result);
$qry = "select branch.branchId, branch.branchName, branch.remark from branch 
            inner join hasbranch on hasbranch.branchId = branch.branchId where hasbranch.companyId = $companyId";
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
    <div class="section-header">
    <h3>Company name is : '<?php echo $companyName['companyName'];?>'</h3>
    </div>
    <div class="table-responsive">
        <table id="companyList" class="table col-12"  style="width:100%; text-align: center">
            <thead>
            <tr>
                <th>Branch Name</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <?php
            while( $branch = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $branch['branchName'];?></td>
                    <td><?php echo $branch['remark'];?></td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr hidden>
                <th>Company Name</th>
                <th>Remarks</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>


