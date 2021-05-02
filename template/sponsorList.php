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
if(isset($_GET['spN'])){
    $sponsorNID = base64_decode($_GET['spN']);
    $result = $conn->query("SELECT delegateoffice.officeName, delegate.delegateName,delegate.delegateId, sponsor.* from sponsor INNER JOIN delegateoffice USING (delegateOfficeId) inner join delegate on delegate.delegateId = delegateoffice.delegateId where sponsor.sponsorNID = '$sponsorNID' order by creationDate desc");
}else{
    $result = $conn->query("SELECT delegateoffice.officeName, delegate.delegateName, sponsor.* from sponsor INNER JOIN delegateoffice USING (delegateOfficeId) inner join delegate on delegate.delegateId = delegateoffice.delegateId order by creationDate desc");
}
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Sponsor Information</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Delegate Information</th>
                        <th>Sponsor Name</th>
                        <th>Sponsor NID</th>
                        <th>VISA No.</th>
                        <th>Sponsor Phone</th>
                        <th>Comment</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    while($sponsor = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><a href="?page=delegateList&di=<?php echo base64_encode($sponsor['delegateId']) ?>"><?php echo $sponsor['delegateName']." - ".$sponsor['officeName'];?></a></td>
                            <td><?php echo $sponsor['sponsorName'];?></td>
                            <td><?php echo $sponsor['sponsorNID'];?></td>
                            <td>
                            <?php
                            $result_visa_no = $conn->query("SELECT sponsorVisa from sponsorvisalist where sponsorNID = '".$sponsor['sponsorNID']."' AND visaAmount > 0");
                            while($sponsor_visa = mysqli_fetch_assoc($result_visa_no)) { ?>
                                <a href="?page=allVisaList&sv=<?php echo base64_encode($sponsor_visa['sponsorVisa']); ?>"><?php echo '"'.$sponsor_visa['sponsorVisa'].'", ';?></a>
                            <?php } ?>
                            </td>
                            <td><?php echo $sponsor['sponsorPhone'];?></td>
                            <td><?php echo $sponsor['comment'];?></td>
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editSponsor" name="pagePost">
                                            <input type="hidden" value="<?php echo $sponsor['sponsorNID']; ?>" name="sponsorNid">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/addNewSponsorQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editAgent" name="pagePost">
                                            <input type="hidden" value="<?php echo $sponsor['sponsorNID']; ?>" name="sponsorNid">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Delegate Information</th>
                        <th>Sponsor Name</th>
                        <th>Sponsor NID</th>
                        <th>VISA No.</th>
                        <th>Sponsor Phone</th>
                        <th>Comment</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$('#sponsorNav').addClass('active');
</script>

