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
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Manpower Office List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Office Name</th>
                        <th>Office License</th>
                        <th>Office Address</th>
                        <th>Comment</th> 
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <?php
                    while( $manpower = mysqli_fetch_assoc($result) ){                
                    ?>
                        <tr>
                            <td><?php echo $manpower['manpowerOfficeName'];?></td>
                            <td><?php echo $manpower['licenseNumber'];?></td>
                            <td><?php echo $manpower['officeAddress'];?></td>
                            <td><?php echo $manpower['comment'];?></td>                 
                            <td>
                                <div class="flex-container">
                                    
                                </div>
                                <div class="flex-container">
                                <div style="padding-left: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="editManpowerOffice">
                                            <input type="hidden" value="<?php echo $manpower['manpowerOfficeId']; ?>" name="manpowerOfficeId">
                                            <button type="submit" class="btn btn-info btn-sm" name="manpower">Edit</></button>
                                        </form>
                                    </div>
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
    </div>
</div>

<script>
    $('#manpowerNav').addClass('active');
</script>






