<?php
$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];
$qry = "SELECT employee.employeeName, employee.DOJ, employee.DOL, department.departmentName, designation.designationName, company.companyName from employee 
            INNER JOIN department on employee.departmentId=department.departmentId
                INNER JOIN designation on employee.designationId=designation.designationId
                    INNER JOIN company on employee.companyId = company.companyId where employee.DOJ between '$dateFrom' and '$dateTo'";
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
        $('#employeeList').DataTable();
    });
</script>
<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table id="employeeList" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>Employee Name</th>
                <th>Company Name</th>
                <th>Department Name</th>
                <th>Designation</th>
                <th>Joining Date</th>
                <th>Leaving Date</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            $zeroDate = "0000-00-00";
            while( $employee = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $employee['employeeName'];?></td>
                    <td><?php echo $employee['companyName'];?></td>
                    <td><?php echo $employee['departmentName'];?></td>
                    <td><?php echo $employee['designationName'];?></td>
                    <td><?php echo $employee['DOJ'];?></td>
                    <td><?php echo ($employee['DOL'] != $zeroDate) ? $employee['DOL'] : 'Currently Working';?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" value="<?php echo $companyId; ?>" name="companyId">
                                    <input type="hidden" value="<?php echo $employee['departmentId']; ?>" name="departmentId">
                                    <input type="hidden" value="<?php echo $employee['departmentName']; ?>" name="departmentName">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editEmployee" name="pagePost">
                                    <input type="hidden" value="<?php echo $employee['employeeId']; ?>" name="employeeId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/admin/addEmployeeQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $employee['employeeId']; ?>" name="employeeId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr>
                <th>Employee Name</th>
                <th>Company Name</th>
                <th>Department Name</th>
                <th>Designation</th>
                <th>Joining Date</th>
                <th>Leaving Date</th>
                <th>Alter</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


