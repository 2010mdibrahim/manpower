<?php
$candidateId = $_POST['candidateId'];
$qry = "select fName, lName from candidate where candidateId = $candidateId";
$result = mysqli_query($conn,$qry);
$candidateName = mysqli_fetch_assoc($result);
$qry = "select passNo from passport where candidateId = $candidateId";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Transfer Visa</h2>
    </div>
    <form action="template/transferVisaWithData.php" method="post">
        <div class="row">
            <div class="column col-md-6">
                <div class="form-group">
                    <label for="sel1">Transfering VISA of:</label>
                    <select class="form-control" id="candidateName" name="candidateName" disabled>
                        <option><?php echo $candidateName['fName']." ".$candidateName['lName']; ?></option>
                    </select>
                </div>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="column col-md-6">
                <div class="form-group">
                    <label for="sel1">Select Passport to Use:</label>
                    <select class="form-control" id="passport" name="passport">
                        <option>Select passport</option>
                        <?php while($passNo = mysqli_fetch_assoc($result)){ ?>
                            <option><?php echo $passNo['passNo']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>
            </div>
            <div class="column col-md-6">
                <div class="form-group">
                    <label for="sel1">Select VISA to transfer:</label>
                    <select class="form-control" id="visa" name="visa">
                        <option>Select passport</option>
                        <?php
                        $qry = "select visaId, name from visainfo where passNo is null";
                        $result = mysqli_query($conn,$qry);
                        while($visa = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $visa['visaId']; ?>"><?php echo $visa['name']; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <br>
            </div>
        </div>
        <br>
        <input type="submit" value="Transfer">
</div>
</form>
</div>