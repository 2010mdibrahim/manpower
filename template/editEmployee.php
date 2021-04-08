<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Employee", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$employeeId = $_POST['employeeId'];
$employee = mysqli_fetch_assoc($conn->query("SELECT * FROM employee where employeeId = $employeeId"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Employee</h2>
    </div>
        <form action="template/newEmployeeQry.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="alter" value="update">
            <input type="hidden" name="employeeId" value="<?php echo $employeeId?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Employee Name</label>
                    <input class="form-control" type="text" name="name" value="<?php echo $employee['employeeName'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Employee Mobile Number</label>
                    <input class="form-control" type="text" name="mobNum" value="<?php echo $employee['empMob'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Employee Address</label>
                    <input class="form-control" type="text" name="address" value="<?php echo $employee['empAddress'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Employee Designation</label>
                    <input class="form-control" type="text" name="empDesignation" value="<?php echo $employee['empDesignation'];?>">
                </div>
            </div>
            <div class="form-row justify-content-md-center">
                <input type="submit" class="btn" value="Update" style="font-size: 15px;">
            </div>
        </form>
</div>
<script>
    $('#employeeNav').addClass('active');
</script>