<?php
include ('database.php');
$type = $_POST['type'];
if($type == 'other'){                        
    $html = '<label> Name </label>
            <input class="form-control capitalize" type="text" name="officeId" placeholder="Enter Name">';
}else{
    if($type == 'outside'){
        $html = '<label> Office Name </label>
                <select class="form-control select2" id="officeSelect" name="officeId" required>
                    <option value="">Select Office</option>';
        $result = $conn->query("SELECT officeId, officeName from office");
        while($office = mysqli_fetch_assoc($result)){
            $html .= '<option>'.$office['officeName'].'</option>';
        }                          
        $html .= '</select>';
    }else{
        $html = '<label> Manpower Office Name </label>
                <select class="form-control select2" id="officeSelect" name="officeId" required>
                    <option value="">Select Office</option>';
        $result = $conn->query("SELECT manpowerOfficeId, manpowerOfficeName from manpoweroffice");
        while($office = mysqli_fetch_assoc($result)){
            $html .= '<option>'.$office['manpowerOfficeName'].'</option>';
        }                          
        $html .= '</select>';
    }
}
echo $html;