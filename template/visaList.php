<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
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
    .btn{
        font-size: 11px;
    }
    .indicator{
        font-size: 16px;
        font-weight: bold;
    }
    .processing a{
        color: white;
    }
    .indicator.green{
        border: 5px #66bb6a solid;
    }
    .indicator.blue{
        border: 5px #42a5f5 solid;
    }
    .indicator.red{
        border: 5px #f44336 solid;
    }
    .indicator.black{
        border: 5px #424242 solid;
    }
    .indicator.hold{
        border: 5px #f9a825  solid;
    }
    
    .indicator.disable{
        border: 5px #8d6e63  solid;
    }
    .status-2{
        background-color: #8d6e63;
        color: white
    }
    .status-1{
        background-color: #f9a825;
    }
</style>
<div class="container-fluid" style="padding: 2%">

    <!-- Return or complete or hold -->
    <div class="modal fade" tabindex="-1" role="dialog" id="returnCandidate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/returnCandidateQry.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Return Or Complete Or Hold</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="processingIdModalReturn" name="processingId">
                        <input type="hidden" name="href" value="visaList">
                        <div class="row justify-content-center">
                            <div class="col-sm">
                                <button type="submit" class="btn btn-success" value="complete" name="complete">Complete</button>
                            </div>
                            <div class="col-sm">
                                <button type="submit" class="btn btn-danger" value="return" name="return">Return</button>
                            </div>
                            <div class="col-sm" id="hold">
                            </div>
                        </div>                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add delegate Comission -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delegateComissionCandidate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/addDelegateComission.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delegate Comission Amount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="passportNum" id="passportNumDelegateExpenseInfo">
                        <input type="hidden" name="creationDate" id="creationDateDelegateExpenseInfo">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="delegateExpenseAmount">Delegate Comission</label>
                                    <input class="form-control" type="number" name="delegateExpenseAmount" id="delegateExpenseAmountModal" placeholder="Enter Delegate Comission" onkeyup="calculateBDT()">
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="delegateModalButton"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Manpower Card Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="manpowerFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Manpower Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdManpower">
                        <input type="hidden" name="passportNum" id="passportNumManpower">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisaManpower">
                        <input type="hidden" name="manpowerCard" id="manpowerCard">
                        <input type="hidden" name="mode" value="manpowerMode">
                        <input class="form-control" type="file" name="manpowerCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Okala Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="okalaFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Okala Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdOkala">
                        <input type="hidden" name="passportNum" id="passportNumOkala">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisaOkala">
                        <input type="hidden" name="mode" value="okalaMode">
                        <input class="form-control" type="file" name="okalaCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Mufa Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="mufaFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give MUFA Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdMufa">
                        <input type="hidden" name="mode" value="mufaMode">
                        <input class="form-control" type="file" name="mufaCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Training Card Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="trainingCardFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Training Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="passportNum" id="passportNumCard">
                        <input type="hidden" name="mode" value="trainingCardMode">
                        <input class="form-control" type="file" name="trainingCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Youtube -->
    <div class="modal fade" tabindex="-1" role="dialog" id="youtube">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/enterYoutube.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Youtube Link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdModal">
                        <label for="youtube">Enter YouTube Link</label>
                        <input class="form-control" type="text" name="youtube" placeholder="Give Link">
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- VISA exchange -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaExchange">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">VISA Stamping Date & VISA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="passportNum" id="passportNum">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisa">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="datepicker" autocomplete="off" type="text" name="stampingDate">
                        </div>
                        <div>
                            <input class="form-control-file" type="file" name="visaFile">
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

    <!-- Stamping Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStampingDiv">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">VISA Stamping Date & VISA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="processingId" id="processingIdModalThree">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="datepicker" autocomplete="off" type="text" name="stampingDate" placeholder="Enter Visa Stamping Date">
                        </div>
                        <div class="form-group" id="visa_file_div">
                            <div class="form-group">
                                <input class="form-control-file" type="file" name="visaFile[]" multiple>
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
    <!-- Disable Candidate -->
    <div class="modal fade" tabindex="-1" role="dialog" id="disableCandidate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/disableCandidate.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disable Candidate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="href" value="visaList">
                        <input type="hidden" name="passportNum" id="passportNumDisableModal">
                        <input type="hidden" name="creationDate" id="creationDateDisableModal">
                        <label for="reason">Reason For Disabling</label>
                        <input class="form-control" type="text" name="reason" placeholder="Enter Reason">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="disable">Disable</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Show Disable Candidate -->
    <div class="modal fade" tabindex="-1" role="dialog" id="disableCandidateReason">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/disableCandidate.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disable Candidate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="href" value="visaList">
                        <input type="hidden" name="passportNum" id="passportNumEnableModal">
                        <input type="hidden" name="creationDate" id="creationDateEnableModal">
                        <label for="reason">Reason For Disabling</label>
                        <p id="reasonModal"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="enable">Enable</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Visa Information</h2>
            </div>
            <div class="row justify-content-md-center text-center">
                <div class="col-md-1">
                    <div class="indicator hold">On Hold</div>
                </div>
                <div class="col-md-1">
                    <div class="indicator disable">Disabled</div>
                </div>
            </div>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table id="list_visa" class="table table-bordered"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Processing Id</th>
                        <th>Passport Number<th>                               
                        <th>Name</th>
                        <th>Candidate Name</th>
                        <th>Passport Number</th>
                        <th>Sponosr Visa</th>
                        <th>VISA No</th>
                        <th>Sponsor Name</th>
                        <th>ID No</th>
                        <th>Country</th>
                        <th>Emp Request</th>
                        <th>Employee Request</th>
                        <th>Foreign Mole data</th>
                        <th>Foreign Mole</th>
                        <th>Okala Data</th>
                        <th>Credit Type</th>                               
                        <th>Agent Email</th>
                        <th>Okala</th>
                        <th>Mufa Data</th>
                        <th>MUFA</th>
                        <th>Medical Update Data</th>
                        <th>Update Medical</th>
                        <th>Visa Stamping Data</th>
                        <th>Notification Data</th>
                        <th>VISA Stamping</th>
                        <th>Finger Data</th>
                        <th>Finger</th>
                        <th>Training Card</th>
                        <th>Manpower Card Data</th>
                        <th>Manpower Card</th>
                        <th>Pending Data</th>
                        <th>Ticket</th>
                        <th>Options</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>        
    </div>
