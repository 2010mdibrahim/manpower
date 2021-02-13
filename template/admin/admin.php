<?php
$qry = "select * from agenttype";
$result = mysqli_query($conn,$qry);

?>
<style>
    .column{
        padding-bottom: 2%;
    }
</style>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Admin Panal</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Admin Panal</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">

                        <div class="card-body" style="text-align: center">
                            <div class="row" style="padding-bottom: 2%">
                                <div class="col-sm" style="align-content: center">
                                    <img src="img/company.png" width="30" height="30" style="vertical-align:middle">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm" style="align-content: center">
                                    <a href="?page=company" class="btn btn-primary">Company</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=department" class="btn btn-primary">Department</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=branch" class="btn btn-primary">Branch</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=salary" class="btn btn-primary">Salary</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=employee" class="btn btn-primary">Employee</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=profession" class="btn btn-primary">Profession</a>
                        </div>
                    </div>
                </div>
                <div class="column col-md-4" >
                    <div class="card" style="width: 18rem;">
                        <div class="card-body" style="text-align: center">
                            <a href="?page=designation" class="btn btn-primary">Designation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>