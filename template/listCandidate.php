<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_GET['pp'])){
    $passportNum = base64_decode($_GET['pp']);
    $creationDate = base64_decode($_GET['cd']);
    $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) where passport.passportNum = '$passportNum' and passport.creationDate = '$creationDate'");
}else if(isset($_GET['specific'])){
    if($_GET['specific'] == 'inVisa'){
        $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) inner join processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate LEFT JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate where passport.status != 2 AND ticket.ticketId is null order by passport.creationDate desc limit 200"); 
        print_r(mysqli_error($conn));
    }else if($_GET['specific'] == 'inTicket'){
        $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) inner join processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate INNER JOIN ticket on ticket.passportNum = passport.passportNum AND ticket.passportCreationDate = passport.creationDate where passport.status != 2 order by passport.creationDate desc limit 200");        
    }else if($_GET['specific'] == 'unfit'){
        $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) where passport.testMedicalStatus = 'unfit' or passport.finalMedicalStatus = 'unfit' order by passport.creationDate desc limit 200");        
    }else if($_GET['specific'] == 'back'){
        $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) order by passport.creationDate desc limit 200");        
    }else if($_GET['specific'] == 'onHold'){
        $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) inner join processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where passport.status = 1 order by passport.creationDate desc limit 200");        
    }else if($_GET['specific'] == 'disable'){
        $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) inner join processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where passport.status = 2 order by passport.creationDate desc limit 200");        
    }
}else{
    $result = $conn -> query("SELECT agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) order by passport.creationDate desc limit 200");
}
?>

<style>
    .status-2{
        background-color: #8d6e63;
        color: white
    }
    .status-1{
        background-color: #f9a825 ;
    }
    .unfit{
        background-color: #f44336;
        color: white;
    }
    .pending_3{
        background-color: #424242;
        color: white;
    }
    .yes_ticket{
        background-color: #42a5f5;
        color: white;
    }
    .no_ticket{
        background-color: #66bb6a;
        color: white;
    }
    .btn_custom{
        padding: 1%;
        align-content: center;
    }
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    html {
        scroll-behavior: smooth;
    }
    .processing a{
        color: white;
    }
    .indicator{
        font-size: 16px;
        font-weight: bold;
        border-radius: 0px;
        transition: border-radius 0.3s;
    }
    .indicator-a{
        text-decoration: none;
        color: black;
    }
    .indicator-a:hover{
        color: black;
        text-decoration: none;
    }
    .indicator:hover{
        cursor: pointer;
        border-radius: 10px;
        transition: border-radius 0.5s;
    }
    .filter-button{
        outline: none;
        background-color: white;
        box-shadow: white;
        transition: 1s;
        font-weight: bold;
        border-radius: 5px;
        box-shadow: 1px 1px rgba(136, 136, 136, 0.5);
    }
    .filter-button:hover{
        cursor: pointer;
        box-shadow: 2px 2px rgba(136, 136, 136, 0.5);
        background-color: #c8e6c9 ;
    }
    .filter-button:focus{
        outline: none;
    }
    .filter-button.green{
        border: 5px solid #66bb6a;
    }
    .filter-button.blue{
        border: 5px #42a5f5 solid;
    }
    .filter-button.red{
        border: 5px #f44336 solid;
    }
    .filter-button.black{
        border: 5px #424242 solid;
    }
    .filter-button.hold{
        border: 5px #f9a825  solid;
    }
    .filter-button.disable{
        border: 5px #8d6e63  solid;
    }
