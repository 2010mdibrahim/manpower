<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>All Sponsor Information</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12" style="width:100%">
            <thead>
            <tr>
                <th>Sponsor Name</th>
                <th>Comment</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            $qry = "select * from sponsor";
            $result = mysqli_query($conn,$qry);
            while($sponsor = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $sponsor['sponsorName'];?></td>
                    <td><?php echo $sponsor['comment'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editSponsor" name="pagePost">
                                    <input type="hidden" value="<?php echo $sponsor['sponsorName']; ?>" name="sponsorName">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/addNewSponsorQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editAgent" name="pagePost">
                                    <input type="hidden" value="<?php echo $sponsor['sponsorName']; ?>" name="sponsorName">
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

