<?php
$qry = "select visaId, name from visainfo where passNo is not null ";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Select Visa</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <?php if($stage == 'medical'){ ?>
                <input type="hidden" name="pagePost" value="medicalStage">
            <?php }else if($stage == 'emigration'){ ?>
                <input type="hidden" name="pagePost" value="emigrationStage">
            <?php }else if($stage == 'payment'){ ?>
                <input type="hidden" name="pagePost" value="paymentStage">
            <?php }else{ ?>
                <input type="hidden" name="pagePost" value="visaStampingStage">
            <?php } ?>
            <label for="sel1">Select Visa:</label>
            <select class="form-control" id="visaId" name="visaId">
                <option>Select Visa</option>
                <?php while($visa = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $visa['visaId']; ?>"><?php echo $visa['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <input type="submit" value="search">
</div>
</form>
</div>