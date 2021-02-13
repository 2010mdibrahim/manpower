<?php
    $ticketId = $_POST['ticketId'];
    $qry = "select * from ticket where ticketId=$ticketId";
    $result = mysqli_query($conn,$qry);
    $ticket = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
        <form action="template/newTicketQry.php" method="post">
            <input type="hidden" value="<?php echo $ticketId; ?>" name="ticketId">
            <div class="form-group">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control" id="passport" name="passport">
                        <option><?php echo $ticket['passportNum']; ?></option>
                </select>
            </div>
            <br>

            <h3 style="background-color: aliceblue; padding: 0.5%">Ticket information</h3>
            <div class="form-group flex-container"">
                <br>
                <div >
                    <label for="sel1">Select Airplane:</label>
                    <input class="form-control" type="text" name="airline" value="<?php echo $ticket['airplane']; ?>">
                </div>
                <br>
                <div >
                    <label for="sel1">Flight No:</label>
                    <input class="form-control" type="text" name="flightNo" placeholder="Enter Flight No" value="<?php echo $ticket['flightNo']; ?>">
                </div>
                <br>
                <div >
                    <label for="sel1">Flight Date:</label>
                    <input type="date" name="flightDate" placeholder="Flight Date" value="<?php echo $ticket['flightDate']; ?>">
                    <label for="sel1">Flight Time:</label>
                    <input type="time" name="flightTime" placeholder="Flight Time" value="<?php echo $ticket['flightTime']; ?>">
                </div>
                <br>
                <div >
                    <label for="sel1">From:</label>
                    <input type="text" name="fromPlace" placeholder="Enter From" value="<?php echo $ticket['fromPlace']; ?>">
                    <label for="sel1">To:</label>
                    <input type="text" name="toPlace" placeholder="Enter To" value="<?php echo $ticket['toPlace']; ?>">
                </div>
                <br>
                <div >
                    <label for="sel1">Amount:</label>
                    <input class="form-control" type="number" name="amount" placeholder="BDT" value="<?php echo $ticket['amount']; ?>">
                </div>
                <br>
                <div >
                    <label for="sel1">Departure:</label>
                    <input class="form-control" type="text" name="departure" placeholder="Enter Departure" value="<?php echo $ticket['departure']; ?>">
                </div>
                <br>
                <label for="sel1">Terminal:</label>
                <select class="form-control" id="terminal" name="terminal">
                    <option><?php echo $ticket['terminal']; ?></option>
                    <?php
                        for($i = 1; $i<10; $i++){
                    ?>
                        <option><?php echo $i." terminal";?></option>
                    <?php } ?>
                </select>
                <br>
                <label for="sel1">Select Agent:</label>
                <select class="form-control" id="agent" name="agent">
                    <option><?php echo $_SESSION['email'];?></option>
                </select>
                <br>
                <input type="submit" value="Update">
            </div>
        </form>
</div>