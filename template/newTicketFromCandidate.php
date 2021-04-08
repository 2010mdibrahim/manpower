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
if(isset($_GET['p'])){
    $selectedPassport = base64_decode($_GET['p']);
    $selectedCreationDate = base64_decode($_GET['cd']);
}else{
    $selectedPassport = '';
    $selectedCreationDate = '';
}
$result = $conn->query("SELECT passportNum, fName, lName, creationDate from passport order by creationDate desc");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
        <form action="template/newTicketInsert.php" method="post" enctype="multipart/form-data">
            <div class="form-group" id="ticketInfoDiv">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control select2" id="passport" name="passport_info" required>
                    <option value="">Select passport</option>
                    <?php while($passNo = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php $passNo['passportNum']."_".$passNo['creationDate'] ?>"><?php $passNo['fName']." ".$passNo['lName']." - ".$passNo['passportNum'] ?></option>;
                    <?php } ?>
                </select>
            </div>
            <h3 style="background-color: aliceblue; padding: 0.5%">Ticket information</h3>
            <div class="form-group">                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sel1">Select Airplane:</label>
                        <input class="form-control" type="text" name="airline" placeholder="Enter Airplane Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight No:</label>
                        <input class="form-control" type="text" name="flightNo" placeholder="Enter Flight No">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight Date:</label>
                        <input class="form-control datepicker" type="text" autocomplete="off" name="flightDate" placeholder="Flight Date">
                    </div>
                    <div class="form-group col-md-3" style="text-align: center;">
                        <label>Transit</label>
                        <div class="form-group">
                            <label class="parking_label">Yes
                                <input type="radio" name="transit" id="transit" value="yes" required>
                                <span class="checkmark"></span>
                            </label>
                            <label class="parking_label">No
                                <input type="radio" name="transit" id="transit" value="no" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3" id="transitHourDiv" style="display: none;">
                        <label for="sel1">Transit:</label>
                        <input class="form-control col-md-12" type="number" name="transitHour" placeholder="Transit Hours" step="any">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight Time:</label>
                        <input class="form-control timePicker" id="time" type="text" autocomplete="off" name="flightTime" placeholder="Flight Time">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="sel1">From:</label>
                                <input class="form-control" type="text" name="fromPlace" placeholder="Enter To">
                            </div>
                            <div class="col-sm">
                                <label for="sel1">To:</label>
                                <input class="form-control" type="text" name="toPlace" placeholder="Enter To">
                            </div>
                        </div>                        
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Amount:</label>
                        <input class="form-control" type="number" name="amount" placeholder="BDT">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Ticket Copy:</label>
                        <input class="form-control-file" type="file" name="ticketCopy">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Comment:</label>
                        <input class="form-control" type="text" name="comment" placeholder="Remarks">
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" value="Submit" style="width: auto; margin:auto">
                </div>
            </div>
        </form>
</div>
<script>
    $('body').on('click', "input[type='radio']", function(){
        const transit = $("input[name='transit']:checked").val();

        const candidateSelect = $("input[name='candidateSelect']:checked").val();
        if(transit == 'yes'){
            $('#transitHourDiv').show();
        }else if(transit == 'no'){
            $('#transitHourDiv').hide();
        }else{
            if(candidateSelect === 'inhouse'){
                $.ajax({
                    type: 'post',
                    url: 'template/fetchTicketInfo.php',
                    data: {candidateSelect : candidateSelect},
                    success: function (response){
                        $('#ticketInfoDiv').html(response);
                        $('.select2').select2({
                            width: '100%'
                        });
                        $('.datepicker').datepicker({
                            format: 'yyyy/mm/dd',
                            todayHighlight:'TRUE',
                            autoclose: true,
                        })
                    }
                });
            }else if(candidateSelect === 'new'){
                $.ajax({
                    type: 'post',
                    url: 'template/fetchTicketInfo.php',
                    data: {candidateSelect : candidateSelect},
                    success: function (response){
                        $('#ticketInfoDiv').html(response);
                        $('.select2').select2({
                            width: '100%'
                        });
                        $('.datepicker').datepicker({
                            format: 'yyyy/mm/dd',
                            todayHighlight:'TRUE',
                            autoclose: true,
                        })
                    }
                });
            }else if(candidateSelect === 'new'){
                $.ajax({
                    type: 'post',
                    url: 'template/fetchTicketInfo.php',
                    data: {candidateSelect : candidateSelect},
                    success: function (response){
                        $('#ticketInfoDiv').html(response);
                        $('.select2').select2({
                            width: '100%'
                        });
                        $('.datepicker').datepicker({
                            format: 'yyyy/mm/dd',
                            todayHighlight:'TRUE',
                            autoclose: true,
                        })
                    }
                });
            }
        }
    });
    function fetchReferrer(referrer){
        if(referrer === 'local' || referrer === 'existing'){
            $.ajax({
                type: 'post',
                url: 'template/fetchRefferer.php',
                data: {referrer: referrer},
                success: function (response){
                    $('#referrerDiv').html(response);
                    $('.select2').select2({
                        width: '100%'
                    });
                }
            });
        }else{
            $('#referrerDiv').html('');
        }
    }
    $('#ticketNav').addClass('active');
</script>