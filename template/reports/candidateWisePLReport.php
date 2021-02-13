<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $(document).ready(function() {
        $('#candidateWisePL').DataTable();
    } );
</script>

<?php
$candidateId = $_POST['candidateId'];
$passport = $_POST['passport'];
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>Candidate with Visa Information</h2>
    </div>
    <div class="table-responsive">
        <table class="table col-12" id="candidateWisePL" style="width:100%">
            <tr>
                <th>Candidate Name</th>
                <th>Sponsor Name</th>
                <th>Visa Name</th>
                <th>Passport Name</th>
            </tr>
            <?php
            $qry = "select candidate.fName, candidate.lName,sponsor.sponsorName, visainfo.name, visainfo.visaFee,visainfo.visaFeeStage, visapayment.amount as visaAmount,visapayment.visaPayStage, ticket.amount as ticketAmount, ticket.paid, passport.passNo from passport 
                        inner join candidate on passport.candidateId = candidate.candidateId 
                            inner join visainfo on visainfo.passNo = passport.passNo 
                                inner join sponsor on sponsor.sponsorId = visainfo.visaSponsorId 
                                    inner join visapayment on visapayment.visaId = visainfo.visaId 
                                        inner join ticket on ticket.passportNum = passport.passNo 
                                            where visainfo.passNo = '$passport'";


            $result = mysqli_query($conn,$qry);
            while($candidateVisa = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $candidateVisa['fName']." ".$candidateVisa['lName'];?></td>
                    <td><?php echo $candidateVisa['sponsorName'];?></td>
                    <td><?php echo $candidateVisa['name'];?></td>
                    <td><?php echo $candidateVisa['passNo'];?></td>
                    <td>
                        <ul>
                            <li>Visa Amount: <?php echo $candidateVisa['visaAmount'];?></li>
                            <li>Ticket Expense: <?php echo $candidateVisa['ticketAmount'];?></li>
                            <li>Visa Amount: <?php echo $candidateVisa['visaFee'];?></li>
                        </ul>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>

