<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" placeholder="Enter Name">
                    <br>
                    <label>Sponsor VISA</label>
                    <input class="form-control" type="text" id="sponsorVisa" name="sponsorVisa" placeholder="Enter Visa">
                    <br>
                </div>
                <div class="column col-md-6" >
                    <label>Sponsor NID</label>
                    <input class="form-control" type="text" id="sponsorId" name="sponsorNid" placeholder="Enter NID">
                    <br>
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
                    <input class="form-control" type="email" name="sponsorEmail" placeholder="Enter Email">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Add">
</div>
</form>