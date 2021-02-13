<?php
$passNo = $_POST['passNo'];
$qry = "select *, count(mofaId) as countMofa from mofa where passNo = '$passNo'";
$result = mysqli_query($conn,$qry);
$mofa = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>MOFA Stage</h2>
    </div>
    <form action="template/mofaUpdateQry.php" method="post">
        <?php if($mofa['countMofa'] <= 0){?>
            <div>
                    <h3 style="background-color: aliceblue; padding: 0.5%; text-align: center">No MOFA Added</h3>
            </div>
        <?php }else{ ?>
            <h3 style="background-color: aliceblue; padding: 0.5%">MOFA Information</h3>
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-6" >
                        <input value="<?php echo $mofa['mofaId'];?>" name="mofaId" type="hidden">
                        <label>Visa:</label>
                        <select class="form-control" id="passNo" name="passNo" readonly>
                            <option><?php echo $passNo;?></option>
                        </select>
                        <br>
                        <label for="sel1">Stamping Stage:</label>
                        <select class="form-control" id="mofaStage" name="mofaStage">
                            <?php if($mofa['mofaStage'] == 'Done'){ ?>
                                <option>Done</option>
                                <option>Reject</option>
                            <?php }else if($mofa['mofaStage'] == 'Reject'){ ?>
                                <option>Reject</option>
                                <option>Done</option>
                            <?php }else{?>
                                <option>Select Stage</option>
                                <option>Done</option>
                                <option>Reject</option>
                            <?php } ?>
                        </select>
                        <br>
                    </div>
                    <div class="column col-md-6">
                        <label for="sel1">Mofa Remark:</label>
                        <input class="form-control" type="text" name="mofaRemark" value="<?php echo $mofa['mofaRemark'];?>">
                        <br>
                        <label for="sel1">Mofa Code:</label>
                        <input class="form-control" type="text" name="mofaCode" value="<?php echo $mofa['mofaCode'];?>" readonly>
                    </div>
                    <div class="column col-md-6">
                        <label for="sel1">Show Evidence:</label>
                        <a href="?page=showEvidence&mofaId=<?php echo $mofa['mofaId'];?>" target="_blank">Show Evidence</a>
                    </div>
                </div>
            </div>
            <input type="submit" value="Update">
        <?php } ?>
        <br>

</div>
</form>
</div>