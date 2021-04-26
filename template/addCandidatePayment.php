<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
} ?>
<?php

$candidateName = $_POST['candidateName'];
$passport_info = explode("_",$_POST['passport_info']);
$passportNum = $passport_info[0];
$passportCreationDate = $passport_info[1];
$agentEmail = $_POST['agentEmail'];
if(isset($_POST['visaNo'])){
    $visaNo = $_POST['visaNo'];
}else{
    $visaNo = '';
}
if(isset($_POST['purpose'])){
    $purpose = $_POST['purpose'];
}else{
    $purpose = '';
}
if(isset($_POST['comission_amount'])){
    $comission_amount = $_POST['comission_amount'];
}else{
    $comission_amount = 0;
}
if(isset($_POST['comission_id'])){
    $comission_id = $_POST['comission_id'];
}else{
    $comission_id = -1;
}
$agent = mysqli_fetch_assoc($conn->query("SELECT agentName from agent where agentEmail = '$agentEmail'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense</h2>
    </div>
    
    <form action="template/addCandidatePaymentQry.php" method="post" id="paymentForm">
        <?php if(isset($_POST['redir'])){ ?>
            <input type="hidden" name="redir" value="<?php echo $_POST['redir'];?>">
        <?php }?>
        <input type="hidden" name="comission_id" value="<?php echo $comission_id?>">
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
                <select class="form-control" name="passport_info" id="" readonly>
                    <option value="<?php echo $passportNum."_".$passportCreationDate?>"><?php echo $candidateName?></option>
                </select>
            </div>
        </div>
        
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent Expense Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Full Amount</label>
                    <input class="form-control" type="number" name="fullAmount" placeholder="Enter Amount" <?php echo ($comission_id >= 0) ? 'value="'.$comission_amount.'" readonly' : '';?> required>
                </div>
                <div class="form-group col-md-6">                    
                    <label>Purpose</label>
                    <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose" <?php echo ($purpose != '') ? 'value="'.$purpose.'" readonly' : '';?> required>
                </div>
                <?php if($purpose == 'Comission' || $purpose == ''){?>
                    <?php if(!isset($_POST['notAdvance'])){ ?>
                        <div class="form-group col-md-6">
                            <label>Advance</label>
                            <input class="form-control" type="number" name="advance" id="advance" placeholder="BDT">
                        </div>                
                        <div class="form-group col-md-6">
                            <label>Advance Pay Date</label>
                            <input class="form-control datepicker" autocomplete="off" type="text" name="paydate" id="paydate" placeholder="yyyy/mm/dd">
                        </div>
                    <?php }else{ ?>
                        <div class="form-group col-md-6">
                            <label>Payment Method</label>
                            <select class="form-control" name="paymentMethod" id="" required>
                                <option value="">-- Select PM Method --</option>
                                <?php
                                $result = $conn->query("SELECT paymentMode from paymentmethod");
                                while($payMode = mysqli_fetch_assoc($result)){ ?>
                                    <option><?php echo $payMode['paymentMode'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Date</label>
                            <input class="form-control datepicker" type="text" name="paydate" value="<?php echo date('Y-m-d');?>">
                        </div>
                    <?php } ?>
                <?php }else{ ?>
                    <div class="form-group col-md-6">
                        <label>Payment Method</label>
                        <select class="form-control" name="paymentMethod" id="" required>
                            <option value="">-- Select PM Method --</option>
                            <?php
                            $result = $conn->query("SELECT paymentMode from paymentmethod");
                            while($payMode = mysqli_fetch_assoc($result)){ ?>
                                <option><?php echo $payMode['paymentMode'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Payment Date</label>
                        <input class="form-control datepicker" type="text" name="paydate" value="<?php echo date('Y-m-d');?>">
                    </div>
                <?php } ?>
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
    $(document).ready(function(){
        $("#paymentForm input[name='advance']").blur(function(){
            if($("input[name='advance']").val() === ''){
                $('#paydate').prop('required', false);
            }else{
                $('#paydate').prop('required', true);
            }
        });
    });
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>