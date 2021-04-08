<?php 
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
if(isset($_POST['ticketId'])){
    $ticketId = $_POST['ticketId'];
}else{
    $ticketId = '';
}
$ticket = mysqli_fetch_assoc($conn->query("SELECT * from ticket where ticketId = $ticketId"));
?>


<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
        <form action="template/editTIcketQry.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="ticketId" value="<?php echo $ticketId;?>">
                <input type="hidden" name="alter" value="update">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control select2" id="passport" name="passportNum">
                    <option>Select passport</option>
                    <?php 
                    $result = $conn->query("SELECT passportNum from passport order by creationDate desc");
                    while($passNo = mysqli_fetch_assoc($result)){ 
                        if($ticket['passportNum'] == $passNo['passportNum']){ ?>
                            <option selected><?php echo $passNo['passportNum']; ?></option>
                        <?php }else{ ?>
                            <option><?php echo $passNo['passportNum']; ?></option>                        
                    <?php } } ?>
                </select>
            </div>
            <br>

            <h3 style="background-color: aliceblue; padding: 0.5%">Ticket information</h3>
            <div class="form-group">                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sel1">Select Airplane:</label>
                        <input class="form-control" type="text" name="airline" value="<?php echo $ticket['airline'];?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight No:</label>
                        <input class="form-control" type="text" name="flightNo" value="<?php echo $ticket['flightNo'];?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight Date:</label>
                        <input class="form-control datepicker" type="text" autocomplete="off" name="flightDate" value="<?php echo $ticket['flightDate'];?>">
                    </div>
                    <div class="form-group col-md-3" style="text-align: center;">
                        <label>Transit</label>
                        <?php if($ticket['transit'] != 0.0){?>
                            <div class="form-group">
                                <label class="parking_label">Yes
                                    <input type="radio" name="transit" id="transit" value="yes" checked required>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="parking_label">No
                                    <input type="radio" name="transit" id="transit" value="no" required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php }else{ ?>
                            <div class="form-group">
                                <label class="parking_label">Yes
                                    <input type="radio" name="transit" id="transit" value="yes" required>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="parking_label">No
                                    <input type="radio" name="transit" id="transit" value="no" checked required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3" id="transitHourDiv" style="display: <?php echo ($ticket['transit'] == 0.0) ? 'none' : 'static';?>;">
                        <label for="sel1">Transit:</label>
                        <input class="form-control col-md-12" type="number" name="transitHour" value="<?php echo $ticket['transit']; ?>" step="any">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight Time:</label>
                        <input class="form-control" id="time" type="time" autocomplete="off" name="flightTime" value="<?php echo $ticket['flightTime']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="row">
                            <div class="col-sm">
                                <label for="sel1">From:</label>
                                <input class="form-control" type="text" name="fromPlace" value="<?php echo $ticket['flightFrom'];?>">
                            </div>
                            <div class="col-sm">
                                <label for="sel1">To:</label>
                                <input class="form-control" type="text" name="toPlace" value="<?php echo $ticket['flightTo'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Amount:</label>
                        <input class="form-control" type="number" name="amount" value="<?php echo $ticket['ticketPrice'];?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Ticket Copy:</label>
                        <input class="form-control-file" type="file" name="ticketCopy">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Comment:</label>
                        <input class="form-control" type="text" name="comment" value="<?php echo $ticket['comment'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" value="Update" style="width: 50%; margin:auto">
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

    window.onload = function() {
        $('#ticketNav').addClass('active');
    };
</script>