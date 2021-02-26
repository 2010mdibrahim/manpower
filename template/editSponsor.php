<?php
$sponsorNid = $_POST['sponsorNid'];
$sponsor = mysqli_fetch_assoc($conn->query("SELECT * from sponsor where sponsorNID = '$sponsorNid'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" value="<?php echo $sponsor['sponsorName']; ?>" required>
                </div>
                <div class="form-group col-md-6" >
                    <label>Sponsor NID</label>
                    <input class="form-control" type="text" name="sponsorNid" value="<?php echo $sponsor['sponsorNID']; ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >                    
                    <label>Comment</label>
                    <input class="form-control" type="text" id="sponsorVisa" name="comment" value="<?php echo $sponsor['comment']; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Update">
        </div>
    </form>
</div>