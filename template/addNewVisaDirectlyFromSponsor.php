<?php
include ('database.php');
$result = $conn->query("SELECT jobId, jobType from jobs");
$html = '<div>
        <hr>
        <div class="row">
            <div class="form-group col-md-6" >
                <label>VISA No.</label>
                <input class="form-control" type="text" name="visaNo[]" placeholder="Enter VISA No." required>
            </div>
            <div class="form-group col-md-6" >
                <label>Issue Date</label>
                <input class="form-control hijri-date-input" autocomplete="off" type="text" name="issueDate[]" placeholder="Enter Issue Date" required>
            </div>            
            <div class="form-group col-md-6" >
                <label>Job Type. <span class="danger" id="jobType_danger" >Enter Job Type.</span> </label>
                <select class="form-control select2" name="jobType[]" id="jobType" required>';
$result = $conn->query("SELECT jobType, jobId, creditType from jobs order by creationDate desc");
$html .=            '<option value="">----- Select Job Type -----</option>';
            while($jobs = mysqli_fetch_assoc($result)){
$html .=            '<option value="'.$jobs['jobId'].'">'.$jobs['jobType'].' - '.$jobs['creditType'].'</option>';
            }
$html .=        '</select>
            </div>
            <div class="form-group col-md-6" >                    
                <label>Visa Gender Type</label>
                <select class="form-control" name="gender[]" required>
                    <option value="">----- Select Gender -----</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="form-group col-md-6" >
                <label>VISA Amount</label>
                <input class="form-control" type="number" name="visaAmount[]" placeholder="Enter Amount" onkeyup="addCandidate(this.value)" required>
            </div>              
        </div>
        <div class="form-group">
            <button class="btn btn-sm" type="button" id="add_visa" onclick="addVisaSection()"><span class="fa fa-plus" aria-hidden="true"></span></button>
            <button class="btn btn-sm btn-danger" type="button" id="remove_visa" onclick="removeVisaSection()"><span class="fas fa-minus" aria-hidden="true"></span></button>
        </div></div>';
echo $html;