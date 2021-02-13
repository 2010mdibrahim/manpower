<?php
$visaId = $_POST['visaId'];
$qry = "select name from visaInfo where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$visaName = mysqli_fetch_assoc($result);
$qry = "select approval, date, COUNT(approval) as emiCount from emigration where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$emiInfo = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Emigration Stage Information</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Emigration Information</h3>
    <form action="template/emigrationStageQry.php" method="post">
        <?php if($emiInfo['emiCount'] <= 0){ ?>
            <div class="form-group">
                <div class="row">
                    <input type="hidden" value="insert" name="alter">
                    <div class="column col-md-6" >
                        <label>Visa:</label>
                        <select class="form-control" id="visaId" name="visaId" readonly>
                            <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                        </select>
                        <br>
                        <label for="sel1">Emigration Stage:</label>
                        <select class="form-control" id="emigrationStage" name="emigrationStage">
                            <option>Select Emigration Stage</option>
                            <option>Done</option>
                            <option>Reject</option>
                        </select>
                    </div>
                    <div class="column col-md-6">
                        <label for="sel1">Date:</label>
                        <input class="form-control" type="date" name="emigrationDate">
                        <br>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <input type="hidden" value="update" name="alter">
                        <input type="hidden" value="<?php echo $emiInfo['emigId'];?>" name="mediId">
                        <label>Visa:</label>
                        <select class="form-control" id="visaId" name="visaId" readonly>
                            <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                        </select>
                        <br>
                        <label for="sel1">Emigration Stage:</label>
                        <select class="form-control" id="emigrationStage" name="emigrationStage">
                            <?php if($emiInfo['approval'] == 'Done'){ ?>
                                <option><?php echo $emiInfo['approval']; ?></option>
                                <option>Reject</option>
                            <?php } else { ?>
                                <option>Done</option>
                                <option>Reject</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="column col-md-6">
                        <label for="sel1">Date:</label>
                        <input class="form-control" type="date" name="emigrationDate" value="<?php echo $emiInfo['date'];?>">
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