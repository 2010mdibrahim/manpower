<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Agent", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_GET['ag'])){
    $agentEmail = base64_decode($_GET['ag']);
}else{
    $agentEmail = '';
}
$result = $conn->query("SELECT agentName, agentEmail from agent");
?>
<style>
.capitalize{
    text-transform: capitalize;
}
</style>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    <form action="template/addExpenseAgentQry.php" method="post">
        <div class="form-group col-md-6" >
            <label>Select Agent Name</label>
            <select class="form-control select2" name="agentEmail" id="agentEmail" required>
                <option value="">--- Select Agent ---</option>
                <?php while($agent = mysqli_fetch_assoc($result)){?>
                    <?php if($agent['agentEmail'] == $agentEmail){?>
                        <option value="<?php echo $agent['agentEmail'];?>" selected><?php echo $agent['agentName'];?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent Expense Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Full Amount</label>
                    <input class="form-control" type="number" name="fullAmount" placeholder="Enter Amount" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Candidate Name</label>
                    <input class="form-control capitalize" type="name" name="candidateName" placeholder="Enter Candidate Name" required>
                </div>
                <div class="form-group col-md-6">                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose" required>
                </div>       
                <div class="form-group col-md-6">                    
                    <label>Pay Date</label>
                    <input class="form-control datepicker" type="text" autocomplete="off" name="paydate" placeholder="Enter Payment Date" required>
                </div> 
                <div class="form-group col-md-6">                    
                    <label>Payment Mode</label>
                    <select class="form-control" name="payMode" id="" required>
                        <option value="">Select Payment Mode</option>
                        <?php
                        $result = $conn->query("SELECT paymentMode from paymentmethod");
                        while($payMode = mysqli_fetch_assoc($result)){ ?>
                            <option><?php echo $payMode['paymentMode'];?></option>
                        <?php } ?>
                    </select>
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
    $('#agentNav').addClass('active');
</script>