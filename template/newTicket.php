<?php include('includes/select2.php'); ?>


<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
        <form action="template/newTicketInsert.php" method="post">
            <div class="form-group">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control select2" id="passport" name="passportNum">
                    <option>Select passport</option>
                    <?php 
                    $result = $conn->query("SELECT passportNum, fName, lName from passport");
                    while($passNo = mysqli_fetch_assoc($result)){ 
                    ?>
                        <option><?php echo $passNo['fName']." ".$passNo['lName']." - ".$passNo['passportNum']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>

            <h3 style="background-color: aliceblue; padding: 0.5%">Ticket information</h3>
            <div class="form-group flex-container">
                <div class="form-group">
                    <label for="sel1">Select Airplane:</label>
                    <input class="form-control" type="text" name="airline" placeholder="Enter Airplane Name">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight No:</label>
                        <input class="form-control" type="text" name="flightNo" placeholder="Enter Flight No">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">Flight Date:</label>
                        <input class="form-control col-md-12" type="date" name="flightDate" placeholder="Flight Date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sel1">From:</label>
                        <input class="form-control col-md-12" type="text" name="fromPlace" placeholder="Enter From">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sel1">To:</label>
                        <input class="form-control col-md-12" type="text" name="toPlace" placeholder="Enter To">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sel1">Amount:</label>
                            <input class="form-control" type="number" name="amount" placeholder="BDT">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sel1">Comment:</label>
                            <input class="form-control" type="text" name="comment" placeholder="Remarks">
                        </div>
                    </div>                    
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" value="Submit" style="width: auto; margin:auto">
                </div>
            </div>
        </form>
</div>
<script>
    window.onload = function() {
        $('#ticketNav').addClass('active');
    };
</script>