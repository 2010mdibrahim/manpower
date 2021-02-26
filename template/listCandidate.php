<?php
$result = $conn -> query("SELECT *, DATE(creationDate) as creationDate from passport order by creationDate desc");
?>

<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }

    html {
        scroll-behavior: smooth;
    }
    
</style>
<div class="container-fluid" style="padding: 2%">
    <!-- Final Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="finalMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Test Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="finalMedical">
                        <input type="hidden" name="passportMedicalFinal" id="passportMedicalFinal" value="">
                        <input class="form-control" type="file" name="finalMedical">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Test Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="testMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Test Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="testMedical">
                        <input type="hidden" name="passportMedical" id="passportMedical" value="">
                        <input class="form-control" type="file" name="testMedical">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    

    <!-- Police Clearance Modal -->
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


    <!-- Training Card Modal -->
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

    <!-- Passport Photo Modal -->
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
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Candidate List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Passport No</th>
                        <th>Candidate Name</th> 
                        <th>Country</th>               
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Passport Validity</th>
                        <th>Amount of experience</th>
                        <th>Police Clearance</th>
                        <th>Passport Photo</th>
                        <th>Test Medical</th>
                        <th>Final Medical</th>
                        <th>Creation Date</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <?php
                    while( $candidate = mysqli_fetch_assoc($result) ){

                        // ----- experience days ------
                        $arrivalDate = new DateTime($candidate['arrivalDate']);
                        $departureDate = new DateTime($candidate['departureDate']);
                        $experience = $departureDate->diff($arrivalDate);
                        
                        // ------- validity days -------
                        $expiryDate = new DateTime($candidate['issueDate']); // will add validity to this date thats why it is expiry date
                        $issueDate = new DateTime($candidate['issueDate']);
                        $format = "P".$candidate['validity']."Y";
                        $expiryDate->add(new DateInterval($format));
                        $validity = $expiryDate->diff($issueDate);

                        // ---------- DOB -----------
                        $today = new Datetime(date('Y-m-d'));
                        $bday = new Datetime($candidate['dob']);
                        $age = $today->diff($bday);
                    
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
                        <td><?php printf('%d years', $age->y);?></td>

                        <!-- Passport Validity -->
                        <td><?php 
                        $noVal = true;
                        if($validity->y != 0){
                            echo $validity->y.' Years; ';
                            $noVal = false;
                        }
                        if($validity->m != 0){
                            echo $validity->m.' Months; ';   
                            $noVal = false;                     
                        }
                        if($validity->d != 0){
                            echo $validity->d.' Days.';
                            $noVal = false;
                        }
                        if($noVal){
                            echo 'No Validity';
                        } 
                        ?></td>

                        <!-- Experience Days -->
                        <td><?php
                        $noExp = true;
                        if($experience->y != 0){
                            echo $experience->y.' Years; ';
                            $noExp = false;
                        }
                        if($experience->m != 0){
                            echo $experience->m.' Months; ';
                            $noExp = false;                        
                        }
                        if($experience->d != 0){
                            echo $experience->d.' Days.';
                            $noExp = false;
                        }
                        if($noExp){
                            echo 'New';
                        }                                        
                        
                        ?></td>   
                        
                        <!-- Police Clearance -->
                        <td><?php 
                        if($candidate['policeClearance'] == 'yes'){ ?>
                            <a href="<?php echo $candidate['policeClearanceFile'];?>" target="_blank"><button class="btn btn-success btn-sm">Submitted</button></a>
                        <?php }else{ ?>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#policeClearanceFileSubmit" id="policeClearancePassport" value="<?php echo $candidate['passportNum'];?>">Not Submitted</button>
                        <?php } ?>
                        </td>

                        <!-- Passport Photo -->
                        <td>
                            <?php if($candidate['passportPhoto'] == 'yes'){ ?>
                                <a href="<?php echo $candidate['passportPhotoFile'];?>" target="_blank"><button class="btn btn-success btn-sm">Submitted</button></a>
                            <?php }else{ ?>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#photoFileSubmit" id="photoFile" value="<?php echo $candidate['passportNum'];?>">Not Submitted</button> 
                            <?php } ?>
                        </td>

                        <!-- Test Medical -->
                        <td class="second">  
                        <?php if($candidate['policeClearance'] != 'yes' || $candidate['passportPhoto'] != 'yes'){ ?>     
                            <button class="btn btn-warning btn-sm">Do Previous</button>             
                        <?php }else if(empty($candidate['testMedical']) || $candidate['testMedical']=='no'){ ?>
                            <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile">No</button>
                        <?php } else { ?>
                            <a href="<?php echo $candidate['testMedicalFile'];?>" target="_blank"><button class="btn btn-primary btn-sm">OK</button></a>
                        <?php } ?></td>

                        <!-- Training Card -->
                        <!-- <td><?php 
                        if(intval($date_from_database['expDay']) < 365){
                            if(!empty($candidate['trainingCard'])){ ?>
                                <a href="<?php echo $candidate['trainingCardFile'];?>" target="_blank"><button class="btn btn-success btn-sm">Submitted</button></a>
                            <?php }else{ ?> 
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#trainingCardFileSubmit" id="trainingCard" value="<?php echo $candidate['passportNum'];?>">Not Submitted</button> 
                            <?php }
                        }else{
                            echo 'Not Required';
                        }
                        ?></td> -->


                        <!-- Final Medical -->
                        <td class="second"><?php
                        if(empty($candidate['testMedical']) || $candidate['testMedical']=='no' || $candidate['policeClearance'] != 'yes' || $candidate['passportPhoto'] != 'yes'){ ?>
                            <button class="btn btn-warning btn-sm">Do Previous</button>
                        <?php }else if(empty($candidate['finalMedical']) || $candidate['finalMedical']=='no'){ ?>
                            <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum'];?>" name="testMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile">No</button>
                        <?php } else { ?>
                            <a href="<?php echo $candidate['finalMedicalFile'];?>" target="_blank"><button class="btn btn-primary btn-sm">OK</button></a>
                        <?php } ?></td>

                        <td><?php echo $candidate['creationDate'];?></td>

                        <!-- Edit Section -->
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
                        <th>Age</th>
                        <th>Passport Validity</th>
                        <th>Amount of experience</th>
                        <th>Police Clearance</th>
                        <th>Passport Photo</th>
                        <th>Test Medical</th>
                        <th>Final Medical</th>
                        <th>Creation Date</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
    
</div>

<script>
$('body').on('click', '#testMedicalFile', function(){
    $('#passportMedical').val($('#testMedicalFile').val());
});

$('body').on('click', '#finalMedicalFile', function(){
    $('#passportMedicalFinal').val($('#finalMedicalFile').val());
});

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






