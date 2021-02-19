<?php
$sponsorName = $_POST['sponsorName'];
$qry = "select * from sponsor where sponsorName = '$sponsorName'";
$result = mysqli_query($conn,$qry);
$sponsor = mysqli_fetch_assoc($result);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <input type="hidden" value="<?php echo $sponsorName['sponsorName']; ?>" name="sponsorName">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" value="<?php echo $sponsor['sponsorName'];?>" readonly>
                    <br>
                </div>
                <div class="column col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $sponsor['comment']; ?>">
                    <br>
                </div>

            </div>
        </div>
        <br>        
        <input type="submit" value="Update" name="alter">
</div>
</form>
</div>