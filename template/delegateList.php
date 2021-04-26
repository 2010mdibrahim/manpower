<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_GET['di'])){
    $delegateId = base64_decode($_GET['di']);
    $qry = "SELECT * from delegate where delegateId = $delegateId";
}else{
    $qry = "SELECT * from delegate order by creationDate desc";
}
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .modal-dialog {
        max-width: 80%;
        margin: 1.75rem auto;
    }
</style>

<div class="container-fluid" style="padding: 2%">
    <div class="card">
        <!-- Delegate Candidate List -->
        <div class="modal fade" tabindex="-1" role="dialog" id="delegateCandidateList">
            <div class="modal-dialog modal-xl" role="document">
                <form action="template/addDelegateCandidateComission.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delegate Candidate List</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="showDelegateCandidateDiv">
                        
                        
                        </div>
                        <div class="modal-footer">
                            <input class="form-control datepicker w-25" autocomplete="off" type="text" name="delegatePayDate" id="delegatePayDate" placeholder="Enter Date" style="display: none;">
                            <input class="form-control-file w-25" type="file" name="delegateSlip" id="delegateSlip" style="display: none;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Add Office -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addOfficeModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="template/addDelegateOffice.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Office</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" name="delegateId" id="delegateIdModal">
                        <div class="form-row">
                            <div id="officeDiv">
                                <div class="form-group row">
                                    <div class="col-sm">  
                                        <label for="sel1">Office: </label>
                                        <input class="form-control" type="text" name="delegateOffice[]" placeholder="Office name" required>
                                    </div>
                                    <div class="col-sm">  
                                        <label for="sel1">License Number: </label>
                                        <input class="form-control" type="text" name="licenseNumber[]" placeholder="License Number" required>
                                    </div>
                                </div>
                            </div>                
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <button class="btn btn-sm" type="button" id="add_office" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                                <button class="btn btn-sm btn-danger" type="button" id="remove_office"><span class="fas fa-minus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Edit Delete Office -->
        <div class="modal fade" tabindex="-1" role="dialog" id="changeDelegateOffice">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="template/delegateOfficeEdit.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Office Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="delegateOfficeId" id="delegateOfficeIdModal">
                            <label for="">Office Name</label>
                            <input class="form-control" type="text" name="officeName" id="officeNameModal">
                            <label for="">License Number</label>
                            <input class="form-control" type="text" name="licenseNum" id="licenseNumModal">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-header">
            <div class="section-header">
                <h2>Delegate List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Delegate Name</th>
                        <th>Country</th>
                        <th>State</th>                
                        <th>Office</th>
                        <th>Comment</th>
                        <th>Expense</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    while( $delegate = mysqli_fetch_assoc($result) ){ ?>
                        <tr>
                            <td><?php echo $delegate['delegateName'];?></td>
                            <td><?php echo $delegate['country'];?></td>
                            <td><?php echo $delegate['delegateState'];?></td>
                            <td><?php 
                            $result_office = $conn->query("SELECT delegateOfficeId, officeName, officeLicenseNumber from delegateOffice where delegateId = ".$delegate['delegateId']);
                            while($office = mysqli_fetch_assoc($result_office)){ ?>
                                <button class="btn btn-sm" data-toggle="modal" data-target="#changeDelegateOffice" value="<?php echo $office['officeName']."_".$office['delegateOfficeId']."_".$office['officeLicenseNumber']; ?>" onclick="delegateOffice(this.value)"><?php echo $office['officeName']; ?></button>
                            <?php } ?></td>
                            <td><?php echo $delegate['comment'];?></td>                    
                            <td class="text-center">
                                <a href="?page=delegateAccount&dI=<?php echo base64_encode($delegate['delegateId']);?>"><button class="btn btn-info btn-sm" value="<?php echo $delegate['delegateId'];?>"><span class="fas fa-dollar"></span></button></a>
                                <button data-target="#delegateCandidateList" data-toggle="modal" class="btn btn-info btn-sm" value="<?php echo $delegate['delegateId'];?>" onclick="fetchDelegateCandidate(this.value)"><span class="fas fa-search"></span></button>
                                <button data-target="#delegateCandidateList" data-toggle="modal" class="btn btn-success btn-sm" value="<?php echo $delegate['delegateId'].'_'.'paid';?>" onclick="fetchPaidDelegateCandidate(this.value)"><span class="fa fa-check"></span></button>
                            </td>
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">                                        
                                        <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addOfficeModal" value="<?php echo $delegate['delegateId']?>" onclick="addOffice(this.value)">Add Office</></button>
                                    </div>
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" value="editDelegate" name="pagePost">
                                            <input type="hidden" value="<?php echo $delegate['delegateId']; ?>" name="delegateId">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/addNewDelegateQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $delegate['delegateId']; ?>" name="delegateId">
                                            <button type="submit" class="btn btn-danger btn-sm" name="addDelegate">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Expense Header</th>
                        <th>Amount</th>
                        <th>Issue Date</th>
                        <th>Paymode</th>
                        <th>Remark</th>
                        <th>Expense</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>

                </table>
            </div>

        </div>
    </div>   
</div>


<script>
    $('#delegateNav').addClass('active');
    function fetchDelegateCandidate(delegateId){
        $('#showDelegateCandidateDiv').html('');
        $.ajax({
            type: 'post',
            url: 'template/fetchDelegateCandidateList.php',
            data: {delegateId: delegateId},
            success: function(response){
                $('#showDelegateCandidateDiv').html(response);
                $(document).ready(function() {
                    $('#dataTableSeaumNotPaid').DataTable({
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
                        dom: 'Bfrtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ]
                    });              
                });
            }
        });
    }
    $('body').on('click', "input[type='checkbox']", function(){
        const checkboxes = $("input[name='candidateList[]']:checked").val();
        if(typeof checkboxes === 'undefined'){
            $('#delegatePayDate').prop('required', false);
            $('#delegatePayDate').hide();
            $('#delegateSlip').prop('required', false);
            $('#delegateSlip').hide();
        }else{
            $('#delegatePayDate').prop('required', true);
            $('#delegatePayDate').show();
            $('#delegateSlip').prop('required', true);
            $('#delegateSlip').show();
        }
    })
    function fetchPaidDelegateCandidate(info){
        $('#showDelegateCandidateDivshowDelegateCandidateDiv').html('');
        $.ajax({
            type: 'post',
            url: 'template/fetchPaidDelegateCandidateList.php',
            data: {info: info},
            success: function(response){
                $('#showDelegateCandidateDiv').html(response);
                totalComission = '&#x24; ' + $('#totalComission').val();
                console.log(totalComission);
                $('#totalComissionShow').html(totalComission);
                $(document).ready(function() {
                    $('#dataTableSeaumPaid').DataTable({
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
                        dom: 'Bfrtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ]
                    });              
                });
            }
        });
    }
    function delegateOffice(info){
        var info_split = info.split('_');
        $('#officeNameModal').val(info_split[0]);
        $('#delegateOfficeIdModal').val(info_split[1]);
        $('#licenseNumModal').val(info_split[2]);
    }
    $('#add_office').click(function(){
        // create row
        var div = document.createElement("DIV");
        div.setAttribute('class', 'form-group row');
        // create first col-sm
        var div_col_1 = document.createElement("DIV");
        div_col_1.setAttribute('class', 'col-sm');
        var label = document.createElement("LABEL");
        var text = document.createTextNode("Office: ");
        label.appendChild(text);
        div_col_1.appendChild(label);
        var input = document.createElement("INPUT");
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'delegateOffice[]');
        input.setAttribute('class', 'form-control');
        input.setAttribute('placeholder', 'Office Name');
        input.setAttribute('required','');
        div_col_1.appendChild(input);
        div.appendChild(div_col_1);
        // second input
        var div_col_1 = document.createElement("DIV");
        div_col_1.setAttribute('class', 'col-sm');
        var label = document.createElement("LABEL");
        var text = document.createTextNode("License Number: ");
        label.appendChild(text);
        div_col_1.appendChild(label);
        var input = document.createElement("INPUT");
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'licenseNumber[]');
        input.setAttribute('class', 'form-control');
        input.setAttribute('placeholder', 'License Number');
        input.setAttribute('required','');
        div_col_1.appendChild(input);
        div.appendChild(div_col_1);
        $('#officeDiv').append(div);
    });
    $('#remove_office').click(function(){
        $('#officeDiv').children().last().remove();
    });
    function addOffice(delegateId){
        $('#delegateIdModal').val(delegateId);
    }
</script>
