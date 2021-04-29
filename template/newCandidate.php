<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script> -->
<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
} ?>
<style>
    span.danger{
        display: none;
        color: red;
        font-size: small;
    }
    .container{
        padding-bottom: 10px;
    }
    .modal-dialog {
        max-width: 80%;
        margin: 1.75rem auto;
    }
</style>


<!-- Show Agent Expense Candidate -->
<div class="modal fade" tabindex="-1" role="dialog" id="show">
    <div class="modal-dialog modal-xl" role="document">
        <form action="template/addDelegateCandidateComission.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delegate Candidate List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="existingCandidateFromAgentExpense">
                    
                        
                                       
                </div>
                <div class="modal-footer">
                    <input class="form-control datepicker w-25" autocomplete="off" type="text" name="delegatePayDate" id="delegatePayDate" placeholder="Enter Date" style="display: none;">
                    <input class="form-control-file w-25" type="file" name="delegateSlip" id="delegateSlip" style="display: none;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <div class="section-header">
        <h2>New Candidate Information</h2>
    </div>
    <form action="template/newCandidateInsert.php" method="post" enctype="multipart/form-data" id="candidateForm">
        <h4 class="bg-light">Candidate Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>First Name <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input type="text" class="form-control" required="required" name="fName" id="fName" placeholder="Enter First Name"/>
            </div>
            <div class="form-group col-md-6">
                <label>Gender <i class="fa fa-asterisk" aria-hidden="true"></i> </label>
                <select class="form-control" name="gender" id="gender" required>
                    <option value="">----- Select Gender -----</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="column col-md-6">
                <label>Last Name <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input type="text" class="form-control" required="required" name="lName" id="lName" placeholder="Enter Last Name"/>
            </div>
            <div class="form-group col-md-6 date_error">
                <label>Mobile No. <i class="fa fa-asterisk" aria-hidden="true"></i> <span class="danger" id="mobNum_danger" >Enter propur number</span> </label>
                <input type="text" class="form-control" required="required" name="mobNum" id="mobNum" placeholder="Enter Mobile Number"/>
            </div>
            <div class="form-group col-md-6">
                <label>Date of Birth <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input type="text" class="form-control datepicker" required="required" name="dob" id="dob" autocomplete="off" placeholder="yyyy/mm/dd" onchange="getCandidateFromAgentExpense(this.value)"/>
            </div>
            <div class="form-group col-md-6 date_error">
                <label>Job Type. <i class="fa fa-asterisk" aria-hidden="true"></i> </label>
                <select class="form-control select2" name="jobType" id="jobType" onchange="visaCreditType(this.value)" required>
                <?php $result = $conn->query("SELECT jobType, jobId, creditType from jobs order by creationDate desc");?>
                    <option value="">----- Select Job Type -----</option>
                    <?php while($jobs = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $jobs['jobId'].'_'.$jobs['creditType'];?>"><?php echo $jobs['jobType']." - ".$jobs['creditType'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
            <input type="hidden" value="no" id="includeCandidateFromAgent" name="includeCandidateFromAgent">                   
                <label>NID / Birth Certificate <span id="text-show" style="color: #ff3d00; display: none;" date-toggle="modal" data-target="#show">Candidate Exists In Agent Expense List <button type="button" data-target="#show" data-toggle="modal" class="btn btn-sm btn-info mr-1" style="padding: .16rem .3rem;"><i class="fas fa-eye"></i></button><button value="no" name="includeCandidate" id="includeCandidate" type="button" class="btn btn-sm btn-danger" style="padding: .16rem .3rem;" onclick="include_Candidate(this.value)"><i class="fa fa-ban"></i></button></span> </label>
                <input class="form-control" type="text" name="nid" id="nid" placeholder="Enter NID" onchange="getInfo()">
            </div>
        </div>
        <h4 class="bg-light">Passport Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport No. <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input type="text" class="form-control" required="required" name="passportNum" id="passportNum" placeholder="Enter Passport Number"/>
            </div>            
            <div class="form-group col-md-6">
                <label>Country <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <select class="form-control select2" name="country" id="country" required>
                <?php $result = $conn->query("SELECT country from delegate group by country order by creationDate desc");?>
					<option value=""> --- Select Country --- </option>
                    <?php while($country = mysqli_fetch_assoc($result)){ ?>
                        <option><?php echo $country['country'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Issue Date <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input type="text" class="form-control datepicker" autocomplete="off" required="required" name="issuD" id="issuD" placeholder="yyyy/mm/dd"/>
            </div>
            <div class="form-group col-md-6" style="text-align: center;">
                <label>Validity Year <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <div class="form-group">
                    <label class="parking_label">5 Years
                        <input type="radio" name="validityYear" value="5" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="parking_label">10 Years
                        <input type="radio" name="validityYear" value="10" required>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
        <label>New or Experienced <i class="fa fa-asterisk" aria-hidden="true"></i></label>
        <div class="form-group">            
            <div class="parking_container">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label class="parking_label">New
                            <input type="radio" name="experience" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="parking_label">Experienced
                            <input type="radio" name="experience" value="yes" required>
                            <span class="checkmark"></span>
                        </label> 
                    </div> 
                </div>
                <div id="experienced" style="display: none; background-color: rgba(0,0,0,0.04); padding: 5px; border-radius: 5px">
                    <div class="form-group form-row">
                        <div class="col-md-4">
                            <label>Departure Seal <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <input class="form-control-file" type="file" name="departureSealFile" id="departureSealFile">
                        </div>
                        <div class="col-md-4">
                            <label>Arrival Seal <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <input class="form-control-file" type="file" name="arrivalSealFile" id="arrivalSealFile">
                        </div>
                        <div class="col-md-4">
                            <label>Optional File</label>
                            <input class="form-control-file" type="file" name="optionalFile[]" id="optionalFile" multiple>
                        </div>
                        <div class="col-md-6">
                            <label>Departure Date <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <input type="text" autocomplete="off" class="form-control experience_dates datepicker" name="departureDate" placeholder="yyyy/mm/dd"/>
                        </div>
                        <div class="col-md-6">
                            <label>Arrival Date <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <input type="text" autocomplete="off" class="form-control experience_dates datepicker" name="arrivalDate" placeholder="yyyy/mm/dd"/>
                        </div>               
                    </div>
                    <div>
                        <label for="">Travelled Country <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <div class="form-group form-row" id="countryDiv">
                            <div class="col-md-3">
                                <input class="form-control" type="text" name="expCountry[]" placeholder="Enter Country Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <button class="btn btn-sm btn-primary" type="button" id="add_country" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                        <button class="btn btn-sm btn-danger" type="button" id="remove_country"><span class="fas fa-minus" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label> Manpower Office <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <select class="form-control select2" id="manpower" name="manpower" required>
                        <option value="">----- Select Job Type First ------</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="agentNotOffice">
                    <label>Agent <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <select class="form-control select2" name="agentEmail" id="agent" required>
                        <option value="">------ Select Option ------</option>
                        <?php 
                        $result = $conn->query("select agentEmail, agentName from agent");
                        while($agent = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                        <?php } ?>
                    </select>
                </div>                 
            </div>                       
        </div>
        <div class="form-row"> 
            <div class="form-group col-md-6" id="visaFee" style="display: none;">
                <label>VISA Fee</label>
                <div id="visaFeeLabel"></div>
            </div>
            <div class="form-group col-md-6" id="visaComission" style="display: none;">
                <label>Comission <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <div id="visaComissionLabel"></div>
            </div>
            
            <div class="col-md-6 text-center">
                <label for="">Advance <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <div class="form-group">
                    <label class="parking_label">Yes
                        <input type="radio" name="advance" id="advance_yes" value="yes" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="parking_label">No
                        <input type="radio" name="advance" id="advance_no" value="no" checked required>
                        <span class="checkmark"></span>
                    </label>
                </div>                
            </div>
            
        </div>
        <div class="form-row" id="advance_take" style="display: none;">
            <div class="form-group col-md-6">                    
                <label>Advance <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input class="form-control" type="number" name="advance_amount" id="advance_amount" placeholder="Enter Amount">
            </div>       
            <div class="form-group col-md-6">                    
                <label>Pay Date <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <input class="form-control datepicker" type="text" autocomplete="off" name="payDate" id="payDate" placeholder="Enter Payment Date">
            </div> 
            <div class="form-group col-md-6">                    
                <label>Payment Mode <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                <select class="form-control" name="payMode" id="payMode">
                    <option value="">Select Payment Mode</option>
                    <?php
                    $result = $conn->query("SELECT paymentMode from paymentmethod");
                    while($payMode = mysqli_fetch_assoc($result)){ ?>
                        <option><?php echo $payMode['paymentMode'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row">            
            <div class="form-group col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment" placeholder="Anything to add..."/>
            </div>
        </div>
        <h4 class="bg-light">Documents</h4>
        <div class="form-row">            
            <div class="form-group col-md-6" id="passportScanFile">
                <div>
                    <label>Passport Scanned Copy <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                    <input class="form-control" type="file" name="passportScan" required>
                </div>
            </div> 
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Police Verification <span id="policeVerificationDanger" style="font-size: small; display: none; color:red">Select Verification</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="policeVerification" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="policeVerification" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>                    
                </div>
                <div class="form-group col-md-6" id="policeFile" style="display: none;">
                    <div>
                        <label>Police Verification File</label>
                        <input class="form-control" type="file" name="policeVerification" id="policeVerification">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Passport Size Photo <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="passportPhoto" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="passportPhoto" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>                 
                </div>
                <div id="photoFile" class="form-group col-md-6" style="display: none;">
                    <div>
                        <label>Give Photo</label>
                        <input class="form-control" type="file" name="photoFile" id="photoFile_input">
                    </div>
                </div>
            </div>
        </div>  
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Full Size Photo <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="fullPhoto" value="yes">
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="fullPhoto" value="no" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>                 
                </div>
                <div id="fullPhotoDiv" class="form-group col-md-6" style="display: none;">
                    <div>
                        <label>Give Full Size Photo</label>
                        <input class="form-control" type="file" name="fullPhotoFile" id="fullPhotoFile">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" style="display: none;" id="trainingCard_div">
            <div class="row">
                <div class="col-md-6">
                    <label>Training Card <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="trainingCard" value="yes">
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="trainingCard" value="no">
                            <span class="checkmark"></span>
                        </label>
                    </div>                 
                </div>
                <div class="form-group col-md-6" id="trainingCardDiv" style="display: none;">
                    <label>Give Traning Card</label>
                    <input class="form-control" type="file" name="traningCardFile" id="traningCardFile">
                </div>
            </div>
        </div>        
        <div class="form-group">
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: auto; color: white" value="Submit" id="submit">
        </div>
    </form>
</div>


<script>
    function include_Candidate(includeCandidate){
        if(includeCandidate === 'yes') { 
            $('#includeCandidateFromAgent').val('no')
            $('#includeCandidate').val('no')
            $('#includeCandidate').removeClass('btn-success')
            $('#includeCandidate').addClass('btn-danger')
            $('#includeCandidate').children().removeClass('fas fa-check')
            $('#includeCandidate').children().addClass('fa fa-ban')
        }else{
            $('#includeCandidateFromAgent').val('yes')
            $('#includeCandidate').val('yes')
            $('#includeCandidate').removeClass('btn-danger')
            $('#includeCandidate').addClass('btn-success')
            $('#includeCandidate').children().removeClass('fa fa-ban')
            $('#includeCandidate').children().addClass('fas fa-check')
        };
    }
    function getInfo(){
        let nid = $('#nid').val();
        $.ajax({
            type: 'post',
            data: {nid:nid},
            url: 'template/fetchNewCandidateAgentExistingCandidate.php',
            success: function (response){
                if(response != ''){
                    $('#existingCandidateFromAgentExpense').html(response);
                    $('#text-show').show();
                    $('#dataTableSeaum').DataTable({
                        "fixedHeader": true,
                        "paging": true,
                        "lengthChange": true,
                        "lengthMenu": [
                            [10, 25, 50, 100, 500],
                            [10, 25, 50, 100, 500]
                        ],
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true,
                        "responsive": true,
                        "order": [],
                        "scrollX": false
                    });
                }else{
                    $('#text-show').hide();
                }
            }
        });
    }

    function getCandidateFromAgentExpense(dob){
        let fName = $('#fName').val();
        let lName = $('#lName').val();
        $.ajax({
            type: 'post',
            url: '',
            data: {fName : fName, lName : lName, dob : dob},
            success: function(){

            }
        });
    }

    $('body').on('change', '#passportNum', function(){
        const passportNum = $('#passportNum').val();
        $.ajax({
            url: 'template/checkPassport.php',
            type: 'post',
            data: {passportNum: passportNum},
            success: function(exist){
                if(exist === 'yes'){
                    $('#pass_danger').show();
                }else{
                    $('#pass_danger').hide();
                }
            }
        });
    });

    // radio toggle
    $('body').on('click', "input[type='radio']", function(){
        const fullPhoto = $("input[name='fullPhoto']:checked").val();
        const experience = $("input[name='experience']:checked").val();
        const policeVerification = $("input[name='policeVerification']:checked").val();
        const passportPhoto = $("input[name='passportPhoto']:checked").val();
        const agentOrOffice = $("input[name='agentOrOffice']:checked").val();
        const advance = $("input[name='advance']:checked").val();
        const trainingCard = $("input[name='trainingCard']:checked").val();
        if(fullPhoto == 'yes'){
            $('#fullPhotoDiv').show();
            $('#fullPhotoFile').prop('required', true);
        }else{
            $('#fullPhotoDiv').hide();
            $('#fullPhotoFile').prop('required', false);
        }

        if(trainingCard == 'yes'){
            $('#trainingCardDiv').show();
            $('#traningCardFile').prop('required',true);
        }else{
            $('#trainingCardDiv').hide();
            $('#traningCardFile').prop('required',false);
        }
        
        if(advance === 'yes'){
            $('#advance_amount').prop('required',true);
            $('#payDate').prop('required',true);
            $('#payMode').prop('required',true);
            $('#advance_take').show();
        }else if(advance === 'no'){
            $('#advance_take').hide();
            $('#advance_amount').prop('required',false);
            $('#payDate').prop('required',false);
            $('#payMode').prop('required',false);
        }

        if(experience === 'yes'){
            $('#experienced').show();
            $('#trainingCard_div').hide();
            $("input[name='trainingCard']").prop('required',false)
            $('#departureSealFile').prop('required',true);
            $('#arrivalSealFile').prop('required',true);
            $('#departureDate').prop('required',true);
            $('#arrivalDate').prop('required',true);
            $("input[name='expCountry[]']").prop('required',true);
        }else if(experience === 'no'){
            $('#experienced').hide();
            $('#trainingCard_div').show();
            $("input[name='trainingCard']").prop('required',true)
            $("input[name='expCountry[]']").prop('required',false);
            $('#departureSealFile').prop('required',false);
            $('#arrivalSealFile').prop('required',false);
            $('#departureDate').prop('required',false);
            $('#arrivalDate').prop('required',false);
        }

        if(policeVerification === 'yes'){
            $('#policeVerification').prop('required',true);
            $('#policeFile').show();
        }else if(policeVerification === 'no'){
            $('#policeVerification').prop('required',false);
            $('#policeFile').hide();
        }

        if(passportPhoto === 'yes'){
            $('#photoFile_input').prop('required',true);
            $('#photoFile').show();
        }else if(passportPhoto === 'no'){
            $('#photoFile_input').prop('required',false);
            $('#photoFile').hide();
        }
    });
    
    // form validation
    $('body').on('submit', '#candidateForm', function(){
        let mobNum = $('#mobNum').val();        

        if(mobNum.length != 11){
            $('#mobNum_danger').show();
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top - 300)
            }, 500);
            return false;
        }      
    });


    // set expiry date of passport to one year more then the issue date
    $('body').on('change', '#issuD', function(){
        let issuD = $('#issuD').val().split('-');
        issuD[0] = parseInt(issuD[0])+1;
        let newD = issuD[0] + '-' + issuD[1] + '-' + issuD[2];
        $('#expDate').attr('min', newD);
    });


    $('body').on('change', '#passportScan', function(){
        let passportScan = $('#passportScan').val();
        if(passportScan == 'yes'){
            $('#passportScanFile').show();
        }else{
            $('#passportScanFile').hide();
        }
    });

    // photo file ext verification
    $(document).ready(function(){
        $('#policeFile').click(function (){
            let image_name = $('#image').val();
            var extension = $('#image').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)
            {
                alert('Invalid Image File');
                $('#image').val('');
                return false;
            }
        });
    });

    function visaCreditType(info){
        var visaInput = document.createElement('INPUT');
        visaInput.setAttribute('class','form-control');
        visaInput.setAttribute('type', 'number');
        visaInput.setAttribute('name', 'comission');
        visaInput.setAttribute('placeholder', 'Enter Amount');
        var creditType = info.split('_');
        if(creditType[1] === 'Paid'){
            $('#visaComissionLabel').html('');
            $('#visaFeeLabel').html(visaInput);
            $('#visaFee').show();
            $('#visaComission').hide();
        }else{
            $('#visaFeeLabel').html('');
            $('#visaComissionLabel').html(visaInput);
            $('#visaFee').hide();
            $('#visaComission').show();
        }
        $.ajax({
            type: 'post',
            url: 'template/fetchManpowerOffice.php',
            data: {jobId : creditType[0]},
            success: function(response){
                $('#manpower').html(response);
            }
        });
    }
    $('#add_country').click(function(){
        var div = document.createElement("DIV");
        div.setAttribute('class', 'form-group col-md-3');
        var input = document.createElement("INPUT");
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'expCountry[]');
        input.setAttribute('class', 'form-control');
        input.setAttribute('placeholder', 'Enter Country Name');
        input.setAttribute('required','');   
        div.appendChild(input);
        $('#countryDiv').append(div);
    });
    $('#remove_country').click(function(){
        $('#countryDiv').children().last().remove();
    });

    $('#candidateNav').addClass('active');
</script>
