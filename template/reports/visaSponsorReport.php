<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>

<?php
$reportType = $_POST['reportType'];
$sponsorId = $_POST['sponsorId'];
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>Candidate with Visa Information</h2>
    </div>
    <div class="table-responsive">
        <table class="table col-12" style="width:100%">
            <tr>
                <th>Sponsor Name</th>
                <th>Visa No</th>
                <th>Visa Date</th>
                <th>Visa Type</th>
            </tr>
            <?php
            $qry = "select sponsor.sponsorName, visainfo.name, visainfo.date, visainfo.type from visainfo 
                        inner join sponsor on sponsor.sponsorId = visainfo.visaSponsorId
                            where sponsor.sponsorId = $sponsorId";


            $result = mysqli_query($conn,$qry);
            while($candidateVisa = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $candidateVisa['sponsorName'];?></td>
                    <td><?php echo $candidateVisa['name'];?></td>
                    <td><?php echo $candidateVisa['date'];?></td>
                    <td><?php echo $candidateVisa['type'];?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>

