<?php
$companyId = $_POST['companyId'];
$qry = "select companyName from company where companyId = $companyId";
$result = mysqli_query($conn,$qry);
$companyName = mysqli_fetch_assoc($result);
$qry = "select departmentName from department 
            inner join hasdepartment on hasdepartment.departmentId = department.departmentId where hasdepartment.companyId = $companyId";
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
        $('#listTable').DataTable();
    });
</script>



<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>Company name is : '<?php echo $companyName['companyName'];?>'</h3>
    </div>
    <div class="table-responsive">
        <table id="listTable" class="table col-12"  style="text-align: center">
            <thead>
            <tr>
                <th>Department Name</th>
            </tr>
            </thead>
            <?php
            while( $department = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $department['departmentName'];?></td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Department Name</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>


