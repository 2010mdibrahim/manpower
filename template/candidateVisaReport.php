<?php
$candidateId = $_POST['candidateId'];
$passport = $_POST['passportNo'];
$qry = "select * from candidate";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $('document').ready(function() {
        $('#listTable').DataTable();
    });
</script>



<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table id="listTable" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>Visa Fee Stage</th>
                <th>Mob No</th>
                <th>Profession</th>
                <th>Country</th>
                <th>City</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            while( $candidate = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $candidate['fName']." ".$candidate['lName'];?></td>
                    <td><?php echo $candidate['mob'];?></td>
                    <td><?php echo $candidate['prof'];?></td>
                    <td><?php echo $candidate['count'];?></td>
                    <td><?php echo $candidate['city'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['candidateId']; ?>" name="candidateId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/editCandidateQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['candidateId']; ?>" name="candidateId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr>
                <th>Candidate Name</th>
                <th>Mob No</th>
                <th>Profession</th>
                <th>Country</th>
                <th>City</th>
                <th>Edit</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>


