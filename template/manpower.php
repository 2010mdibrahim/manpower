<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Manpower Office</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Office Information</h3>
    <form action="template/manpowerQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Office Name</label>
                    <input class="form-control" type="text" name="officeName" placeholder="Enter Name">
                    <br>
                </div>
                <div class="column col-md-6" >                    
                    <label>Comment</label>
                    <input class="form-control" type="text" id="sponsorVisa" name="comment" placeholder="Enter Visa">
                    <br>
                </div>
            </div>
        </div>      
        <input style="margin: auto; width: auto" class="form-control" type="submit" value="Add" name="manpower">
</div>
</form>

<script>
    $('#manpowerNav').addClass('active');
</script>