</div>

<script>
function pending_list(passportNum, passportCreationDate){
    $.ajax({
        type: 'post',
        url: 'template/sendToPendingList.php',
        data: {passportNum, passportCreationDate},
        success: function (response){
            $('#list_visa').DataTable().ajax.reload( null , false);
        }
    });
};

function stopNotification(processingId){
    mode = 'visa';
    href = 'visaList';
    $.ajax({
        type: 'post',
        url: 'template/stopNotification.php',
        data: {processingId, href:href, mode:mode},
        success: function (response){
            body_msg = 'Notification Turned Off for ' + response;
            new jBox('Notice', {
                color: 'red',
                content: body_msg,
                attributes: {
                    x: 'right',
                    y: 'bottom'
                }
            });
            $('#list_visa').DataTable().ajax.reload( null , false);
        }
    });

}

function showDisableValue(info){
    info_split = info.split('_');
    $('#passportNumEnableModal').val(info_split[0]);
    $('#creationDateEnableModal').val(info_split[1]);
    $('#reasonModal').html(info_split[2]);
}
function getDisableValue(info){
    info_split = info.split('_');
    $('#passportNumDisableModal').val(info_split[0]);
    $('#creationDateDisableModal').val(info_split[1]);
}

function getReturnValue(info){
    info_split = info.split('_');
    $('#processingIdModalReturn').val(info_split[0]);
    let button = document.createElement('BUTTON');
    button.setAttribute('type', 'submit');
    if(info_split[1] === '0'){
        button.setAttribute('class', 'btn btn-warning');
        button.setAttribute('value', 'hold');
        button.setAttribute('name', 'hold');
        button.textContent = 'Hold';
    }else if(info_split[1] === '1'){
        button.setAttribute('class', 'btn btn-secondary');
        button.setAttribute('value', 'release');
        button.setAttribute('name', 'release');
        button.textContent = 'Release';
    }
    
    $('#hold').html(button);
}

