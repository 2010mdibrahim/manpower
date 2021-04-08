<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Sponsor", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$sponsorNid = $_POST['sponsorNid'];
$sponsor = mysqli_fetch_assoc($conn->query("SELECT * from sponsor where sponsorNID = '$sponsorNid'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Sponsor</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
    <form action="template/addNewSponsorQry.php" method="post">
        <input type="hidden" name="currentSponsorNid" value="<?php echo $sponsorNid?>">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Delegate</label>
                    <select class="form-control" name="delegateOfficeId" id="delegateOfficeId">
                    <?php 
                    $result = $conn->query("SELECT delegateOffice.delegateOfficeId, delegateOffice.officeName, delegate.* from delegate inner join delegateOffice using (delegateId) order by delegate.creationDate");
                    while($delegate = mysqli_fetch_assoc($result)){
                            if($delegate['delegateOfficeId'] == $sponsor['delegateOfficeId']){ ?>
                                <option value="<?php echo $delegate['delegateOfficeId']?>" selected><?php echo $delegate['delegateName']." - ".$delegate['officeName'];?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $delegate['delegateOfficeId']?>"><?php echo $delegate['delegateName']." - ".$delegate['officeName'];?></option>
                    <?php } } ?>
                    </select>                  
                </div>
                <div class="form-group col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" value="<?php echo $sponsor['sponsorName']; ?>" required>
                </div>                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Sponsor NID</label>
                    <input class="form-control" type="text" name="sponsorNid" value="<?php echo $sponsor['sponsorNID']; ?>" required>
                </div>
                <div class="form-group col-md-6" >                    
                    <label>Sponsor Phone Number</label>
                    <input class="form-control" type="text" id="sponsorVisa" name="sponsorPhone" value="<?php echo $sponsor['sponsorPhone']; ?>">
                </div>
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