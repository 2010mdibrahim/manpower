<?php
    $agentEmail = base64_decode($_GET['ag']);
    $agent = mysqli_fetch_assoc($conn->query("SELECT agentName from agent where agentEmail = '$agentEmail'"));
?>

<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Personal Expense</h2>
    </div>
    
    <form action="template/agentPersonalExpenseQry.php" method="post" id="paymentForm">
        <input type="hidden" name="agentName" value="<?php echo $agent['agentName']?>">
        <div class="form-row">
            <div class="form-group col-md-6" >
                <label>Agent Name</label>
                <select class="form-control" name="agentEmail" id="" readonly>
                    <option value="<?php echo $agentEmail?>"><?php echo $agent['agentName']?></option>
                </select>
            </div>
        </div>        
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent Expense Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Amount</label>
                    <input class="form-control" type="number" name="fullAmount" placeholder="Enter Amount" required>
                </div>
                <div class="form-group col-md-3">                    
                    <label>Purpose</label>
                    <select class="form-control" name="purpose" id="purpose" onchange="getPurpose(this.value)" required>
                        <option value="">Select Purpose</option>
                        <option value="Comission">Comission</option>
                        <option value="other">Others</option>
                    </select>
                </div>
                <div class="form-group col-md-3" id="otherPurposeDiv">                    
                </div>
                <div class="form-group col-md-6">
                    <label>Payment Date</label>
                    <input class="form-control datepicker" type="text" name="paydate" placeholder="Enter Date">
                </div>
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
    function getPurpose(purpose){
        if(purpose === 'other'){
            let div = document.createElement('DIV');
            let lable = document.createElement('LABEL');
            lable.setAttribute('for', 'otherPurpose');
            lable.innerHTML = 'Specify Purpose';
            let button = document.createElement('INPUT');
            button.setAttribute('type', 'text');
            button.setAttribute('class', 'form-control');
            button.setAttribute('name', 'otherPurpose');
            button.setAttribute('id', 'otherPurpose');
            button.setAttribute('placeholder', 'Purpose');
            button.setAttribute('required', 'required');
            div.append(lable);
            div.append(button);
            $('#otherPurposeDiv').html(div);
        }else{
            $('#otherPurposeDiv').html('');
        }
    }
</script>