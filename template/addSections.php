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
?>
<style>
.container{
    margin-bottom: 2%;
}
</style>
<div class="container" style="padding: 2%">
    <!-- Edit Section -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editSection">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="editSectionForm" enctype="multipart/form-data" onsubmit="editSection()">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Section</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row" id="modalTest">
                            <input type="hidden" name="alter" value="update">       
                            <input type="hidden" name="sectionId" id="sectionIdModal">       
                            <div class="form-group col-sm">
                                <label style="margin-right: 5px;">Section Name: </label>
                                <input class="form-control" type="text" name="section" id="sectionModal">       
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="section-header">
        <h2>Jobs</h2>
    </div>    
    <div class="container">
        <form id="addSectionForm">
            <div class="form-row align-items-end">
                <div class="form-group col-md-4" >
                    <label>Add Section</label>
                    <input class="form-control" autocomplete="off" type="text" name="section" id="section" placeholder="Enter Section">
                </div>
                <div class="form-group" >
                    <input class="form-control" type="submit" value="Add" name="jobs">
                </div>
            </div>    
        </form>
    </div>
    <?php $result = $conn->query("SELECT * from sections order by creationDate desc"); ?>
    <div class="container">
        <div class="table-responsive" id="tableContent">
            <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                <thead>
                <tr>
                    <th>Section</th>
                    <th>Creation Date</th> 
                    <th>Edit</th>
                </tr>
                </thead>
                <?php while($sections = mysqli_fetch_assoc($result)){?>
                <tr>
                    <td><?php echo $sections['sectionName'];?></td>
                    <td><?php echo $sections['creationDate'];?></td>
                    <!-- Edit Section -->
                    <td>
                        <div class="row">
                            <div class="col-md-2">                                        
                                <button type="submit" data-toggle="modal" data-target="#editSection" class="btn btn-primary btn-sm" value="<?php echo $sections['sectionId']."_".$sections['sectionName'];?>" onclick="editSectionVal(this.value)">Edit</></button>
                            </div>
                            <div class="col-md-2">
                                <form action="template/editSection.ajax.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $sections['sectionId']; ?>" name="sectionId">
                                    <button type="submit" class="btn btn-danger btn-sm" name="sectionDate">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>  
                <?php } ?>
                <tfoot>
                <tr hidden>
                    <th>Section</th>
                    <th>Creation Date</th> 
                    <th>Edit</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>    
</div>



<script>
    $('#employeeNav').addClass('active');
    $('#addSectionForm').submit(function(){
        event.preventDefault();
        var section = $('#section').val();
        $('#section').val('');
        $.ajax({
            type: 'post',
            data: {section: section},
            url: 'template/addSection.ajax.php',
            success: function(response){
                $('#tableContent').html(response);
                $(document).ready(function() {
                    $('#dataTableSeaum').DataTable({
                        "fixedHeader": true,
                        "paging": true,
                        "lengthChange": true,
                        "lengthMenu": [
                            [10, 25, 50, 100, 500],
                            [10, 25, 50, 100, 500]
                        ],
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                        "order": [],
                        "scrollX": false,
                        "scrollY": false
                    });              
                });
            }
        });
    });
    function editSectionVal(info){
        info_split = info.split('_');
        $('#sectionIdModal').val(info_split[0]);
        $('#sectionModal').val(info_split[1]);
    }

    function editSection(){
        event.preventDefault();
        var section = $('#sectionModal').val();
        var sectionId = $('#sectionIdModal').val();
        $('#editSection').modal('toggle');
        $.ajax({
            type: 'post',
            data: {section: section, sectionId: sectionId, alter: alter},
            url: 'template/editSection.ajax.php',
            success: function(response){
                $('#tableContent').html(response);
                $(document).ready(function() {
                    $('#dataTableSeaum').DataTable({
                        "fixedHeader": true,
                        "paging": true,
                        "lengthChange": true,
                        "lengthMenu": [
                            [10, 25, 50, 100, 500],
                            [10, 25, 50, 100, 500]
                        ],
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                        "order": [],
                        "scrollX": false,
                        "scrollY": false
                    });              
                });
            }
        });
    };
</script>