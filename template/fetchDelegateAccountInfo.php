<?php
include ('database.php');
$type = $_POST['particular'];
if($type == 'manpower'){
    $html = '<label>Particular Type</label>
            <select class="form-control" id="particular" name="particular" required>
                <option value="">Select Manpower Office</option>';
    $result = $conn->query("SELECT * from manpoweroffice");
    while($mapower = mysqli_fetch_assoc($result)){
        $html .= '<option>'.$mapower['manpowerOfficeName'].'</option>';;
    }
    $html .= '</select>';
}else{
    $html = '<label>Particular Type</label>
            <input class="form-control" type="text" name="particular" placeholder="Enter Office">';
}
echo $html;                       
            