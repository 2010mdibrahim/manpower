<?php
include ('database.php');
$candidateSelect = $_POST['candidateSelect'];
if($candidateSelect === 'inhouse'){
    $html = '<label for="sel1">Select Passport Number:</label>';
    $html .= '<select class="form-control select2" id="passport" name="passport_info">';
    $html .= '<option>Select passport</option>';
    $result = $conn->query("SELECT passportNum, fName, lName, creationDate from passport order by creationDate desc");
    while($passNo = mysqli_fetch_assoc($result)){ 
        $html .= '<option value="'.$passNo['passportNum']."_".$passNo['creationDate'].'">'.$passNo['fName']." ".$passNo['lName']." - ".$passNo['passportNum'].'</option>';
    }
    $html .= '</select>';
}else if($candidateSelect === 'new'){
$html = '<div class="form-row">
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Passenger Name: </label>
                <input class="form-control" type="text" name="name" placeholder="Enter Name">       
            </div>
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Mobile Number: </label>
                <input class="form-control" type="text" name="mobNum" placeholder="Enter Mobile Number">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Passport Number: </label>
                <input class="form-control" type="text" name="passportNum" placeholder="Enter Passport Number">
            </div>
            <div class="form-group col-sm">
                <label style="margin-right: 5px;">Issue Date: </label>
                <input class="form-control datepicker" type="text" autocomplete="off" name="issueDate" placeholder="Enter Issue Date">
            </div>
        </div>';
}else{
    $html = '<label for="sel1">Select Passenger:</label>';
    $html .= '<select class="form-control select2" id="outsidePassportId" name="outsidePassportId">';
    $html .= '<option>Select passenger</option>';
    $result = $conn->query("SELECT * from outsidepassport order by outsidePassportId desc");
    while($passenger = mysqli_fetch_assoc($result)){ 
        $html .= '<option value="'.$passenger['outsidePassportId'].'">'.$passenger['name']." - ".$passenger['passportNum']." - ".$passenger['mobNum'].'</option>';
    }
    $html .= '</select>';
}
echo $html;