<?php
if(isset($_GET['dl'])){
    $delegate_id = base64_decode($_GET['dl']);
}else{
    $delegate_id = 0;
}
$result = $conn->query("SELECT delegateId, delegateName from delegate");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    <form action="template/addDelegateExpenseQry.php" method="post">
        <div class="form-group col-md-6" >
            <label>Select Delegate Name</label>
            <select class="form-control select2" name="delegateId" id="delegateId" required>
                <option value="">--- Select Delegate ---</option>
                <?php while($delegate = mysqli_fetch_assoc($result)){?>
                    <?php if($delegate['delegateId'] == $delegate_id){?>
                        <option value="<?php echo $delegate['delegateId'];?>" selected><?php echo $delegate['delegateName'];?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $delegate['delegateId'];?>"><?php echo $delegate['delegateName'];?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent Expense Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Number of Candidates</label>
                    <input class="form-control" type="number" name="candidateNumber" placeholder="Enter Candidate Number" required>
                </div>
                <div class="form-group col-md-6">                    
                    <label>Amount</label>
                    <input class="form-control" type="number" name="amount" placeholder="Enter Amount" required>
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
    window.onload = function() {
        $('#delegateNav').addClass('active');
    };
</script>