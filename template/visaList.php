<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>All Visa Information</h2>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12" style="width:100%">
            <thead>
            <tr>
                <th>DATE</th>
                <th>Visa No</th>
                <th>Name</th>
                <th>Visa Type</th>
                <th>Agent</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            $qry = "select * from visainfo";
            $result = mysqli_query($conn,$qry);
            $status = "pending";
            while($visa = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $visa['date'];?></td>
                    <td><?php echo $visa['visaId'];?></td>
                    <td><?php echo $visa['name'];?></td>
                    <td><?php echo $visa['type'];?></td>
                    <td><?php echo $visa['visaIssuAgent'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editVisa" name="pagePost">
                                    <input type="hidden" value="<?php echo $visa['visaId']; ?>" name="visaId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/editVisaQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $visa['visaId']; ?>" name="visaId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>DATE</th>
                <th>Visa No</th>
                <th>Name</th>
                <th>Visa Type</th>
                <th>Agent</th>
                <th>Alter</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

