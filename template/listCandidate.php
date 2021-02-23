<?php
$result = $conn -> query("SELECT * from passport order by creationDate");
?>

<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }

    html {
        scroll-behavior: smooth;
    }
    .btn{
        font-size: small;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>Candidate List</h3>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="policeClearanceFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Police Clearance File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="policeVerification">
                        <input type="hidden" name="modalPassportPolice" id="modalPassportPolice" value="">
                        <input class="form-control" type="file" name="policeClearance">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="trainingCardFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Training Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="trainingCardMode">
                        <input type="hidden" name="passportNumModalTraining" id="passportNumModalTraining" value="">
                        <input class="form-control" type="file" name="trainingCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="photoFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Passport Photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="photoMode">
                        <input type="hidden" name="passportNumModalPhoto" id="passportNumModalPhoto" value="">
                        <input class="form-control" type="file" name="photo">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>Passport No</th>
                <th>Candidate Name</th> 
                <th>Country</th>               
                <th>Mobile No</th>
                <th>DOB</th>
                <th>Passport Validity</th>
                <th>Amount of experience</th>
                <th>Police Clearance</th>
                <th>Passport Photo</th>
                <th>Comment</th>
                <th>Training Card</th>
                <th hidden>Musanad</th>
                <th>Musanad Entry</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            while( $candidate = mysqli_fetch_assoc($result) ){
                $today = date("Y-m-d");
                $dateDiff = mysqli_fetch_assoc($conn -> query("SELECT datediff(arrivalDate, departureDate) as expDay, datediff(expiryDate, '$today') as passportValidity, year(dob) as dobYear from passport WHERE passportNum = '".$candidate['passportNum']."'"));

                // ----- experience days ------
                $expDays = intval($dateDiff['expDay']);
                $expMonths = 0;
                $expYears = 0;
                if($expDays > 30){
                    $expMonths = intval($expDays/30);
                    $expDays %= 30;
                    if($expMonths > 12){
                        $expYears = intval($expMonths/12);
                        $expMonths %= 12;
                    }
                }
                
                // ------- validity days -------
                $passportValidityDays = intval($dateDiff['passportValidity']);
                $passportValidityMonths = 0;
                $passportValidityYears = 0;
                if($passportValidityDays > 0){
                    if($passportValidityDays > 30){
                        $passportValidityMonths = intval($passportValidityDays/30);
                        $passportValidityDays %= 30;
                        if($passportValidityMonths > 12){
                            $passportValidityYears = intval($passportValidityMonths/12);
                            $passportValidityMonths %= 12;
                        }
                    }
                }

                // ---------- DOB -----------
                $age = intval(date("Y")) - intval($dateDiff['dobYear']) - 1;
            
              if($candidate['office'] == ''){ ?>
                    <tr id="<?php echo $candidate['passportNum'];?>">
            <?php }else{ ?>
                    <tr id="<?php echo $candidate['passportNum'];?>" style="background-color: #b2dfdb">
            <?php }
                
            ?>
                    <td><?php echo $candidate['passportNum'];?></td>
                    <td><?php echo $candidate['fName']." ".$candidate['lName'];?></td>
                    <td><?php echo $candidate['country'];?></td>                    
                    <td><?php echo $candidate['mobNum'];?></td>                    
                    <td><?php echo $age." Year";?></td>
                    <!-- Passport Validity -->
                    <td><?php
                        if($passportValidityDays < 0){
                            echo 'Passport Validity Over';
                        }else{
                            echo $passportValidityDays.' Days, ';                    
                            if($passportValidityMonths != 0){
                                echo $passportValidityMonths.' Months, ';
                                if($passportValidityYears != 0){
                                    echo $passportValidityYears.' Years.';
                                }
                            }
                        }
                    ?></td>

                    <!-- Experience Days -->
                    <td><?php 
                    if($expDays != 0){
                        if($expYears != 0){
                            echo $expYears.' Years';
                        }
                        if($expMonths != 0){
                            echo $expMonths.' Months, ';                        
                        }
                        echo $expDays.' Days.';                        
                        
                    }else{
                        echo 'No Experience';
                    }                                        
                    
                    ?></td>   
                    
                    <!-- Police Clearance -->
                    <td><?php 
                    if($candidate['policeClearance'] == 'yes'){ ?>
                        <a href="<?php echo $candidate['policeClearanceFile'];?>" target="_blank"><button class="btn btn-success">Submitted</button></a>
                    <?php }else{ ?>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#policeClearanceFileSubmit" id="policeClearancePassport" value="<?php echo $candidate['passportNum'];?>">Not Submitted</button>
                    <?php } ?>
                    </td>

                    <!-- Passport Photo -->
                    <td>
                        <?php if($candidate['passportPhoto'] == 'yes'){ ?>
                            <a href="<?php echo $candidate['passportPhotoFile'];?>" target="_blank"><button class="btn btn-success">Submitted</button></a>
                        <?php }else{ ?>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#photoFileSubmit" id="photoFile" value="<?php echo $candidate['passportNum'];?>">Not Submitted</button> 
                        <?php } ?>
                    </td>

                    <!-- comment -->
                    <td><?php 
                    if($candidate['comment'] == ''){
                        echo 'No Comment';
                    }else{
                        echo $candidate['comment'];
                    }                    
                    ?></td>

                    <!-- Training Card -->
                    <td><?php 
                    if(intval($dateDiff['expDay']) < 365){
                        if(!empty($candidate['trainingCard'])){ ?>
                            <a href="<?php echo $candidate['trainingCardFile'];?>" target="_blank"><button class="btn btn-success">Submitted</button></a>
                        <?php }else{ ?> 
                            <button class="btn btn-danger" data-toggle="modal" data-target="#trainingCardFileSubmit" id="trainingCard" value="<?php echo $candidate['passportNum'];?>">Not Submitted</button> 
                        <?php }
                    }else{
                        echo 'Not Required';
                    }
                    ?></td>

                    <!-- Musanad Ready -->
                    <td hidden>
                    <?php
                        if($candidate['policeClearance'] === 'yes' AND $candidate['passportPhoto'] === 'yes' AND $passportValidityYears >= 1){ 
                            if($expYears >= 1){ ?>
                                 <!-- --------- updating musanad ready ---------- -->
                                <?php $entry = $conn->query("UPDATE passport set musanadReady = 'ready' where passportNum = '".$candidate['passportNum']."'");?>
                                 <!-- --------- end updating musanad ready ---------- -->
                                <button type="button" class="btn btn-success" value="Ready">Ready</button>
                        <?php }else if($candidate['trainingCard'] === 'yes'){ ?>
                                 <!-- --------- updating musanad ready ---------- -->
                                <?php $entry = $conn->query("UPDATE passport set musanadReady = 'ready' where passportNum = '".$candidate['passportNum']."'");?>
                                 <!-- --------- end updating musanad ready ---------- -->
                                <button type="button" class="btn btn-success" value="Ready">Ready</button>
                        <?php }else{ ?> 
                                <!-- --------- updating musanad ready ---------- -->
                                <?php $entry = $conn->query("UPDATE passport set musanadReady = 'no' where passportNum = '".$candidate['passportNum']."'");?>
                                <!-- --------- end updating musanad ready ---------- --> 
                                <button type="button" class="btn btn-warning" value="Not Ready">Not Ready</button>
                        <?php } ?>                       
                    <?php }else{ ?>
                                <!-- --------- updating musanad ready ---------- -->
                                <?php $entry = $conn->query("UPDATE passport set musanadReady = 'no' where passportNum = '".$candidate['passportNum']."'");?>
                                <!-- --------- end updating musanad ready ---------- -->
                            <button type="button" class="btn btn-warning" value="Ready">Not Ready</button>
                    <?php } ?>
                    </td>


                    <!-- Musanad Entry -->
                    <td>
                    <?php 
                        $musanad = mysqli_fetch_assoc($conn->query("SELECT musanadReady from passport where passportNum = '".$candidate['passportNum']."'"));
                        if($musanad['musanadReady'] == 'ready'){ 
                        if($candidate['musanadEntry'] == 'no'){?>
                            <form action="template/musanadEntry.php" method="post">
                                <input type="hidden" name="passportNum" value="<?php echo $candidate['passportNum'];?>">
                                <button type="submit" class="btn btn-warning" value="yes" name="musanadReady">Not Submitted</button>
                            </form>
                        <?php }else{ ?>  
                            <form action="template/musanadEntry.php" method="post">
                                <input type="hidden" name="passportNum" value="<?php echo $candidate['passportNum'];?>">
                                <button type="submit" class="btn btn-success" value="no" name="musanadReady">Entered</button>
                            </form>
                        <?php } ?>                      
                    <?php }else{ ?>
                        <button type="button" class="btn btn-secondary" value="Not Ready">Not Ready</button>
                    <?php } ?>
                    </td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/editCandidateQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr hidden>
                <th>Passport No</th>
                <th>Candidate Name</th> 
                <th>Country</th>               
                <th>Mobile No</th>
                <th>DOB</th>
                <th>Passport Validity</th>
                <th>Amount of experience</th>
                <th>Police Clearance</th>
                <th>Passport Photo</th>
                <th>Comment</th>
                <th>Training Card</th>
                <th hidden>Musanad</th>
                <th>Musanad Entry</th>
                <th>Edit</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

<script>
$('body').on('click', '#policeClearancePassport', function(){
    // alert($("#policeClearancePassport").val());
    $('#modalPassportPolice').val($("#policeClearancePassport").val());
});
$('body').on('click', '#trainingCard', function(){
    // alert($("#trainingCard").val());
    $('#passportNumModalTraining').val($("#trainingCard").val());
});
$('body').on('click', '#photoFile', function(){
    // alert($("#trainingCard").val());
    $('#passportNumModalPhoto').val($("#photoFile").val());
});
window.onload = function() {
    $('#candidateNav').addClass('active');
};
</script>






