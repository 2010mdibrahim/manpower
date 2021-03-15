<?php
if(isset($_GET['p'])){
    $selectedPassport = base64_decode($_GET['p']);
    $selectedCreationDate = base64_decode($_GET['cd']);
}else{
    $selectedPassport = '';
    $selectedCreationDate = '';
}
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
        <form action="template/newTicketInsert.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control select2" id="passport" name="passport_info">
                    <option>Select passport</option>
                    <?php 
                    $result = $conn->query("SELECT passportNum, fName, lName, creationDate from passport order by creationDate desc");
                    while($passNo = mysqli_fetch_assoc($result)){ 
                        if($passNo['passportNum'] == $selectedPassport && $passNo['creationDate'] == $selectedCreationDate){
                    ?>
                        <option value="<?php echo $passNo['passportNum']."_".$passNo['creationDate']; ?>" selected><?php echo $passNo['fName']." ".$passNo['lName']." - ".$passNo['passportNum']; ?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $passNo['passportNum']."_".$passNo['creationDate']; ?>"><?php echo $passNo['fName']." ".$passNo['lName']." - ".$passNo['passportNum']; ?></option>
                    <?php } } ?>
                </select>
            </div>
            <br>

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
                    <!-- <div class="form-group col-md-6">
                        <label for="sel1">From:</label>
                        <input class="form-control col-md-12" type="text" name="fromPlace" placeholder="Enter From">
                    </div> -->
                    <div class="form-group col-md-6">
                        <label for="sel1">To:</label>
                        <input class="form-control col-md-12" type="text" name="toPlace" placeholder="Enter To">
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
        if(transit == 'yes'){
            $('#transitHourDiv').show();
        }else{
            $('#transitHourDiv').hide();
        }
        
    });
    $('#ticketNav').addClass('active');
</script>