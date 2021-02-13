<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>Candidate with Visa Information</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12" style="width:100%">
            <thead>
            <tr>
                <th>Candidate Name</th>
                <th>Visa Name</th>
                <th>Visa Type</th>
                <th>Passport Name</th>
            </tr>
            </thead>
            <?php
            $qry = "select passport.passNo, candidate.fName, candidate.lName, candidate.candidateId,visainfo.visaId, visainfo.name, visainfo.type from passport 
                        inner join candidate on passport.candidateId = candidate.candidateId 
                            inner join visainfo on visainfo.passNo = passport.passNo 
                                where visainfo.passNo is not null";
            $result = mysqli_query($conn,$qry);
            while($candidateVisa = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $candidateVisa['fName']." ".$candidateVisa['lName'];?></td>
                    <td><?php echo $candidateVisa['name'];?></td>
                    <td><?php echo $candidateVisa['type'];?></td>
                    <td><?php echo $candidateVisa['passNo'];?></td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Candidate Name</th>
                <th>Visa Name</th>
                <th>Visa Type</th>
                <th>Passport Name</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

