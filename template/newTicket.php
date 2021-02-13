<?php
    $qry = "select passNo from passport";
    $result = mysqli_query($conn,$qry);

?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Ticket</h2>
    </div>
        <form action="template/newTicketInsert.php" method="post">
            <div class="form-group">
                <label for="sel1">Select Passport Number:</label>
                <select class="form-control" id="passport" name="passport">
                    <option>Select passport</option>
                    <?php while($passNo = mysqli_fetch_assoc($result)){ ?>
                        <option><?php echo $passNo['passNo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>

            <h3 style="background-color: aliceblue; padding: 0.5%">Ticket information</h3>
            <div class="form-group flex-container"">
                <br>
                <div >
                    <label for="sel1">Select Airplane:</label>
                    <input class="form-control" type="text" name="airline" placeholder="Enter Airplane Name">
                </div>
                <br>
                <div >
                    <label for="sel1">Flight No:</label>
                    <input class="form-control" type="text" name="flightNo" placeholder="Enter Flight No">
                </div>
                <br>
                <div >
                    <label for="sel1">Flight Date:</label>
                    <input type="date" name="flightDate" placeholder="Flight Date">
                    <label for="sel1">Flight Time:</label>
                    <input type="time" name="flightTime" placeholder="Flight Time">
                </div>
                <br>
                <div >
                    <label for="sel1">From:</label>
                    <input type="text" name="fromPlace" placeholder="Enter From">
                    <label for="sel1">To:</label>
                    <input type="text" name="toPlace" placeholder="Enter To">
                </div>
                <br>
                <div >
                    <label for="sel1">Amount:</label>
                    <input class="form-control" type="number" name="amount" placeholder="BDT">
                </div>
                <br>
                <div >
                    <label for="sel1">Departure:</label>
                    <input class="form-control" type="text" name="departure" placeholder="Enter Departure">
                </div>
                <br>
                <label for="sel1">Terminal:</label>
                <select class="form-control" id="terminal" name="terminal">
                    <option><?php echo "Select terminal";?></option>
                    <?php
                        for($i = 1; $i<10; $i++){
                    ?>
                        <option><?php echo $i." terminal";?></option>
                    <?php
                        }
                        $qry = "select agentId, agentName from agent";
                        $result = mysqli_query($conn,$qry);
                    ?>
                </select>
                <br>
                <label for="sel1">Select Agent:</label>
                <select class="form-control" id="agent" name="agent">
                    <?php while($agent = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $agent['agentId'];?>"><?php echo $agent['agentName'];?></option>
                    <?php } ?>
                </select>
                <br>
                <input type="submit" value="submit">
            </div>
        </form>
</div>