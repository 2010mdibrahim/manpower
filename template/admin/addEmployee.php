<?php include ('includes/ajax.php');?>
<script type="text/javascript">
    function fetch_select(val)
    {
        $.ajax({
            type: 'post',
            url: 'template/admin/fetchCompanyDepartment.php',
            data: {
                get_option:val
            },
            success: function (response) {
                document.getElementById("department").innerHTML=response;
            }
        });
    }
</script>
<div class="container" style="padding: 2%">
    <?php
    if(isset($_POST['alter'])){
        $employeeId = $_POST['employeeId'];
        $companyId = $_POST['companyId'];
        $departmentId = $_POST['departmentId'];
        $departmentName = $_POST['departmentName'];
        $qry = "select employee.employeeName, employee.DOJ, employee.DOB, employee.DOL,employee.salary,employee.designationId, salary.salaryAmount, designation.designationName from employee 
                inner join salary on salary.salaryId = employee.salary
                inner join designation on designation.designationId = employee.designationId
                    where employeeId = $employeeId";
        $result = mysqli_query($conn, $qry);
        $employee = mysqli_fetch_assoc($result);
    ?>
    <div class="section-header">
        <h2>Update Employee Information</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Employee Information</h3>
    <form action="template/admin/addEmployeeQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <input type="hidden" value="update" name="alter">
                    <input type="hidden" value="<?php echo $employeeId; ?>" name="employeeId">
                    <label>Employee Name</label>
                    <input class="form-control" type="text" name="employeeName" value="<?php echo $employee['employeeName']; ?>">
                    <br>
                    <label for="sel1">Select Department:</label>
                    <select class="form-control" id="department" name="departmentId">
                        <option value="<?php echo $departmentId;?>"><?php echo $departmentName; ?></option>
                        <?php
                        $qry = "select department.departmentId, department.departmentName from department 
                                    inner join hasdepartment on hasdepartment.departmentId = department.departmentId where hasdepartment.companyId = $companyId";
                        $result = mysqli_query($conn,$qry);
                        while($department = mysqli_fetch_assoc($result)){
                            if($department['departmentId'] != $departmentId){
                            ?>
                            <option value="<?php echo $department['departmentId'];?>"><?php echo $department['departmentName']; ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                    <br>
                    <label for="sel1">Salary:</label>
                    <select class="form-control" id="salaryId" name="salaryId">
                        <option value="<?php echo $employee['salary'];?>"><?php echo $employee['salaryAmount']; ?></option>
                        <?php
                        $qry = "select salaryId, salaryAmount from salary";
                        $result = mysqli_query($conn,$qry);
                        while($salary = mysqli_fetch_assoc($result)){
                            if($salary['salaryId'] != $employee['salary']){
                            ?>
                            <option value="<?php echo $salary['salaryId'];?>"><?php echo $salary['salaryAmount']; ?></option>
                        <?php
                            }
                        }?>
                    </select>
                    <br>
                    <label for="sel1">Designation:</label>
                    <select class="form-control" id="designationId" name="designationId">
                        <option value="<?php echo $employee['designationId'];?>"><?php echo $employee['designationName']; ?></option>
                        <?php
                        $qry = "select designationId, designationName from designation";
                        $result = mysqli_query($conn,$qry);
                        while($designation = mysqli_fetch_assoc($result)){
                            if($designation['designationId'] != $employee['designationId']){
                            ?>
                            <option value="<?php echo $designation['designationId'];?>"><?php echo $designation['designationName']; ?></option>
                        <?php
                            }
                        }?>
                    </select>
                </div>
                <div class="column col-md-6">

                    <label for="sel1">Select Company:</label>
                    <select class="form-control" id="companyId" name="companyId" onload="fetch_select(this.value)">
                        <?php
                        $qry = "select companyName from company where companyId = $companyId";
                        $result = mysqli_query($conn,$qry);
                        while($company = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $companyId;?>"><?php echo $company['companyName']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="sel1">DOB:</label>
                    <input class="form-control" type="date" name="dob" value="<?php echo $employee['DOB']; ?>">
                    <label for="sel1">DOJ:</label>
                    <input class="form-control" type="date" name="doj" value="<?php echo $employee['DOJ']; ?>">
                    <label for="sel1">DOL:</label>
                    <input class="form-control" type="date" name="dol" value="<?php echo $employee['DOL']; ?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
</div>
</form>
    <?php }else{ ?>
    <div class="section-header">
        <h2>Add New Employee</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Employee Information</h3>
    <form action="template/admin/addEmployeeQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Employee Name</label>
                    <input class="form-control" type="text" name="employeeName" placeholder="Enter Name">
                    <br>
                    <label for="sel1">Select Department:</label>
                    <select class="form-control" id="department" name="departmentId">
                        <option>Select Department Name</option>
                    </select>
                    <br>
                    <label for="sel1">Salary:</label>
                    <select class="form-control" id="salaryId" name="salaryId">
                        <option>Select Salary</option>
                        <?php
                            $qry = "select salaryId, salaryAmount from salary";
                            $result = mysqli_query($conn,$qry);
                            while($salary = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $salary['salaryId'];?>"><?php echo $salary['salaryAmount']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="sel1">Designation:</label>
                    <select class="form-control" id="designationId" name="designationId">
                        <option>Select Employee Designation</option>
                        <?php
                        $qry = "select designationId, designationName from designation";
                        $result = mysqli_query($conn,$qry);
                        while($designation = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $designation['designationId'];?>"><?php echo $designation['designationName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">

                    <label for="sel1">Select Company:</label>
                    <select class="form-control" id="companyId" name="companyId" onchange="fetch_select(this.value)">
                        <option>Select Company Name</option>
                        <?php
                            $qry = "select companyId, companyName from company";
                            $result = mysqli_query($conn,$qry);
                            while($company = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $company['companyId'];?>"><?php echo $company['companyName']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label for="sel1">DOB:</label>
                    <input class="form-control" type="date" name="dob">
                    <label for="sel1">DOJ:</label>
                    <input class="form-control" type="date" name="doj">
                    <label for="sel1">DOL:</label>
                    <input class="form-control" type="date" name="dol">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Add">
</div>
</form>
<?php } ?>
</div>