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
        <label>VISA Amount</label>
        <input class="form-control" type="number" name="visaAmount[]" placeholder="Enter Amount" required>
    </div>
    <div class="form-group col-md-6" >
        <label>Job Type. <span class="danger" id="jobType_danger" >Enter Job Type.</span> </label>
        <select class="form-control select2" name="jobType[]" required>
        <?php $result = $conn->query("SELECT jobType, jobId, creditType from jobs order by creationDate desc");?>
            <option value=""> Select Job Type </option>
            <?php while($jobs = mysqli_fetch_assoc($result)){ ?>
                <option value="<?php echo $jobs['jobId'];?>"><?php echo $jobs['jobType']." - ".$jobs['creditType'];?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-md-6" >                    
        <label>Visa Gender Type</label>
        <select class="form-control" name="gender[]" required>
            <option value="">----- Select Gender -----</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>                
</div>
<div class="form-group">
    <button class="btn btn-sm" type="button" id="add_visa" ><span class="fa fa-plus" aria-hidden="true"></span></button>
    <button class="btn btn-sm btn-danger" type="button" id="remove_visa"><span class="fas fa-minus" aria-hidden="true"></span></button>
</div>