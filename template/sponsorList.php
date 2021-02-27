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
                        <th>Delegate Name</th>
                        <th>Sponsor NID</th>
                        <th>Sponsor Name</th>
                        <th>Comment</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    $qry = "SELECT delegate.delegateName, sponsor.* from sponsor inner join delegate using(delegateId) order by creationDate desc";
                    $result = mysqli_query($conn,$qry);
                    while($sponsor = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $sponsor['delegateName'];?></td>
                            <td><?php echo $sponsor['sponsorNID'];?></td>
                            <td><?php echo $sponsor['sponsorName'];?></td>
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
                    <tfoot hidden>
                    <tr>
                        <th>Sponsor Name</th>
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
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>

