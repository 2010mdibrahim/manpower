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
if(isset($_POST['agentExpenseId'])){
    $agentExpenseId = $_POST['agentExpenseId'];
}else{
    $agentExpenseId = '';
}

$expense = mysqli_fetch_assoc($conn->query("SELECT agentexpense.*, agent.agentName from agentexpense inner join agent using (agentEmail) where agentExpenseId = ".$agentExpenseId));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Edit Expense for Agent</h2>
    </div>
    
    <form action="template/addExpenseAgentQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="agentExpenseId" value="<?php echo $agentExpenseId;?>">
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent List</h3>
        <div class="form-group col-md-6" >
            <label>Select Agent Name</label>
            <select class="form-control" name="agentEmail">
                <option value="<?php echo $expense['agentEmail'];?>"><?php echo $expense['agentName'];?></option>
            </select>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-4">                    
                    <label>NID</label>
                    <input class="form-control" type="text" name="nid" id="nid" value="<?php echo $expense['candidateNID'];?>">
                </div>
                <div class="form-group col-md-4">                    
                    <label>Birth Certificate Number</label>
                    <input class="form-control" type="text" name="birthNumber" id="birthNumber" value="<?php echo $expense['candidateBirthNumber'];?>">
                </div>
                <div class="form-group col-md-4">                    
                    <label>Date Of Birth <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control datepicker" type="text" autocomplete="off" name="dob" id="dob" value="<?php echo $expense['candidateDOB'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Amount</label>
                    <input class="form-control" type="number" name="fullAmount" value="<?php echo $expense['fullAmount'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Candidate Name</label>
                    <input class="form-control" type="name" name="candidateName" value="<?php echo $expense['candidateName'];?>">
                </div>
                <div class="form-group col-md-6" >                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" value="<?php echo $expense['expensePurposeAgent'];?>">
                </div>
                <div class="form-group col-md-6" > 
                    <label>Pay Date</label>
                    <input class="form-control datepicker" type="text" name="paydate" value="<?php echo $expense['payDate'];?>">
                </div>
                <div class="form-group col-md-6">                    
                    <label>Payment Mode</label>
                    <select class="form-control" name="payMode" id="payMode">
                        <option value="">Select Payment Mode</option>
                        <?php
                        $result = $conn->query("SELECT paymentMode from paymentmethod");
                        while($payMode = mysqli_fetch_assoc($result)){ 
                            if($payMode['paymentMode'] == $expense['expenseMode']){ ?>
                                <option selected><?php echo $payMode['paymentMode'];?></option>
                            <?php }else{ ?>
                                <option><?php echo $payMode['paymentMode'];?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $expense['comment'];?>">
                </div>
            </div>
        </div>
        <div class="form-group" >       
            <input style="margin: auto; width: auto;" class="form-control" type="submit" value="Update" name="agent">
        </div>
    </form>
</div>