<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Agent Information</h3>
    <form action="template/addNewDelegateQry.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Delegate Name</label>
                    <input class="form-control" type="text" name="delegateName" id="delegateName" placeholder="Enter Name" required>
                </div>
                <div class="form-group col-md-6" >  
                    <label for="sel1">Office: </label>
                    <input class="form-control" type="text" name="delegateOffice" placeholder="Office name" id="delegateOffice" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">Country:</label>
                    <input class="form-control" type="text" name="delegateCountry" id="delegateCountry" placeholder="Country" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="sel1">State:</label>
                    <input class="form-control" type="text" name="delegateState" id="delegateState" placeholder="State" required>
                </div>               
                <div class="form-group col-md-6">
                    <label for="sel1">Any Remarks:</label>
                    <input class="form-control" type="text" name="comment" id="comment" placeholder="comment">
                </div>
            </div>
        </div>
        <div id="test"></div>
        <div class="form-group">
            <input style="width: auto; margin: auto;" class="form-control" id="addDelegate" name="addDelegate" type="submit" value="Add">
        </div>
    </form>
</div>
<script>

    window.onload = function() {
        $('#delegateNav').addClass('active');
    };
</script>