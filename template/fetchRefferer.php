<?php
include ('database.php');
$referrer = $_POST['referrer'];
if($referrer == 'local'){
$html = '<div class="row">
        <div class="form-group col-sm">
            <label style="margin-right: 5px;">Local Agent Name: </label>
            <input class="form-control" type="text" autocomplete="off" name="localAgentName" placeholder="Enter name" required>
        </div>
        <div class="form-group col-sm">
            <label style="margin-right: 5px;">Local Agent Mobile Number: </label>
            <input class="form-control" type="text" autocomplete="off" name="localAgentMob" placeholder="mobNum" required>
        </div>
        </div>';
}else{
$result = $conn->query("SELECT agentName, agentEmail from agent");
                
$html = '<div class="row">
        <div class="form-group col-sm">
            <label style="margin-right: 5px;">Reffered Agent Name: </label>
            <select class="form-control select2" name="referredAgent" required>
                <option value="">Select Agent</option>';
while($agent = mysqli_fetch_assoc($result)){
    $html .=    '<option value="'.$agent['agentEmail'].'">'.$agent['agentName'].'</option>';
}
$html .=    '</select>
        </div>
        </div>';
}
echo $html;