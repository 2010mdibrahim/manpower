<?php
$result = $conn -> query("SELECT * from manpoweroffice order by manpowerOfficeName");
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>Candidate List</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>Office Name</th>
                <th>Comment</th> 
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            while( $manpower = mysqli_fetch_assoc($result) ){                
            ?>
                <tr>
                    <td><?php echo $manpower['manpowerOfficeName'];?></td>
                    <td><?php echo $manpower['comment'];?></td>                 
                    <td>
                        <div class="flex-container">
                            <!-- <div style="padding-right: 2%" >
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $visaList['visaGenderType']; ?>" name="passportNum">
                                    <input type="hidden" value="<?php echo $visaList['jobType']; ?>" name="passportNum">
                                    <input type="hidden" value="<?php echo $visaList['sponsorName']; ?>" name="passportNum">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div> -->
                            <div style="padding-left: 2%">
                                <form action="template/manpowerQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $manpower['manpowerOfficeName']; ?>" name="officeName">
                                    <button type="submit" class="btn btn-danger btn-sm" name="manpower">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr hidden>
                <th>Office Name</th>
                <th>Comment</th> 
                <th>Edit</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

<script>
    window.onload = function() {
        $('#manpowerNav').addClass('active');
    };
</script>






