<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Agent", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$agentEmail = $_POST['agentEmail'];
$agent = mysqli_fetch_assoc($conn -> query("select * from agent where agentEmail = '$agentEmail'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Agent Information</h3>
    <form action="template/addNewAgentQry.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Agent Name</label>
                    <input class="form-control" type="text" name="agentName" id="agentName" value="<?php echo $agent['agentName'];?>">
                </div>
                <div class="form-group col-md-6" >  
                    <label for="sel1">Agent Email: <span class="samin danger" >Email Already Exists</span> </label>
                    <input class="form-control" type="email" name="agentEmail" value="<?php echo $agent['agentEmail'];?>" id="agentEmail" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">Phone:</label>
                    <input class="form-control" type="text" name="agentPhone" id="agentPhone" value="<?php echo $agent['agentPhone'];?>" required>
                </div>                
                <div class="form-group col-md-6">
                    <label for="sel1">Any Remarks:</label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $agent['comment'];?>" placeholder="comment">
                </div>
                <div class="form-group col-md-4">
                    <label for="sel1">Photo:</label>
                    <input class="form-control-file" type="file" name="agentImage" id="photo">
                </div>
                <div class="form-group col-md-4">
                    <label for="sel1">Passport Scan Copy:</label>
                    <input class="form-control-file" type="file" name="agentPassport" id="passport">
                </div>
                <div class="form-group col-md-4">
                    <label for="sel1">Police Clearance:</label>
                    <input class="form-control-file" type="file" name="agentPolice" id="police">
                </div>
            </div>
        </div>
        <div id="test"></div>
        <div class="form-group">
            <input style="width: auto; margin: auto;" class="form-control" id="insert" type="submit" value="Update">
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('#insert').click(function (){
            let image_name = $('#image').val();
            var extension = $('#image').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)
            {
                alert('Invalid Image File');
                $('#image').val('');
                return false;
            }
        });
    });

    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>