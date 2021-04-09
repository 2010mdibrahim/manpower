<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Employee", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Employee</h2>
    </div>
    <form action="template/newEmployeeQry.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Employee Name</label>
                <input class="form-control" type="text" name="name" placeholder="Enter Employee Name">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Employee Office ID</label>
                <input class="form-control" type="text" name="officeId" placeholder="Enter Employee Office ID">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Employee Mobile Number</label>
                <input class="form-control" type="text" name="mobNum" placeholder="Enter Employee Mobile Number">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Employee Address</label>
                <input class="form-control" type="text" name="address" placeholder="Enter Employee Address">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Employee Designation</label>
                <input class="form-control" type="text" name="empDesignation" placeholder="Enter Employee Designation">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Employee Access</label>
                <select class="form-control select2" name="empAccess[]" multiple required>
                    <?php $result = $conn->query("SELECT * from sections");
                    while($section = mysqli_fetch_assoc($result)){
                    ?>
                        <option value="<?php echo $section['sectionId'];?>"><?php echo $section['sectionName'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">Password</label>
                <input class="form-control" type="text" name="password" id="password">
            </div>
        </div>
        <div class="form-row justify-content-md-center">
            <input type="submit" class="btn" value="Submit" style="font-size: 15px;">
        </div>
    </form>
</div>
<script>
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
    var randomPassword = '';
    for (i = 0; i < 10; i++) {
        randomPassword = randomPassword + chars.charAt(
            Math.floor(Math.random() * chars.length)
        );
    }
    $('#password').val(randomPassword);
    $('#employeeNav').addClass('active');
</script>