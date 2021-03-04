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
                <h5 class="card-title">Candidate Name</h5>
                <p class="card-text"><?php echo $candidateExpense['fName']." ".$candidateExpense['lName'];?></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Passport Number</h5>
            <p class="card-text"><?php echo $candidateExpense['passportNum'];?></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Agent Name</h5>
            <p class="card-text"><?php echo $candidateExpense['agentName'];?></p>
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
                    <th>Advance</th>
                    <th>Balance</th>
                    <th>Pay Date</th>
                    <th>Comment</th>
                </tr>
                </thead>
                <tr>                    
                    <td><?php echo $candidateExpense['purpose'];?></td>                        
                    <td><?php echo $candidateExpense['amount'];?></td>
                    <td><?php echo $candidateExpense['advance'];?></td>
                    <td><?php echo intval($candidateExpense['amount']) - intval($candidateExpense['advance']);?></td>
                    <td><?php echo $candidateExpense['payDate'];?></td>
                    <td><?php echo $candidateExpense['comment'];?></td>                    
                </tr>
                
                <?php while($candidateExpense = mysqli_fetch_assoc($result)){ ?>
                <tr>                    
                    <td><?php echo $candidateExpense['purpose'];?></td>                        
                    <td><?php echo $candidateExpense['amount'];?></td>
                    <td><?php echo $candidateExpense['advance'];?></td>
                    <td><?php echo intval($candidateExpense['amount']) - intval($candidateExpense['advance']);?></td>
                    <td><?php echo $candidateExpense['payDate'];?></td>
                    <td><?php echo $candidateExpense['comment'];?></td>                    
                </tr>
                <?php } ?>
                <tfoot hidden>
                <tr>
                    <th>Passport Name</th>
                    <th>Passport Number</th>                               
                    <th>Agent Name</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Advance</th>
                    <th>Balance</th>
                    <th>Pay Date</th>
                    <th>Comment</th>
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

