<?php
$visaId = $_POST['visaId'];
$qry = "select name from visaInfo where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$visaName = mysqli_fetch_assoc($result);
$qry = "select stampId, stampStage, date, COUNT(stampStage) as countStamp from stamping where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$stampInfo = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Update Stamping</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Stamping Information</h3>
    <form action="template/stampingStageQry.php" method="post">
        <?php if($stampInfo['countStamp'] <= 0){?>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Visa:</label>
                    <select class="form-control" id="visaId" name="visaId" readonly>
                        <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                    </select>
                    <br>
                    <label for="sel1">Stamping Stage:</label>
                    <select class="form-control" id="stampingStage" name="stampingStage">
                        <option>Select Stamping Stage</option>
                        <option>Pending</option>
                        <option>Reject</option>
                        <option>Done</option>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Date:</label>
                    <input class="form-control" type="date" name="stampingDate">
                    <br>
                </div>
            </div>
        </div>
        <?php }else{ ?>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <input value="update" name="alter" type="hidden">
                    <label>Visa:</label>
                    <select class="form-control" id="visaId" name="visaId" readonly>
                        <option value="<?php echo $visaId;?>"><?php echo $visaName['name'];?></option>
                    </select>
                    <br>
                    <label for="sel1">Stamping Stage:</label>
                    <select class="form-control" id="stampingStage" name="stampingStage">
                        <?php if($stampInfo['stampStage'] == 'Pending'){ ?>
                            <option>Pending</option>
                            <option>Reject</option>
                            <option>Done</option>
                        <?php }else if($stampInfo['stampStage'] == 'Reject'){ ?>
                            <option>Reject</option>
                            <option>Pending</option>
                            <option>Done</option>
                        <?php } else { ?>
                            <option>Done</option>
                            <option>Pending</option>
                            <option>Reject</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Date:</label>
                    <input class="form-control" type="date" name="stampingDate" value="<?php echo $stampInfo['date'];?>">
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