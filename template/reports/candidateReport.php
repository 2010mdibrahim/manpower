<?php
    $stage_info = explode('-',$_GET['stage']);
    $stage = $stage_info[0];
    $table = $stage_info[1];
    if($table == 'passport'){
        $result = $conn -> query("SELECT passport.*, DATE(passport.creationDate) as creationDateShow, agent.agentName from passport inner join agent using (agentEmail) where $stage = 'yes' order by passport.creationDate desc");
    }else{
        $result = $conn -> query("SELECT processing.*,passport.*, DATE(passport.creationDate) as creationDateShow, agent.agentName from passport inner join agent on passport.agentEmail = agent.agentEmail inner join processing using (passportNum) where processing.$stage = 'yes' order by passport.creationDate desc");
    }
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
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <p style="font-size: 25px;">
                Candidate Report for                
                <span style="font-size: 35px;"> 
                <?php
                switch ($stage){
                    case 'testMedical':
                        echo "'Test Medical'";
                        break;
                }
                ?>
                </span></p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Creation Date</th>
                        <th>Agent</th>
                        <th>Candidate Name</th>
                        <th>Passport No</th>
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Passport expire date</th>
                        <th>Candidare previouse status</th>
                        <th>Applying for Country</th>                       
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
                        $today = new DateTime(date('Y-m-d'));
                        $format = "P".$candidate['validity']."Y";
                        $expiryDate->add(new DateInterval($format));
                        $validity = $expiryDate->diff($today);

                        // ---------- DOB -----------
                        $today = new Datetime(date('Y-m-d'));
                        $bday = new Datetime($candidate['dob']);
                        $age = $today->diff($bday);
                    
                        if($age->y < 25){ ?>
                            <tr style="background-color: #e8f5e9;">
                        <?php }else if($age->y > 38){ ?>
                            <tr style="background-color: #fffde7;">
                        <?php }else{ ?>
                            <tr>
                        <?php } ?>

                        <!-- Creation Date -->
                        <td><?php echo $candidate['creationDateShow'];?></td>
                        <td><?php echo $candidate['agentName'];?></td>
                        <td>
                        <a href="?page=listCandidate&pp=<?php echo base64_encode($candidate['passportNum']);?>" target="_blank"><?php echo $candidate['fName']." ".$candidate['lName'];?></a>
                        <p>(<?php echo $candidate['gender'];?>)</p>
                        </td>
                        <td><?php echo $candidate['passportNum'];?></td>                  
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
                        } ?></td>
                        <td><?php echo $candidate['country'];?></td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                    <th>Creation Date</th>
                        <th>Agent</th>
                        <th>Candidate Name</th>
                        <th>Passport No</th>
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Passport expire date</th>
                        <th>Candidare previouse status</th>
                        <th>Applying for Country</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
    
</div>

<script>
function trainingCard(passportNum){
    $('#passportNum').val(passportNum);
}

function testMedical(passportNum){
    $('#passportMedical').val(passportNum);
}

function finalMedical(passportNum){
    $('#passportMedicalFinal').val(passportNum);
}

function policeClearance(passportNum){
    $('#modalPassportPolice').val(passportNum);
}


window.onload = function() {
    $('#reportNav').addClass('active');
};
</script>






