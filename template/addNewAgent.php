<?php
$qry = "select * from agenttype";
$result = mysqli_query($conn,$qry);

?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
    <form action="template/addNewAgentQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Agent Name</label>
                    <input class="form-control" type="text" name="agentName" placeholder="Enter Name">
                    <br>
                    <label for="sel1">Company:</label>
                    <input class="form-control" type="text" name="company" placeholder="Give Company Name">
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Opening balance:</label>
                    <input class="form-control" type="number" name="openAmount" placeholder="BDT">
                    <br>
                    <label for="sel1">Agent type:</label>
                    <select class="form-control" id="agentType" name="agentType">
                        <option>Select Agent Type</option>
                        <?php while($agentType = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $agentType['agentTypeId'];?>"><?php echo $agentType['agentType']; ?></option>
                        <?php } ?>
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
                    <input class="form-control" type="text" name="address" placeholder="Enter Address">
                    <br>
                    <label for="sel1">Country:</label>
                    <input class="form-control" type="text" name="country" placeholder="Enter Country">
                </div>
                <div class="column col-md-6">
                    <label for="sel1">City:</label>
                    <input class="form-control" type="text" name="city" placeholder="Enter State">
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Contact information</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Phone Number</label>
                    <input class="form-control" type="text" name="phnNumber" placeholder="Enter Phone">
                    <br>
                    <label for="sel1">Email:</label>
                    <input class="form-control" type="email" name="agentEmail" placeholder="Enter Email">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Add">
</div>
</form>
</div>