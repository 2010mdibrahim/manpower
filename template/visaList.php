<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>All Visa Information</h2>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12" style="width:100%">
            <thead>
            <tr>                
                <th>Visa No</th>
                <th>Employee Request</th>
                <th>Foreign Mole</th>
                <th>Okala</th>
                <th>Mufa</th>
                <th>Test Medical</th>
                <th>Final Medical</th>
                <th>Finger</th>
                <th>Visa Stamping</th>
                <th>Departure Date</th>
                <th>Arrival Date</th>
            </tr>
            </thead>
            <?php
            $result = $conn->query("SELECT * from visa");
            $status = "pending";
            while($visa = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $visa['visaNo'];?></td>
                    <td><?php echo $visa['empRqst'];?></td>
                    <td><?php echo $visa['foreignMole'];?></td>
                    <td><?php echo $visa['okala'];?></td>
                    <td><?php echo $visa['mufa'];?></td>
                    <td><?php echo $visa['testMedical'];?></td>
                    <td><?php echo $visa['finalMedical'];?></td>
                    <td><?php echo $visa['finger'];?></td>
                    <td><?php echo $visa['visaStamping'];?></td>
                    <td><?php echo $visa['mufa'];?></td>
                    <td><?php echo $visa['mufa'];?></td>
                    <!-- <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editVisa" name="pagePost">
                                    <input type="hidden" value="<?php echo $visa['visaId']; ?>" name="visaId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/editVisaQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $visa['visaId']; ?>" name="visaId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td> -->
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Visa No</th>
                <th>Employee Request</th>
                <th>Foreign Mole</th>
                <th>Okala</th>
                <th>Mufa</th>
                <th>Test Medical</th>
                <th>Final Medical</th>
                <th>Finger</th>
                <th>Visa Stamping</th>
                <th>Departure Date</th>
                <th>Arrival Date</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

