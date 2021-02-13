<?php
$visaId = $_POST['visaId'];
$qry = "select name from visaInfo where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$visaName = mysqli_fetch_assoc($result);
$qry = "select mediId, mediStage, date, COUNT(mediId) as mediCount from medical where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$medicalInfo = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Medical Stage Information</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Medical Information</h3>
    <form action="template/medicalStageQry.php" method="post">
        <?php if($medicalInfo['mediCount'] <= 0){ ?>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <input type="hidden" value="insert" name="alter">
                    <label>Visa:</label>
                    <select class="form-control" id="visaId" name="visaId" readonly>
                        <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                    </select>
                    <br>
                    <label for="sel1">Medical Stage:</label>
                    <select class="form-control" id="medicalStage" name="medicalStage">
                        <option>Select Medical Stage</option>
                            <option>Fit</option>
                            <option>Unfit</option>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Date:</label>
                    <input class="form-control" type="date" name="medicalDate">
                    <br>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <input type="hidden" value="update" name="alter">
                        <input type="hidden" value="<?php echo $medicalInfo['mediId'];?>" name="mediId">
                        <label>Visa:</label>
                        <select class="form-control" id="visaId" name="visaId" readonly>
                            <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                        </select>
                        <br>
                        <label for="sel1">Medical Stage:</label>
                        <select class="form-control" id="medicalStage" name="medicalStage">
                            <option><?php if($medicalInfo['mediStage'] == 'Fit'){ echo $medicalInfo['mediStage'];?></option>
                                <option>Unfit</option>
                            <?php } else { ?>
                                <option>Fit</option>
                                <option>Unfit</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="column col-md-6">
                        <label for="sel1">Date:</label>
                        <input class="form-control" type="date" name="medicalDate" value="<?php echo $medicalInfo['date'];?>">
                        <br>
                    </div>
                </div>
            </div>
        <?php } ?>
        <br>
        <input type="submit" value="Save">
</div>
</form>
</div>