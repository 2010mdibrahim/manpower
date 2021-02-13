<?php
$sponsorId = $_POST['sponsorId'];
$qry = "select * from sponsor where sponsorId = $sponsorId";
$result = mysqli_query($conn,$qry);
$sponsor = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <input type="hidden" value="<?php echo $sponsorId; ?>" name="sponsorId">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" value="<?php echo $sponsor['sponsorName']; ?>">
                    <br>
                    <label>Sponsor VISA</label>
                    <input class="form-control" type="text" name="sponsorVisa" value="<?php echo $sponsor['sponsorVisa']; ?>">
                    <br>
                </div>
                <div class="column col-md-6" >
                    <label>Sponsor NID</label>
                    <input class="form-control" type="text" name="sponsorNid" value="<?php echo $sponsor['sponsorNID']; ?>">
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
                    <input class="form-control" type="text" name="address" value="<?php echo $sponsor['address']; ?>">
                    <br>
                    <label for="sel1">Country:</label>
                    <input class="form-control" type="text" name="country" value="<?php echo $sponsor['country']; ?>">
                </div>
                <div class="column col-md-6">
                    <label for="sel1">City:</label>
                    <input class="form-control" type="text" name="city" value="<?php echo $sponsor['city']; ?>">
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Contact information</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Phone Number</label>
                    <input class="form-control" type="text" name="phnNumber" value="<?php echo $sponsor['phone']; ?>">
                    <br>
                    <label for="sel1">Email:</label>
                    <input class="form-control" type="email" name="sponsorEmail" value="<?php echo $sponsor['email']; ?>">
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Update">
</div>
</form>
</div>