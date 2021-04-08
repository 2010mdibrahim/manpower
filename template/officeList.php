<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Office", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$result = $conn -> query("SELECT * from office");
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
                <h2>Office List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Office Name</th>
                        <th>Comment</th> 
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <?php
                    while( $office = mysqli_fetch_assoc($result) ){                
                    ?>
                        <tr>
                            <td><?php echo $office['officeName'];?></td>
                            <td><?php echo $office['comment'];?></td>                 
                            <td>
                                <div class="flex-container"> 
                                    <div style="padding-left: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="edit">
                                            <input type="hidden" name="pagePost" value="editOffice">
                                            <input type="hidden" value="<?php echo $office['officeId']; ?>" name="officeId">
                                            <button type="submit" class="btn btn-primary btn-sm" name="manpower">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/newOfficeQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $office['officeId']; ?>" name="officeId">
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
    $('#officeNav').addClass('active');
</script>






