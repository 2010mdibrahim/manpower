<?php
include ('includes/ajax.php');
$qry = "select employeeId, employeeName, companyId from employee";
$result = mysqli_query($conn,$qry);
?>

<script>
    function fetch_company_data(val){
        $.ajax(
            {
                type: 'post',
                url: 'template/admin/fetchCompanyForEmployee.php',
                data: { val : val },
                success: function (response){
                    document.getElementById('companyName').innerHTML = response;
                    let selectedCompanyId = document.getElementById('companyName').value ;
                    $.ajax(
                        {
                            type: 'post',
                            url: 'template/admin/fetchCompanyToSwitch.php',
                            data: { val : selectedCompanyId },
                            success: function (response){
                                document.getElementById('switchCompany').innerHTML = response;
                            }
                        }
                    );
                }
            }
        );
    };
</script>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h3>Switch job for Employee</h3>
    </div>
    <form action="template/admin/switchJobQry" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column form-group col-md-4">
                    <label>Select Employee</label>
                    <select class="form-control" name="employeeId" onchange="fetch_company_data(this.value)">
                        <option>Employee Name</option>
                        <?php
                        while($employee = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $employee['companyId'];?>"><?php echo $employee['employeeName'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column form-group col-md-4">
                    <label>Employee Current Company</label>
                    <select class="form-control" id="companyName" readonly>
                        <option>Company Name</option>
                    </select>
                </div>
                <div class="column form-group col-md-4">
                    <label>Switch to Company</label>
                    <select class="form-control" id="switchCompany" name="companyId">
                        <option>Company Name</option>
                    </select>
                </div>
            </div>
            <div class="form-group" style="">
                <input style="width: 15%;margin: auto;" class="form-control btn-primary" type="submit" value="Transfer">
            </div>
        </div>
    </form>
</div>

