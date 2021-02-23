<?php

$result = $conn->query("SELECT agentName, agentEmail from agent");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    <form action="template/addExpenseAgentQry.php" method="post">
        <div class="form-group col-md-6" >
            <label>Select Agent Name</label>
            <select class="form-control select2" name="agentEmail" id="agentEmail">
                <option>--- Select Agent ---</option>
                <?php while($agent = mysqli_fetch_assoc($result)){?>
                    <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                <?php } ?>
            </select>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent Expense Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Full Amount</label>
                    <input class="form-control" type="number" name="fullAmount" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-6">
                    <label>Advance</label>
                    <input class="form-control" type="number" name="advance" value="0">
                </div>
                <div class="form-group col-md-6">                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose">
                </div>
                <div class="form-group col-md-6">
                    <label>Pay Date</label>
                    <input class="form-control" type="date" name="paydate" >
                </div>
                <div class="form-group col-md-6">
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" placeholder="Enter Remark">
                </div>
            </div>
        </div>
        <div class="form-group" >       
            <input style="width: auto; margin: auto;" class="form-control" type="submit" value="Add" name="agent">
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>