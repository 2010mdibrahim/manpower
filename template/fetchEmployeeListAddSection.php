<?php
include ('database.php');
$employeeId = $_POST['employeeId'];
$html = '<input type="hidden" name="employeeIdemployeeIdemployeeId" value="'.$employeeId.'">
        <div class="form-group">
            <label for="name">Employee Access</label>
            <select class="form-control select2" name="empAccess[]" multiple required>';
$result = $conn->query("SELECT employeeaccesssection.employeeId, sections.* FROM sections LEFT JOIN employeeaccesssection on employeeaccesssection.sectionId = sections.sectionId AND employeeaccesssection.employeeId = $employeeId WHERE employeeaccesssection.employeeId is NULL");
while($section = mysqli_fetch_assoc($result)){
    $html .= '<option value="'.$section['sectionId'].'">'.$section['sectionName'].'</option>';
}
$html .= '</select>
        </div>';
echo $html;