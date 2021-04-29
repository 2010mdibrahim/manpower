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
                <div class="form-group col-md-4">                    
                    <label>NID</label>
                    <input class="form-control" type="text" name="nid" id="nid" placeholder="Enter NID" onchange="getInfo()">
                </div>
                <div class="form-group col-md-4">                    
                    <label>Birth Certificate Number</label>
                    <input class="form-control" type="text" name="birthNumber" id="birthNumber" placeholder="Enter Birth Certificate Number" onchange="getInfo()">
                </div>
                <div class="form-group col-md-4">                    
                    <label>Date Of Birth <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control datepicker" type="text" autocomplete="off" name="dob" id="dob" placeholder="Enter Birth Date" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Full Amount <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control" type="number" name="fullAmount" placeholder="Enter Amount" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Candidate Name <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control capitalize" type="name" name="candidateName" id="candidateName" placeholder="Enter Candidate Name" required>
                </div>
                <div class="form-group col-md-6">                    
                    <label>Purpose <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control" type="text" name="purpose" placeholder="Enter Purpose" required>
                </div>       
                <div class="form-group col-md-6">                    
                    <label>Pay Date <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control datepicker" type="text" autocomplete="off" name="paydate" placeholder="Enter Payment Date" required>
                </div>                
                <div class="form-group col-md-6">                    
                    <label>Payment Mode <i class="fa fa-asterisk" aria-hidden="true"></i></label>
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

    function getInfo(){
        let nid = $('#nid').val();
        let birthNumber = $('#birthNumber').val();
        $.ajax({
            type: 'post',
            data: {nid:nid, birthNumber:birthNumber},
            url: 'template/fetchAgentExistingCandidate.php',
            success: function (response){
                response = JSON.parse(response);
                $('#nid').val(response.nid);
                if(response.nid != ''){
                    document.getElementById('nid').style.backgroundColor = "#bbdefb";
                }
                $('#birthNumber').val(response.birthNumber);
                if(response.birthNumber != ''){
                    document.getElementById('birthNumber').style.backgroundColor = "#bbdefb";
                }
                $('#dob').val(response.dob);
                if(response.dob != ''){
                    document.getElementById('dob').style.backgroundColor = "#bbdefb";
                }
                $('#candidateName').val(response.candidateName);
                if(response.candidateName != ''){
                    document.getElementById('candidateName').style.backgroundColor = "#bbdefb";
                }
            }
        });
    }
</script>