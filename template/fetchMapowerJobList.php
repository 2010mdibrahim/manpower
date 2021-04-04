<?php
include ('database.php');
$info_split = explode('_',$_POST['info']);
$manpowerJobProcessingId = $info_split[0];
$jobId = $info_split[1];
$processingCost = $info_split[2];
$manpowerOfficeId = $info_split[3];
$jobs_result = $conn->query("SELECT jobType, jobId from jobs");
$html = '<input type="hidden" name="manpowerJobProcessingId" value="'.$manpowerJobProcessingId.'">
        <input type="hidden" name="manpowerOfficeId" value="'.$manpowerOfficeId.'">
        <input type="hidden" name="processingCost" value="'.$processingCost.'">
        <div class="form-group">
            <select name="jobId" class="form-control">';
while($jobList = mysqli_fetch_assoc($jobs_result)){
    if($jobId == $jobList['jobId']){
        $html .= '<option value="'.$jobList['jobId'].'" selected>'.$jobList['jobType'].'</option>';
    }else{
        $html .= '<option value="'.$jobList['jobId'].'">'.$jobList['jobType'].'</option>';
    }
}
$html .=    '</select>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="processingCost" value="'.$processingCost.'">
        </div>';
echo $html;