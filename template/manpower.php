<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Manpower Office</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Office Information</h3>
    <form action="template/manpowerQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Office Name</label>
                    <input class="form-control" autocomplete="off" type="text" name="officeName" placeholder="Enter Name">
                </div>
                <div class="form-group col-md-6">
                    <label>License Number</label>
                    <input class="form-control" autocomplete="off" type="text" name="licenseNumber" placeholder="Enter License Number">
                </div>                
                <div class="form-group col-md-6">
                    <label>Office Address</label>
                    <input class="form-control" autocomplete="off" type="text" name="officeAddress" placeholder="Enter Office Address">
                </div>
                <div class="form-group col-md-6">
                    <label>Comment</label>
                    <input class="form-control" autocomplete="off" type="text" id="sponsorVisa" name="comment" placeholder="Any comment">
                </div>
            </div>
        </div>      
        <input style="margin: auto; width: auto" class="form-control" type="submit" value="Add" name="manpower">
    </form>
</div>

<script>
    $('#manpowerNav').addClass('active');
</script>