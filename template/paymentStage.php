<?php
$visaId = $_POST['visaId'];
$qry = "select name,visaFee,visaFeeDate, COUNT(visaFeeDate) as visaFeeDateCount from visaInfo where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$visaName = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Update Stamping</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Stamping Information</h3>
    <form action="template/payStageQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <input value="update" name="alter" type="hidden">
                    <label>Visa:</label>
                    <select class="form-control" id="visaId" name="visaId" readonly>
                        <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                    </select>
                    <br>
                    <?php if($visaName['visaFee'] != 0){ $visaFee = $visaName['visaFee']; }else { $visaFee=0; } ?>
                    <label for="sel1">Visa Fee Amount:</label>
                    <input class="form-control" type="test"  name="visaFee" value="<?php echo $visaFee; ?>" required>
                </div>
                <?php if($visaName['visaFeeDateCount'] != 0){ $payDate = $visaName['visaFeeDate']; }else { $payDate=''; } ?>
                <div class="column col-md-6">
                    <label for="sel1">Date:</label>
                    <input class="form-control" type="date" name="payDate" value="<?php echo $payDate; ?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Save">
</div>
</form>
</div>