<style>
    .column{
        padding: 2%;
    }
</style>
<div class="container" style="width:500px;">
    <div class="section-header">
        <h2>Add MOFA</h2>
    </div>

    <form action="template/uploadFileQry.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>MOFA Code</label>
                    <input class="form-control" type="text" name="mofaCode" placeholder="Enter Mofa Code">
                    <br>
                    <label for="sel1">MOFA Approval Evidence:</label>
                    <input type="file" name="image" id="image" />
                </div>
                <div class="column col-md-6">
                    <label>MOFA Remark</label>
                    <input class="form-control" type="text" name="mofaRemark" placeholder="Remark">
                    <br>
                    <label>Passport</label>
                    <select class="form-control" name="passNo">
                        <option>Select Passport</option>
                        <?php
                        $qry = "SELECT passNo FROM passport LEFT JOIN mofa USING (passNo) where mofa.passNo is null";
                        $result = mysqli_query($conn,$qry);
                        while($pass = mysqli_fetch_assoc($result)){
                        ?>
                            <option><?php echo $pass['passNo'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">

                </div>
            </div>
        </div>

        <br />
        <input type="submit" name="insert" id="insert" value="Submit" class="form-control" />
    </form>
    <br />
    <br />
</div>
<script>
    $(document).ready(function(){
        $('#insert').click(function(){
            var image_name = $('#image').val();
            if(image_name == '')
            {
                alert("Please Select Image");
                return false;
            }
            else
            {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)
                {
                    alert('Invalid Image File');
                    $('#image').val('');
                    return false;
                }
            }
        });
    });
</script>