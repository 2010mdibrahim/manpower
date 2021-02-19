<?php
$agentEmail = $_POST['agentEmail'];
$agent = mysqli_fetch_assoc($conn -> query("select * from agent where agentEmail = '$agentEmail'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
    <form action="template/addNewAgentQry.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Agent Name</label>
                    <input class="form-control" type="text" name="agentName" id="agentName" value="<?php echo $agent['agentName'];?>">
                    <br>
                    <label for="sel1">Agent Email: <span class="samin danger" >Email Already Exists</span> </label>
                    <input class="form-control" type="email" name="agentEmail" value="<?php echo $agent['agentEmail'];?>" id="agentEmail">
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Phone:</label>
                    <input class="form-control" type="text" name="agentPhone" id="agentPhone" value="<?php echo $agent['agentPhone'];?>">
                    <br>
                    <label for="sel1">Photo:</label>
                    <input class="form-control" type="file" name="agentImage" id="image">
                </div>
                <div class="column col-md-6">
                    <br>
                    <label for="sel1">Any Remarks:</label>
                    <input class="form-control" type="text" name="comment" id="comment" value="<?php echo $agent['comment'];?>">
                </div>
            </div>
        </div>
        <br>
        <div id="test"></div>
        <input type="hidden" value="update" name="alter">
        <input id="insert" type="submit" value="Update">
</div>
</form>
</div>
<script>
    $(document).ready(function(){
        $('#insert').click(function (){
            let image_name = $('#image').val();
            if(image_name != ''){
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                    alert('Invalid Image File');
                    $('#image').val('');
                    return false;
                }
            }
        });
    });
</script>