</style>
<div class="container-fluid" style="padding: 2%">

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
                        <input type="hidden" name="href" value="listCandidate">
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
                        <input type="hidden" name="href" value="listCandidate">
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
    <!-- Final Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="finalMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Final Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="finalMedical">
                        <input type="hidden" name="passportMedicalFinal" id="passportMedicalFinal" value="">
                        <div class="form-group">
                            <input class="form-control datepicker" type="text" autocomplete="off" name="finalMedicalDate" id="finalMedicalDateModal" placeholder="Enter Report Date">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="file" name="finalMedical">
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

    <!-- Test Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="testMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Test Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="testMedical">
                        <input type="hidden" name="passportMedical" id="passportMedical" value="">
                        <input class="form-control" type="file" name="testMedical">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    

    <!-- Police Clearance Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="policeClearanceFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Police Clearance File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="policeVerification">
                        <input type="hidden" name="modalPassportPolice" id="modalPassportPolice">
                        <input class="form-control" type="file" name="policeClearance">
                        
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
                        
                        <input type="hidden" name="from" value="candidateList">
                        <input type="hidden" name="trainingCardFrom" value="passport">
                        <input type="hidden" name="passportNum" id="passportNum">
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

    <!-- Passport Photo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="photoFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Passport Photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="photoMode">
                        <input type="hidden" name="passportNumModalPhoto" id="passportNumModalPhoto" value="">
                        <input class="form-control" type="file" name="photo">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Candidate List <?php 
                if(isset($_GET['specific'])){
                    if($_GET['specific'] == 'inVisa'){
                        echo " in VISA";
                    }else if($_GET['specific'] == 'inTicket'){
                        echo " in Ticket";
                    }else if($_GET['specific'] == 'unfit'){
                        echo " Unfit";
                    }else if($_GET['specific'] == 'back'){
                        echo "in VISA";
                    }else if($_GET['specific'] == 'onHold'){
                        echo " on VISA";
                    }else if($_GET['specific'] == 'disable'){
                        echo " disabled";
                    }
                }
                ?></h2>
            </div>
            <input type="hidden" id="specific_value" value="<?php echo (isset($_GET['specific']) ? $_GET['specific'] : '')?>">
            <input type="hidden" id="specific_person_pp" value="<?php echo (isset($_GET['pp']) ? $_GET['pp'] : '')?>">
            <input type="hidden" id="specific_person_cd" value="<?php echo (isset($_GET['cd']) ? $_GET['cd'] : '')?>">
            <div class="row justify-content-md-center text-center">
                <div class="col-md-1">
                    <a class="indicator-a" href="?page=listCandidate&specific=inVisa"><button class="filter-button green">In VISA</button></a>
                </div>
                <div class="col-md-1">
                    <a class="indicator-a" href="?page=listCandidate&specific=inTicket"><button class="filter-button blue">In Ticket</button></a>
                </div>
                <div class="col-md-1">
                    <a class="indicator-a" href="?page=listCandidate&specific=unfit"><button class="filter-button red">Unfit</button></a>
                </div>
                <div class="col-md-1">
                    <a class="indicator-a" href="?page=returnedListCandidate"><button class="filter-button black">Back</button></a>
                </div>
                <div class="col-md-1">
                    <a class="indicator-a" href="?page=listCandidate&specific=onHold"><button class="filter-button hold">On Hold</button></a>
                </div>
                <div class="col-md-1">
                    <a class="indicator-a" href="?page=listCandidate&specific=disable"><button class="filter-button disable">Disabled</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="list_candidate" class="table table-bordered"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Creation Date</th>
                        <th>fName</th>
                        <th>lName</th>
                        <th style="width: 150px !important;">Creation Date & Agent Name</th>
                        <th>Candidate Name</th>
                        <th>Passport No</th>
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Issue Date</th>
                        <th style="width: 70px !important;">Passport expire date</th>
                        <th>Arrival</th>
                        <th style="width: 70px !important;">Candidate previouse status</th>
                        <th>Country</th>               
                        <th>Applying for Country</th>               
                        <th>Job Id</th>               
                        <th>Agent Email</th>
                        <th>Test Medical Status</th>
                        <th>Test Medical File</th>
                        <th>Test Medical</th>
                        <th>Final Medical Status</th>
                        <th>Final Medical File</th>
                        <th>Final Medical Notification</th>
                        <th>Final Medical Report</th>
                        <th>Final Medical</th>
                        <th>Police Clearance Status</th>
                        <th>Police Clearance</th>
                        <th>Exp Status</th>                       
                        <th>Training Card Status</th>                       
                        <th>Training Card File</th>                       
                        <th>Training Card</th>                       
                        <th>Status</th>
                        <th>Disabled Reason</th>
                        <th>Edit</th>
                        <th>Test Medical Status</th>
                        <th>Final Medical Status</th>
                        <th>Visa</th>
                        <th>Ticket Filter</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr hidden>
                    <th>Creation Date</th>
                        <th>fName</th>
                        <th>lName</th>
                        <th style="width: 90px !important;">Creation Date & Agent Name</th>
                        <th>Candidate Name</th>
                        <th>Passport No</th>
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Issue Date</th>
                        <th style="width: 70px !important;">Passport expire date</th>
                        <th>Arrival</th>
                        <th style="width: 70px !important;">Candidate previouse status</th>
                        <th>Country</th>               
                        <th>Applying for Country</th>               
                        <th>Job Id</th>               
                        <th>Agent Email</th>
                        <th>Test Medical Status</th>
                        <th>Test Medical File</th>
                        <th>Test Medical</th>
                        <th>Final Medical Status</th>
                        <th>Final Medical File</th>
                        <th>Final Medical Notification</th>
                        <th>Final Medical Report</th>
                        <th>Final Medical</th>
                        <th>Police Clearance Status</th>
                        <th>Police Clearance</th>
                        <th>Exp Status</th>                       
                        <th>Training Card Status</th>                       
                        <th>Training Card File</th>                       
                        <th>Training Card</th>                       
                        <th>Status</th>
                        <th>Disabled Reason</th>
                        <th>Edit</th>
                        <th>Test Medical Status</th>
                        <th>Final Medical Status</th>
                        <th>Visa</th>
                        <th>Ticket Filter</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