function calculateBDT(){
    var delegateExpense = ($('#delegateExpenseAmountModal').val() === 0 | $('#delegateExpenseAmountModal').val() === '') ? 1 : $('#delegateExpenseAmountModal').val();
    var dollarRate = ($('#dollarRateModal').val() === 0 | $('#dollarRateModal').val() === '') ? 1 : $('#dollarRateModal').val();
    $('#bdtAmountModal').val(delegateExpense*dollarRate);
}

function youtubeLink(processingId){
    $('#processingIdModal').val(processingId);
}

function addDelegateExpense(info){
    info = info.split('_');
    $('#delegateModalButton').html('Submit');
    $('#passportNumDelegateExpenseInfo').val(info[0]);
    $('#creationDateDelegateExpenseInfo').val(info[1]);
}
function editDelegateExpense(info){
    info = info.split('_');
    $('#delegateModalButton').html('Update');
    $('#passportNumDelegateExpenseInfo').val(info[0]);
    $('#creationDateDelegateExpenseInfo').val(info[1]);
    $('#delegateExpenseAmountModal').val(info[2]);
    $('#dollarRateModal').val(info[3]);
    $('#bdtAmountModal').val(info[2] * info[3]);
}

$('#add_visafile_div').click(function (){
    var visaFileDiv = document.createElement('DIV');
    visaFileDiv.setAttribute('class', 'form-group');
    var input = document.createElement('INPUT');
    input.setAttribute('type', 'file');
    input.setAttribute('name', 'visaFile[]');
    input.setAttribute('class', 'form-control-file');
    visaFileDiv.appendChild(input);
    $('#visa_file_div').append(visaFileDiv);    
});
$('#remove_visafile_div').click(function (){
    $('#visa_file_div').children().last().remove();  
});

function manpowerFileSubmit(info){
    $('#processingIdManpower').val(info);
}

function mufaFileSubmit(info){  
    $('#processingIdMufa').val(info);
}

function okalaFileSubmit(info){  
    $('#processingIdOkala').val(info);
}

function trainingCard(info){
    let info_split = info.split('-');
    $('#passportNumCard').val(info_split[0]);
}

function visaStamping(processingId){
    $('#processingIdModalOne').val(processingId);
    $('#processingIdModalThree').val(processingId);
}

$('body').on('click', '#testMedicalFile', function(){
    $('#visaMedical').val($('#testMedicalFile').val());
});

$('body').on('click', '#finalMedicalFile', function(){
    $('#visaMedicalFinal').val($('#finalMedicalFile').val());
});
$(document).ready(function(){
    var table_booking = $('#list_visa').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [[0, "desc"]],
        "info": true,
        "ScrollX": true,
        "processing": true,
        "serverSide": true,
        "fixedHeader": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500],
            [10, 25, 50, 100, 500]
        ],
        "ajax": "<?php echo $datable_path ?>template/datatable/visaListDatatable.php",
        "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": true
                        },
                        {
                            "targets": [ 1 ],
                            "visible": false,
                            "searchable": true
                        },
                        {
                            "targets": [ 2 ],
                            "visible": false,
                            "searchable": true
                        },
                        {
                            "targets": [ 3 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 6 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 8 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 10 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 11 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 13 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 16 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 17 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 19 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 21 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 23 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 24 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 26 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 29 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 31 ],
                            "visible": false,
                            "searchable": false
                        },
                        {
                            "targets": [ 34 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],
        createdRow: function (row, data, index) {
            //
            // if the second column cell is blank apply special formatting
            //
            if (data[34] == "2") {
                console.dir(row);
                $(row).addClass("processing status-2");
            }else if(data[34] == "1"){
                console.dir(row);
                $(row).addClass("processing status-1");
            }
        }                 
    });
});
$('#visaNav').addClass('active');
</script>

