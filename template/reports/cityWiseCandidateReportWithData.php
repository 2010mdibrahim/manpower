<?php
$city= $_POST['candidateCity'];
$qry = "select candidate.fName, candidate.lName, candidate.mob, candidate.addrs, passport.passNo from candidate
            inner join passport on passport.candidateId = candidate.candidateId where candidate.city = '$city'";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $(document).ready(function() {
        $('#candidateCityReport').DataTable();
    } );
</script>

<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>City Wise Candidate Report</h2>
    </div>
    <div style="padding-bottom: 2%">
        <h3>Candidate Report For City: <?php echo $city;?></h3>
    </div>
    <div class="table-responsive">
        <table class="table col-12" id="candidateCityReport" style="width:100%">
            <thead>
                <th>Candidate Name</th>
                <th>Candidate Mobile</th>
                <th>Candidate Address</th>
                <th>Candidate Passport Number</th>
            </thead>
            <?php
            while( $candidate = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $candidate['fName'].' '.$candidate['lName'];?></td>
                    <td><?php echo $candidate['mob'];?></td>
                    <td><?php echo $candidate['addrs'];?></td>
                    <td><?php echo $candidate['passNo'];?></td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <th>Candidate Name</th>
            <th>Candidate Mobile</th>
            <th>Candidate Address</th>
            <th>Candidate Passport Number</th>
            </tfoot>

        </table>
    </div>
</div>

