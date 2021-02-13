<?php
$visaId = $_POST['visaId'];
$qry = "select visainfo.*, sponsor.sponsorName,sponsor.sponsorId, agent.agentName from visainfo 
            inner join sponsor on visainfo.visaSponsorId = sponsor.sponsorId 
                inner join agent on visainfo.visaIssuAgent = agent.agentId 
                    where visaId = $visaId";
$result = mysqli_query($conn,$qry);
$visa = mysqli_fetch_assoc($result);
$sponsorId = $visa['visaSponsorId'];
$agentId = $visa['visaIssuAgent'];
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Visa Information</h2>
    </div>
    <h4 style="background-color: aliceblue">Visa Information</h4>
    <form action="template/editVisaQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="visaId" value="<?php echo $visaId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <?php
                    $qry = "select sponsorId, sponsorName from sponsor where sponsorId != $sponsorId";
                    $result = mysqli_query($conn,$qry);
                    ?>
                    <label> Select Sponsor of VISA </label>
                    <select class="form-control" id="sponsorId" name="sponsorId">
                        <option value="<?php echo $visa['sponsorId'];?>"><?php echo $visa['sponsorName'];?></option>
                        <?php
                        while($sponsor = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $sponsor['sponsorId']; ?>"><?php echo $sponsor['sponsorName']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label>Visa Catagory</label>
                    <input type="text" class="form-control" required="required" name="type" value="<?php echo $visa['type'];?>"/>
                </div>
                <div class="column col-md-6">
                    <label>Visa Name</label>
                    <input type="text" class="form-control" required="required" name="name" value="<?php echo $visa['name'];?>"/>
                    <br>
                    <label>Visa Date</label>
                    <input type="date" class="form-control" required="required" name="date" value="<?php echo $visa['date'];?>"/>

                </div>
            </div>
        </div>
        <h4 style="background-color: aliceblue">Visa Detail Information</h4>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-4" >
                    <label>Position</label>
                    <input type="text" class="form-control" required="required" name="pos" value="<?php echo $visa['position'];?>"/>
                </div>
                <div class="column col-md-4">
                    <label>Basic Salary</label>
                    <input type="number" class="form-control" required="required" name="bSalary" value="<?php echo $visa['bSalary'];?>"/>
                </div>
                <div class="column col-md-4" >
                    <label>Total salary</label>
                    <input type="number" class="form-control" required="required" name="tSalary" value="<?php echo $visa['tSalary'];?>"/>
                </div>
            </div>
        </div>
        <h4 style="background-color: aliceblue">Agent Information</h4>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6">
                    <?php
                    $qry = "select agentId, agentName from agent where agentId != $agentId";
                    $result = mysqli_query($conn,$qry);
                    ?>
                    <div class="form-group">
                        <select class="form-control" id="agent" name="agent">
                            <option value="<?php echo $visa['agentId'];?>"><?php echo $visa['agentName'];?></option>
                            <?php
                            while($agent = mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $agent['agentId']; ?>"><?php echo $agent['agentName']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
</div>
</form>
</div>