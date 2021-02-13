<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $(document).ready(function() {
        $('#candidateReport').DataTable();
    } );
</script>

<?php
$stage = $_POST['stage'];
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3><?php echo $stage;?> Report</h3>
    </div>
    <div class="table-responsive">
        <table class="table col-12" id="candidateReport" style="width:100%">
            <thead>
            <tr>
                <th>Candidate Name</th>
                <th>Passport No</th>
                <th>Sponsor</th>
                <th>Agent Name</th>
                <th>Category</th>
                <th>Phone No</th>
                <?php if($stage != 'Ticket'){?>
                <th>Stage</th>
                <?php } ?>
            </tr>
            </thead>
            <?php
            if($stage == 'Medical'){
                $qry = "select sponsor.sponsorName, passport.passNo, candidate.fName, candidate.lName,candidate.mob, agent.agentName, visainfo.type, medical.mediStage from passport 
                        inner join candidate on passport.candidateId = candidate.candidateId 
                            inner join visainfo on visainfo.passNo = passport.passNo 
                                inner join sponsor on sponsor.sponsorId = visainfo.visaSponsorId 
                                    inner join agent on agent.agentId = visainfo.visaIssuAgent 
                                        inner join medical on medical.visaId = visainfo.visaId 
                                            where visainfo.passNo is not null";
            }else if($stage == 'Stamping'){
                $qry = "select sponsor.sponsorName, passport.passNo, candidate.fName, candidate.lName,candidate.mob, agent.agentName, visainfo.type, stamping.stampStage from passport 
                        inner join candidate on passport.candidateId = candidate.candidateId 
                            inner join visainfo on visainfo.passNo = passport.passNo 
                                inner join sponsor on sponsor.sponsorId = visainfo.visaSponsorId 
                                    inner join agent on agent.agentId = visainfo.visaIssuAgent 
                                        inner join stamping on stamping.visaId = visainfo.visaId 
                                            where visainfo.passNo is not null";
            }else if($stage == 'Emigration'){
                $qry = "select sponsor.sponsorName, passport.passNo, candidate.fName, candidate.lName,candidate.mob, agent.agentName, visainfo.type, emigration.approval from passport 
                        inner join candidate on passport.candidateId = candidate.candidateId 
                            inner join visainfo on visainfo.passNo = passport.passNo 
                                inner join sponsor on sponsor.sponsorId = visainfo.visaSponsorId 
                                    inner join agent on agent.agentId = visainfo.visaIssuAgent 
                                        inner join emigration on emigration.visaId = visainfo.visaId 
                                            where visainfo.passNo is not null";
            }else{
                $qry = "select sponsor.sponsorName, passport.passNo, candidate.fName, candidate.lName,candidate.mob, agent.agentName, visainfo.type, ticket.ticketId from passport 
                        inner join candidate on passport.candidateId = candidate.candidateId 
                            inner join visainfo on visainfo.passNo = passport.passNo 
                                inner join sponsor on sponsor.sponsorId = visainfo.visaSponsorId 
                                    inner join agent on agent.agentId = visainfo.visaIssuAgent 
                                        inner join ticket on ticket.passportNum = passport.passNo 
                                            where visainfo.passNo is not null";
            }

            $result = mysqli_query($conn,$qry);
            while($candidateVisa = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $candidateVisa['fName']." ".$candidateVisa['lName'];?></td>
                    <td><?php echo $candidateVisa['passNo'];?></td>
                    <td><?php echo $candidateVisa['sponsorName'];?></td>
                    <td><?php echo $candidateVisa['agentName'];?></td>
                    <td><?php echo $candidateVisa['type'];?></td>
                    <td><?php echo $candidateVisa['mob'];?></td>
                    <?php if($stage == 'Medical'){ ?>
                    <td><?php echo $candidateVisa['mediStage'];?></td>
                    <?php }else if($stage == 'Emigration'){?>
                    <td><?php echo $candidateVisa['approval'];?></td>
                    <?php }else if($stage == 'Stamping'){?>
                    <td><?php echo $candidateVisa['stampStage'];?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Candidate Name</th>
                <th>Passport No</th>
                <th>Sponsor</th>
                <th>Agent Name</th>
                <th>Category</th>
                <th>Phone No</th>
                <?php if($stage != 'Ticket'){?>
                    <th>Stage</th>
                <?php } ?>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

