<?php
$candidateName = $_POST['candidateName'];
$passportNum = $_POST['passportNum'];
$agentEmail = $_POST['agentEmail'];

if(isset($_POST['expenseId'])){
    $expenseId = $_POST['expenseId'];
}else{
    $expenseId = -1;
}
if(isset($_POST['advanceId'])){
    $advanceId = $_POST['advanceId'];
}else{
    $advanceId = -1;
}
if(isset($_POST['advanceAmount'])){
    $advanceAmount = $_POST['advanceAmount'];
}else{
    $advanceAmount = -1;
}
if(isset($_POST['visaNo'])){
    $visaNo = $_POST['visaNo'];
}else{
    $visaNo = '';
}
if(isset($_POST['payDate'])){
    $payDate = $_POST['payDate'];
}else{
    $payDate = '';
}
if(isset($_POST['purpose'])){
    $purpose = $_POST['purpose'];
}else{
    $purpose = '';
}
if(isset($_POST['advancePayMode'])){
    $payMode = $_POST['advancePayMode'];
}else if(isset($_POST['payMode'])){
    $payMode = $_POST['payMode'];
}else{
    $payMode = '';
}
print_r($payMode);
$amount = $_POST['amount'];
$agent = mysqli_fetch_assoc($conn->query("SELECT agentName from agent where agentEmail = '$agentEmail'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Edit Expense</h2>
    </div>
    <?php echo $advanceAmount.":";?>
    <form action="template/addCandidatePaymentQry.php" method="post">
        <input type="hidden" name="advanceId" value="<?php echo $advanceId; ?>">
        <input type="hidden" name="expenseId" value="<?php echo $expenseId; ?>">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="visaNo" value="<?php echo $visaNo; ?>">
        <div class="form-row">
            <div class="form-group col-md-6" >
                <label>Agent Name</label>
                <select class="form-control" name="agentEmail" id="" readonly>
                    <option value="<?php echo $agentEmail?>"><?php echo $agent['agentName']?></option>
                </select>
            </div>
            <div class="form-group col-md-6" >
                <label>Candidate Name</label>
                <select class="form-control" name="passportNum" id="" readonly>
                    <option value="<?php echo $passportNum?>"><?php echo $candidateName?></option>
                </select>
            </div>
        </div>
        
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent Expense Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Full Amount</label>
                    <input class="form-control" type="number" name="fullAmount" value="<?php echo $amount; ?>" <?php echo ($advanceId > 0) ? 'readonly' : '';?>>
                </div>
                <div class="form-group col-md-6">                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose" <?php echo ($purpose != '') ? 'value="'.$purpose.'" readonly' : '';?> >
                </div>
                <?php if($purpose == 'Comission' && $advanceAmount > 0){?>
                    <div class="form-group col-md-6">
                        <label>Advance</label>
                        <input class="form-control" type="number" name="advance" value="<?php echo $advanceAmount; ?>">
                    </div>                
                    <div class="form-group col-md-6">
                        <label>Advance Pay Date</label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="paydate" value="<?php echo $payDate; ?>">
                    </div> 
                <?php } ?> 
                <div class="form-group col-md-6">
                    <label>Payment Method</label>
                    <select class="form-control" name="paymentMethod" id="">
                        <?php if($payMode == 'Cash'){?>
                            <option selected>Cash</option>
                            <option>Bkash</option>
                        <?php }else{?>
                            <option>Cash</option>
                            <option selected>Bkash</option>
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
            <input style="width: auto; margin: auto;" class="form-control" type="submit" value="Update" name="agent">
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>