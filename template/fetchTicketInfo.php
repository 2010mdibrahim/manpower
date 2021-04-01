<?php
include ('database.php');
$candidateSelect = $_POST['candidateSelect'];
if($candidateSelect === 'inhouse'){
    $html = '<label for="sel1">Select Passport Number:</label>';
    $html .= '<select class="form-control select2" id="passport" name="passport_info" required>';
    $html .= '<option value="">Select passport</option>';
    $result = $conn->query("SELECT passportNum, fName, lName, creationDate from passport order by creationDate desc");
    while($passNo = mysqli_fetch_assoc($result)){ 
        $html .= '<option value="'.$passNo['passportNum']."_".$passNo['creationDate'].'">'.$passNo['fName']." ".$passNo['lName']." - ".$passNo['passportNum'].'</option>';
    }
    $html .= '</select>';
}else if($candidateSelect === 'new'){
$html = '<div class="form-row">
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Passenger Name: </label>
                <input class="form-control" type="text" name="name" placeholder="Enter Name" required>       
            </div>
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Mobile Number: </label>
                <input class="form-control" type="text" name="mobNum" placeholder="Enter Mobile Number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Passport Number: </label>
                <input class="form-control" type="text" name="passportNum" placeholder="Enter Passport Number" required>
            </div>
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Issue Date: </label>
                <input class="form-control datepicker" type="text" autocomplete="off" name="issueDate" placeholder="Enter Issue Date" required>
            </div>
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Passport Copy: </label>
                <input class="form-control-file" type="file" autocomplete="off" name="outsidePassportCopy" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label style="margin-right: 5px;">Referre: </label>
                <select class="form-control select2" id="referrer" name="referrer" onchange="fetchReferrer(this.value)" required>
                    <option value="">Select who reffered</option>
                    <option>Facebook</option>
                    <option>YouTube</option>
                    <option>Twitter</option>
                    <option>Instagram</option>
                    <option>News paper</option>
                    <option>Advertisement</option>
                    <option value="local">Local agent</option>
                    <option value="existing">Reffered agent</option>
                </select>
            </div>
            <div id="referrerDiv" class="col-md-8"></div>
        </div>';
}else{
    $html = '<label for="sel1">Select Passenger:</label>';
    $html .= '<select class="form-control select2" id="outsidePassportId" name="outsidePassportId" required>';
    $html .= '<option value="">Select passenger</option>';
    $result = $conn->query("SELECT * from outsidepassport order by outsidePassportId desc");
    while($passenger = mysqli_fetch_assoc($result)){ 
        $html .= '<option value="'.$passenger['outsidePassportId'].'">'.$passenger['name']." - ".$passenger['passportNum']." - ".$passenger['mobNum'].'</option>';
    }
    $html .= '</select>';
}
echo $html;