</div>

<script>
    function stopNotification(info){
        info_split = info.split('_');
        passportNum = info_split[0];
        creationDate = info_split[1];
        mode = 'passport';
        href = 'listCandidate';
        $.ajax({
            type: 'post',
            url: 'template/stopNotification.php',
            data: {passportNum:passportNum, creationDate:creationDate, mode:mode, href:href},
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
			    $('#list_candidate').DataTable().ajax.reload( null , false);
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

function trainingCard(passport_info){
    $('#passportNum').val(passport_info);
}

function testMedical(passport_info){
    $('#passportMedical').val(passport_info);
}

function finalMedical(passport_info){
    var info_split = passport_info.split('_');
    $('#passportMedicalFinal').val(info_split[0]+'_'+info_split[1]);
    $('#finalMedicalDateModal').val(info_split[2]);
}

function policeClearance(passport_info){
    $('#modalPassportPolice').val(passport_info);
}
$(document).ready(function(){    
    let specific = $('#specific_value').val();
    let specific_person_pp = $('#specific_person_pp').val();
    let specific_person_cd = $('#specific_person_cd').val();
    if(specific === 'inTicket'){
        var list_candidate_table = $('#list_candidate').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "order": [[0, "desc"]],
            "info": true,
            "ScrollX": true,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 500],
                [10, 25, 50, 100, 500]
            ],
            ajax: {
                url: "<?php echo $datable_path ?>template/datatable/listCandidateDatatable.php",
                data: {specific, specific_person_pp, specific_person_cd}
            },
            "columnDefs": [
                            {
                                "targets": [ 0 ],
                                "visible": false,
                                "searchable": false
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
                                "targets": [ 12 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 14 ],
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
                                "targets": [ 20 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 21 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 22 ],
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
                                "targets": [ 27 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 28 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 30 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 31 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 33 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 34 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 35 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 36 ],
                                "visible": false,
                                "searchable": false
                            }
                        ],
            createdRow: function (row, data, index) {
                            //
                            // if the second column cell is blank apply special formatting
                            //
                            if (data[30] == "2") {
                                console.dir(row);
                                $(row).addClass("processing status-2");
                            }else if(data[30] == "1"){
                                console.dir(row);
                                $(row).addClass("processing status-1");
                            }else if(data[33] == "unfit" || data[34] == "unfit"){
                                console.dir(row);
                                $(row).addClass("processing unfit");
                            }else if(data[35] != 'null'){
                                if(data[35] == 'pending_3'){
                                    console.dir(row);
                                    $(row).addClass("processing pending_3");
                                }else if(data[35] == 'yes_ticket'){
                                    console.dir(row);
                                    $(row).addClass("processing yes_ticket");
                                }else {
                                    console.dir(row);
                                    $(row).addClass("processing no_ticket");
                                }
                            }
                            if (data[36] != 'yes_ticket') {
                                $(row).remove();
                            }
                        },
            "rowCallback": function( row, data, index ) {
                            if (data[36] != 'yes_ticket') {
                                $(row).hide();
                            }
                        }                        
        });
    }else{
        var list_candidate_table = $('#list_candidate').DataTable({
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
            ajax: {
                url: "<?php echo $datable_path ?>template/datatable/listCandidateDatatable.php",
                data: {specific, specific_person_pp, specific_person_cd}
            },
            "columnDefs": [
                            {
                                "targets": [ 0 ],
                                "visible": false,
                                "searchable": false
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
                                "targets": [ 12 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 14 ],
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
                                "targets": [ 20 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 21 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 22 ],
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
                                "targets": [ 27 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 28 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 30 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 31 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 33 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 34 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 35 ],
                                "visible": false,
                                "searchable": false
                            },
                            {
                                "targets": [ 36 ],
                                "visible": false,
                                "searchable": false
                            }
                        ],
            createdRow: function (row, data, index) {
                            //
                            // if the second column cell is blank apply special formatting
                            //
                            if (data[30] == "2") {
                                $(row).addClass("processing status-2");
                            }else if(data[30] == "1"){
                                $(row).addClass("processing status-1");
                            }else if(data[33] == "unfit" || data[34] == "unfit"){
                                $(row).addClass("processing unfit");
                            }else if(data[35] != 'null'){
                                if(data[35] == 'pending_3'){
                                    $(row).addClass("processing pending_3");
                                }else if(data[35] == 'yes_ticket'){
                                    $(row).addClass("processing yes_ticket");
                                }else {
                                    $(row).addClass("processing no_ticket");
                                }
                            }
                        }                        
        });
    }
});
// let specific = $('#specific_value').val();

$('#candidateNav').addClass('active');
</script>






