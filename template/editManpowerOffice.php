<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Manpower", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$manpowerOfficeId = $_POST['manpowerOfficeId'];
$manpower = mysqli_fetch_assoc($conn->query("SELECT * from manpoweroffice where manpowerOfficeId = $manpowerOfficeId"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Manpower Office</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Office Information</h3>
    <form action="template/manpowerQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="manpowerOfficeId" value="<?php echo $manpowerOfficeId; ?>">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Office Name</label>
                    <input class="form-control" autocomplete="off" type="text" name="officeName" value="<?php echo $manpower['manpowerOfficeName'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label>License Number</label>
                    <input class="form-control" autocomplete="off" type="text" name="licenseNumber" value="<?php echo $manpower['licenseNumber'];?>">
                </div>                
                <div class="form-group col-md-6">
                    <label>Office Address</label>
                    <input class="form-control" autocomplete="off" type="text" name="officeAddress" value="<?php echo $manpower['officeAddress'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Comment</label>
                    <input class="form-control" autocomplete="off" type="text" id="sponsorVisa" name="comment" value="<?php echo $manpower['comment'];?>">
                </div>
            </div>
        </div>      
        <input style="margin: auto; width: auto" class="form-control" type="submit" value="Update" name="manpower">
    </form>
</div>

<script>
    $('#manpowerNav').addClass('active');
</script>