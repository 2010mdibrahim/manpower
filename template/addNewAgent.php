<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Agent Information</h3>
    <form action="template/addNewAgentQry.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Agent Name</label>
                    <input class="form-control" type="text" name="agentName" id="agentName" placeholder="Enter Name">
                </div>
                <div class="form-group col-md-6" >  
                    <label for="sel1">Agent Email: <span class="samin danger" >Email Already Exists</span> </label>
                    <input class="form-control" type="email" name="agentEmail" placeholder="example@abc.com" id="agentEmail">
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">Phone:</label>
                    <input class="form-control" type="text" name="agentPhone" id="agentPhone" placeholder="Phone Number">
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">Passport Photo:</label>
                    <input class="form-control-file" type="file" name="agentImage" id="image" >
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">Any Remarks:</label>
                    <input class="form-control" type="text" name="comment" id="comment" placeholder="comment">
                </div>
            </div>
        </div>
        <div id="test"></div>
        <div class="form-group">
            <input style="width: auto; margin: auto;" class="form-control" id="insert" type="submit" value="Add">
        </div>
        
</div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('#insert').click(function (){
            let image_name = $('#image').val();
            if(image_name === '')
            {
                alert("Please Select Image");
                return false;
            }
            else
            {
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

    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>