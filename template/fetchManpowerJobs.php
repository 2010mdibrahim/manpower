<?php
include ('database.php');
$html = '<div class="col-md-6">
            <div class="row">
                <div class="col-sm">                        
                    <label>Job</label>
                    <select class="form-control select2" name="jobId[]" id="" required>
                        <option value="">Select Job</option>';
$result_job = $conn->query("SELECT * from jobs");
while($jobs = mysqli_fetch_assoc($result_job)){
    $html .=            '<option value="'.$jobs['jobId'].'">'.$jobs['jobType'].'</option>';
}
$html .=            '</select>
                </div>
                <div class="col-sm">
                    <label>Processing Cost</label>
                    <input class="form-control" autocomplete="off" type="number" name="processingCost[]" placeholder="Cost" required>
                </div>
            </div>
        </div>';
echo $html;