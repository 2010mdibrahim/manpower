<?php
$passportNum = base64_decode($_GET['pn']);
$sponsorVisa = base64_decode($_GET['sv']);
$result = $conn->query("SELECT candidateexpense.*, passport.fName, passport.lName, agent.agentName FROM candidateexpense INNER JOIN passport USING (passportNum) INNER JOIN agent on candidateexpense.agentEmail = agent.agentEmail where candidateexpense.passportNum = '$passportNum'");
?>

<style>
    .btn{
        font-size: 11px;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Visa Information</h2>
            </div>
        </div>
        <?php $candidateExpense = mysqli_fetch_assoc($result) ?>
        <div class="card-group">
        <div class="card">
            <div class="card-body">
                <label class="card-title">Candidate Name</label>
                <h4><?php echo $candidateExpense['fName']." ".$candidateExpense['lName'];?></h4></span>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <label class="card-title">Passport Number</label>
            <h4><?php echo $candidateExpense['passportNum'];?></h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <label class="card-title">Agent Name</label>
            <h4><?php echo $candidateExpense['agentName'];?></h4>
            </div>
        </div>
        </div>
    
        <div class="card-body">
        
        <div class="table-responsive">
            <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
                    <th>Comment</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <!-- did this because had to take candidate name agent name from the same mysql query -->
                <tr>                    
                    <td><?php echo $candidateExpense['purpose'];?></td>                        
                    <td><?php echo $candidateExpense['amount'];?></td>
                    <td><?php echo $candidateExpense['creationDate'];?></td>
                    <td><?php echo $candidateExpense['comment'];?></td>   
                    <td></td>                 
                </tr>
                                
                <?php while($candidateExpense = mysqli_fetch_assoc($result)){ ?>
                <tr>                    
                    <td><?php echo $candidateExpense['purpose'];?></td>                        
                    <td><?php echo $candidateExpense['amount'];?></td>
                    <td><?php echo $candidateExpense['creationDate'];?></td>
                    <td><?php echo $candidateExpense['comment'];?></td>                    
                </tr>
                <?php } ?>
                <tfoot hidden>
                <tr>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Pay Date</th>
                    <th>Comment</th>
                    <th>Edit</th>
                </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>

<script>
function trainingCard(info){
    let info_split = info.split('-');
    $('#passportNumCard').val(info_split[0]);
}

function visaStamping(info){
    let info_split = info.split('-');
    $('#passportNum').val(info_split[0]);
    $('#sponsorVisa').val(info_split[1]);
}

$('body').on('click', '#testMedicalFile', function(){
    $('#visaMedical').val($('#testMedicalFile').val());
});

$('body').on('click', '#finalMedicalFile', function(){
    $('#visaMedicalFinal').val($('#finalMedicalFile').val());
});

window.onload = function() {
    $('#visaNav').addClass('active');
};
</script>

