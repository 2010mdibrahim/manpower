<?php
$qry = "select * from agenttype";
$result = mysqli_query($conn,$qry);
?>
<style>
    .column{
        padding: 2%;
    }
</style>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Admin Panal</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Company Section</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=createCompany" class="btn btn-primary">Create Company</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=companyList" class="btn btn-primary">Company List</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=addDepartment" class="btn btn-primary">Add Department</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=companyDepartmentList" class="btn btn-primary">Company Department List</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=addBranch" class="btn btn-primary">Add Branch</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-6" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=companyBranchList" class="btn btn-primary">Branch List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>