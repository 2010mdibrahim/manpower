<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Sponsor", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$result = $conn->query("SELECT delegateId, delegateName, country from delegate order by creationDate desc");
?>

<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <input type="hidden" name="addVisaFlag" id="addVisaFlag" value="no">
        <input type="hidden" name="addCandidateFlag" id="addCandidateFlag" value="no">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Delegate</label>
                    <select class="form-control" name="delegateId" id="delegateId" onchange="selectDelegateOffice(this.value)">
                    <option value="">------ Select Delegate -------</option>
                    <?php while($delegate = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $delegate['delegateId']?>"><?php echo $delegate['delegateName']." - (".$delegate['country'].")"?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Delegate Office</label>
                    <select class="form-control" name="delegateOfficeId" id="delegateOfficeId" required>
                        <option value="">------ Select Delegate First -------</option>                    
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" placeholder="Enter Name" required>
                </div>
                <div class="form-group col-md-6" >
                    <label>Sponsor NID</label>
                    <input class="form-control" type="text" name="sponsorNid" placeholder="Enter NID" required>
                </div>                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >                    
                    <label>Sponsor Phone Number</label>
                    <input class="form-control" type="text" id="sponsorPhone" name="sponsorPhone" placeholder="Enter Number">
                </div>            
                <div class="form-group col-md-6" >                    
                    <label>Comment</label>
                    <input class="form-control" type="text" id="sponsorVisa" name="comment" placeholder="Any Remark...">
                </div>
            </div>
        </div>
        <div class="form-group">        
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label class="parking_label">Add VISA
                        <input type="radio" name="addVisa" value="yes" required>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="form-group col-md-2">
                    <label class="parking_label">Default
                        <input type="radio" name="addVisa" value="no" required checked>
                        <span class="checkmark"></span>
                    </label> 
                </div> 
            </div>
        </div>
        <div class="form-group" id="addVisaDiv">
        </div>
        <div class="form-group form-row">
            <div class="col-sm">
                <div id="assignCandidateDiv" style="display: none;">
                    <label>Assign Candidate</label>
                    <select class="form-control select2" id="assignedCandidate" name="assignedCandidate">
                    </select>
                </div>                      
            </div>                
        </div>
        <div class="form-group">        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Add">
        </div>
    </form>
</div>


<script>
    $('#sponsorNav').addClass('active');
    function addCandidate(amount){
        if(amount == 1){
            const gender = $('select[name="gender[]"]').map(function () {
                            return this.value; // $(this).val()
                        }).get();
            const jobType = $('select[name="jobType[]"]').map(function () {
                                return this.value; // $(this).val()
                            }).get();
            $.ajax({
                type: "post",
                url: "template/fetchCandidateForSponsorDirectly.php",
                data: {gender : gender[0], jobType : jobType[0]},
                success: function(response){
                    $('#addCandidateFlag').val('yes');
                    $('#assignedCandidate').html(response);
                    $('#assignCandidateDiv').show();
                }
            });
        }else{
            $('#addCandidateFlag').val('no');
            $('#assignedCandidate').html('');
            $('#assignCandidateDiv').hide();
        }
    }

    function selectDelegateOffice(delegateId){
        $.ajax({
            type: 'post',
            url: 'template/fetchDelegateOffice.php',
            data: {delegateId : delegateId},
            success: function(response){
                $('#delegateOfficeId').html(response);
            }
        });
    }
    $('body').on('click', "input[type='radio']", function(){
        const assignCandidate = $("input[name='assignCandidate']:checked").val();
        const addVisa = $("input[name='addVisa']:checked").val();
        console.log(assignCandidate);
        if(addVisa == 'yes'){
            $.ajax({
                type: 'post',
                url: 'template/addNewVisaDirectlyFromSponsor.php',
                success: function(response){
                    $('#addVisaFlag').val('yes');
                    $('#addVisaDiv').append(response);
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
        }else{
            $('#addVisaFlag').val('no');
            $('#addVisaDiv').html('');
        }
    })
    function addVisaSection(){
        console.log('add_visa');
        $.ajax({
            type: 'post',
            url: 'template/addNewVisaDirectlyFromSponsor.php',
            success: function(response){
                $('#addVisaDiv').append(response);
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
    };
    
    

    function removeVisaSection(){
        $('hr').last().remove();
        $('#addVisaDiv').children().last().remove();
    };
</script>