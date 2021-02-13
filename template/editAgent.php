<?php
$agentId = $_POST['agentId'];
$agentType = $_POST['agentType'];
$agentTypeId = $_POST['agentTypeId'];
$qry = "select * from agent where agentId = $agentId";
$result = mysqli_query($conn,$qry);
$agent = mysqli_fetch_assoc($result);
$qry = "select * from agentType";
$result = mysqli_query($conn,$qry);

?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
    <form action="template/addNewAgentQry.php" method="post">
        <input type="hidden" value="update" name="alter">
        <input type="hidden" value="<?php echo $agentId?>" name="agentId">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Agent Name</label>
                    <input class="form-control" type="text" name="agentName" value="<?php echo $agent['agentName']; ?>">
                    <br>
                    <label for="sel1">Company:</label>
                    <input class="form-control" type="text" name="company" value="<?php echo $agent['company']; ?>">
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Opening balance:</label>
                    <input class="form-control" type="number" name="openAmount" value="<?php echo $agent['openBalance']; ?>">
                    <br>
                    <label for="sel1">Agent type:</label>
                    <select class="form-control" id="agentType" name="agentType">
                        <option value="<?php echo $agentTypeId; ?>">Assigned Agent Type: <?php echo $agentType; ?></option>
                        <?php
                        while($agentTypeAll = mysqli_fetch_assoc($result)){
                            if($agentTypeAll['agentTypeId'] != $agentTypeId){
                        ?>
                            <option value="<?php echo $agentTypeAll['agentTypeId'];?>"><?php echo $agentType['agentType']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <h3 style="background-color: aliceblue; padding: 0.5%">Address information</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Address</label>
                    <input class="form-control" type="text" name="address" value="<?php echo $agent['address']; ?>">
                    <br>
                    <label for="sel1">Country:</label>
                    <input class="form-control" type="text" name="country" value="<?php echo $agent['country']; ?>">
                </div>
                <div class="column col-md-6">
                    <label for="sel1">City:</label>
                    <input class="form-control" type="text" name="city" value="<?php echo $agent['city']; ?>">
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Contact information</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Phone Number</label>
                    <input class="form-control" type="text" name="phnNumber" value="<?php echo $agent['phone']; ?>">
                    <br>
                    <label for="sel1">Email:</label>
                    <input class="form-control" type="email" name="agentEmail" value="<?php echo $agent['email']; ?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
</div>
</form>
</div>