<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Sponsor", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                    header("Location: ../index.php");
                    exit();
            } 
        }        
    }
}
?>
<style>
    span.danger{
        display: none;
        color: red;
        font-size: small;
    }    
    
</style>


<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Sponsor's VISA</h2>
    </div>
    
    <form action="template/visaSponsorQry.php" method="post" id="sponsor_visa_submit" onsubmit="validate()">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6 date_error" >
                    <label>Select Sponsor Name <span class="danger" id="sponsor_name_danger">Enter Sponsor Name</span> </label>
                    <select class="form-control select2" name="sponsorNid" id="sponsorNid">
                        <option value="notSet">--- Select Sponsor ---</option>
                        <?php
                        $result = $conn->query("SELECT delegate.country, sponsor.sponsorNID, sponsor.sponsorName from sponsor inner join delegateoffice using (delegateOfficeId) inner join delegate on delegate.delegateId = delegateOffice.delegateId");
                        while($sponsorName = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $sponsorName['sponsorNID'];?>"><?php echo $sponsorName['sponsorName']." - ".$sponsorName['sponsorNID']." - ".$sponsorName['country'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="form-group" id="sponsor_add">
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
            </div>
            <div class="form-group">
                <button class="btn btn-sm" type="button" id="add_visa" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-danger" type="button" id="remove_visa"><span class="fas fa-minus" aria-hidden="true"></span></button>
            </div>
            <div class="form-row">
                <div class="col-sm">
                    <label>Assign Candidate</label>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label class="parking_label">Yes
                                <input type="radio" name="assignCandidate" value="yes" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="parking_label">No
                                <input type="radio" name="assignCandidate" value="no" required checked>
                                <span class="checkmark"></span>
                            </label> 
                        </div> 
                    </div>
                </div>
                <div class="col-sm">
                    <div id="assignCandidateDiv" style="display: none;">
                        <label>Assign Candidate</label>
                        <select class="form-control select2" id="assignedCandidate" name="assignedCandidate">
                        </select>
                    </div>                      
                </div>                
            </div>
            
            <div class="row">                
                <div class="form-group col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" placeholder="Enter Remark">
                </div>
            </div>
        </div>                
        <div class="form-group" >        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Add" name="sponsor">
        </div>
    </form>
</div>

<script>
    // form validation
    $('body').on('submit', '#sponsor_visa_submit', function(){       
        let sponsorNid = $('#sponsorNid').val();    
        if(sponsorNid == 'notSet'){
            $('#sponsor_name_danger').show(); 
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top - 300)
            }, 500);           
            return false;
            
        }
    });

    //assigning candidate
    $('body').on('click', "input[type='radio']", function(){
        const assignCandidate = $("input[name='assignCandidate']:checked").val();
        const gender = $('select[name="gender[]"]').map(function () {
                            return this.value; // $(this).val()
                        }).get();
        const jobType = $('select[name="jobType[]"]').map(function () {
                            return this.value; // $(this).val()
                        }).get();
        if(assignCandidate == 'yes'){
            $.ajax({
                type: "post",
                url: "template/fetchCandidate.php",
                data: {gender : gender[0], jobType : jobType[0]},
                success: function(response){
                    $('#assignedCandidate').html(response);
                    $('#assignedCandidate').prop('required',true);
                    $('#assignCandidateDiv').show();
                }
            });
        }else{
            $('#assignedCandidate').html('');
            $('#assignedCandidate').prop('required',false);
            $('#assignCandidateDiv').hide();
        }
    });

    $(function () {
        initHijrDatePicker();
    });

    function initHijrDatePicker() {
        $(".hijri-date-input").hijriDatePicker({
            locale: "en-us",
            hijri: true
        });
    }

    function initHijrDatePickerDefault() {
        $(".hijri-date-input").hijriDatePicker();
    }
    $('#sponsorNav').addClass('active');       

    $('#add_visa').click(function(){
        $.ajax({
            type: 'post',
            url: 'template/addNewVisaSection.php',
            success: function(response){
                $('#sponsor_add').append(response);
                $(".hijri-date-input").hijriDatePicker({
                    locale: "en-us",
                    hijri: true
                });
                $('.select2').select2({
                    placeholder: 'Select an option',
                    width: '100%'
                });
            }
        }); 
    });
    
    

    $('#remove_visa').click(function(){
        $('hr').last().remove();
        $('#sponsor_add').children().last().remove();
    });
</script>