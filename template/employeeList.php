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
<style>
    .box .close_box {
        float:right;
        border: 1px solid #9e9e9e;
        padding:2px 5px;
        background:#e57373;
        text-align: center;
        vertical-align: bottom;
        border-radius: 3px;
    }
    .close_box:hover{
        cursor: pointer;
        background:#ef5350;
        transition: 400ms;
    }
    .box{
        display:inline-block;
        border: 2px #9e9e9e solid;
        border-radius: 5px;
    }
    .box .box_content{
        float:left;
        background:#fafafa;
        padding: 2px;
    }
    .row{
        margin-right: 0;
        margin-left: 0;
    }
</style>
<div class="container-fluid">
    <!-- Add delegate Comission -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addSection">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/addNewSectionToEmployee.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Sections to Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="sectionAddModal">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="delegateModalButton">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="section-header">
        <h2>Employee List</h2>
    </div>
    <div class="table-responsive" id="tableContent">
        <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
            <thead>
            <tr>
                <th>Employee Name</th>
                <th>Employee ID</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Designation</th> 
                <th>Access</th> 
                <th>Edit</th>
            </tr>
            </thead>
            <?php 
            $result = $conn->query("SELECT * from employee");
            while($employee = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $employee['employeeName'];?></td>
                <td><?php echo $employee['employeeOfficeId'];?></td>
                <td><?php echo $employee['empMob'];?></td>
                <td><?php echo $employee['empAddress'];?></td>
                <td><?php echo $employee['empDesignation'];?></td>
                <td>
                <form action="template/removeSectionFromEmployee.php" method="post">
                    <?php
                    $result_section = $conn->query("SELECT sections.sectionName, sections.sectionId, employeeaccesssection.* from employeeaccesssection INNER JOIN sections using (sectionId) where employeeaccesssection.employeeId = ".$employee['employeeId']);
                    while($sections = mysqli_fetch_assoc($result_section)){ ?>
                        <div class="box"><div class="box_content"><?php echo $sections['sectionName'];?></div><button name="sectionInfo" value="<?php echo $sections['sectionId']."_".$employee['employeeId'];?>" class="close_box"><i class="fa fa-close"></i></button></div>
                    <?php }?>
                </form>
                </td>
                <!-- Edit Section -->
                <td>
                    <div class="row w-75">
                        <div class="col-md-3">
                            <button class="btn btn-info" data-toggle="modal" data-target="#addSection" value="<?php echo $employee['employeeId']?>" onclick="fetchData(this.value)">Add Section</button>
                        </div>
                        <div class="col-md-4">
                            <a href="?page=resetPass&eI=<?php echo base64_encode($employee['employeeId'])?>"><button class="btn btn-info">Change Password</button></a>
                        </div>
                        <div class="col-md-2"> 
                            <form action="index.php" method="post">
                                <input type="hidden" name="pagePost" value="editEmployee">
                                <input type="hidden" value="<?php echo $employee['employeeId']; ?>" name="employeeId">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>                                       
                        </div>
                        <div class="col-md-2">
                            <form action="template/newEmployeeQry.php" method="post">
                                <input type="hidden" name="alter" value="delete">
                                <input type="hidden" value="<?php echo $employee['employeeId']; ?>" name="employeeId">
                                <button type="submit" class="btn btn-danger btn-sm" name="sectionDate">Delete</></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>  
            <?php } ?>
            <tfoot>
            <tr hidden>
                <th>Employee Name</th>
                <th>Employee ID</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Designation</th> 
                <th>Access</th> 
                <th>Edit</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>  
<script>
    function fetchData(employeeId){
        console.log('response');
        $.ajax({
            type: 'post',
            url: 'template/fetchEmployeeListAddSection.php',
            data: {employeeId},
            success: function (response){
                $('#sectionAddModal').html(response);
                $('.select2').select2({
                    width: '100%'
                });
            }
        });

    }
    function removeSection(info){
        var info_split = info.split('_');
        $.ajax({
            type: 'post',
            url: 'template/removeSectionFromEmployy.php',
            date: {sectionId: info_split[0], employeeId: info_split[1]},
            success: function(){
                window.location.href = "../index.php?page=employeeList";
            }
        });
    }
    $('#employeeNav').addClass('active');
</script>