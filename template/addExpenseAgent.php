<?php
$result = $conn->query("SELECT agentName, agentEmail from agent");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    <form action="template/addExpenseAgentQry.php" method="post">
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent List</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Select Agent Name</label>
                    <select class="form-control" name="agentEmail">
                        <option>--- Select Agent ---</option>
                        <?php while($agent = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Full Amount</label>
                    <input class="form-control" type="number" name="fullAmount" placeholder="Enter Amount">
                    <br>
                    <label>Advance</label>
                    <input class="form-control" type="number" name="advance" value="0">
                    <br>
                </div>
                <div class="column col-md-6" >                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose">
                    <!-- <select class="form-control" name="purpose">
                        <option>----- Select Gender -----</option>
                        <option>Receive</option>
                        <option>Give</option>
                    </select> -->
                    <br>
                    <label>Pay Date</label>
                    <input class="form-control" type="date" name="paydate" >
                </div>
                <div class="column col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" placeholder="Enter Remark">
                    <br>

                </div>
            </div>
        </div>
        <br>        
        <input type="submit" value="Add" name="agent">
    </form>
</div>