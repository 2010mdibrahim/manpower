<?php 
include('includes/select2.php'); 
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
        <form action="template/editTIcketQry.php" method="post">
            <div class="form-group">
                <input type="hidden" name="ticketId" value="<?php echo $ticketId;?>">
                <input type="hidden" name="alter" value="update">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control" id="passport" name="passportNum">
                    <option>Select passport</option>
                    <?php 
                    $result = $conn->query("SELECT passportNum from passport");
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
            <div class="form-group flex-container">
                <br>
                <div >
                    <label for="sel1">Select Airplane:</label>
                    <input class="form-control" type="text" name="airline" value="<?php echo $ticket['airline'];?>">
                </div>
                <br>
                <div >
                    <label for="sel1">Flight No:</label>
                    <input class="form-control" type="text" name="flightNo" value="<?php echo $ticket['flightNo'];?>">
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight Date:</label>
                        <input class="form-control col-md-12" type="date" name="flightDate" value="<?php echo $ticket['flightDate'];?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sel1">From:</label>
                        <input class="form-control col-md-12" type="text" name="fromPlace" value="<?php echo $ticket['flightFrom'];?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">To:</label>
                        <input class="form-control col-md-12" type="text" name="toPlace" value="<?php echo $ticket['flightTo'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sel1">Amount:</label>
                            <input class="form-control" type="number" name="amount" value="<?php echo $ticket['ticketPrice'];?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sel1">Comment:</label>
                            <input class="form-control" type="text" name="comment" value="<?php echo $ticket['comment'];?>">
                        </div>
                    </div>
                    
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" value="Update" style="width: 50%; margin:auto">
                </div>
            </div>
        </form>
</div>
<script>
$('#passport').select2({
  placeholder: 'Select an option'
});
</script>