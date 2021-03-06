<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$delegateId = $_POST['delegateId'];
$delegate = mysqli_fetch_assoc($conn->query("SELECT * from delegate where delegateId = $delegateId"));
?>

<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Edit Delegate</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Delegate Information</h3>
    <form action="template/addNewDelegateQry.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="delegateId" value="<?php echo $delegate['delegateId'];?>">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Delegate Name</label>
                    <input class="form-control" type="text" name="delegateName" id="delegateName" value="<?php echo $delegate['delegateName'];?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">Country:</label>
                    <input class="form-control" type="text" name="delegateCountry" id="delegateCountry" value="<?php echo $delegate['country'];?>" required>
                </div> 
                <div class="form-group col-md-6">
                    <label for="sel1">State:</label>
                    <input class="form-control" type="text" name="delegateState" id="delegateState" value="<?php echo $delegate['delegateState'];?>" required>
                </div>               
                <div class="form-group col-md-6">
                    <label for="sel1">Any Remarks:</label>
                    <input class="form-control" type="text" name="comment" id="comment" value="<?php echo $delegate['comment'];?>">
                </div>
            </div>
        </div>
        <div id="test"></div>
        <div class="form-group">
            <input style="width: auto; margin: auto;" class="form-control" id="addDelegate" name="addDelegate" type="submit" value="Update">
        </div>
    </form>
</div>
<script>
    $('#delegateNav').addClass('active');
    window.onload = function() {
        $('#delegateNav').addClass('active');
    };
</script>