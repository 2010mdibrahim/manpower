<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Delegate</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Delegate Information</h3>
    <form action="template/addNewDelegateQry.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label>Delegate Name</label>
                    <input class="form-control" type="text" name="delegateName" id="delegateName" placeholder="Enter Name" required>
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
            <div class="form-row">
                <div id="officeDiv">
                    <div class="form-group">  
                        <label for="sel1">Office: </label>
                        <input class="form-control" type="text" name="delegateOffice[]" placeholder="Office name" required>
                    </div>
                </div>                
            </div>
            <div class="form-row">
                <div class="form-group">
                    <button class="btn btn-sm" type="button" id="add_office" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                    <button class="btn btn-sm btn-danger" type="button" id="remove_office"><span class="fas fa-minus" aria-hidden="true"></span></button>
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
    $('#delegateNav').addClass('active');
    $('#add_office').click(function(){
        var div = document.createElement("DIV");
        div.setAttribute('class', 'form-group');
        var input = document.createElement("INPUT");
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'delegateOffice[]');
        input.setAttribute('class', 'form-control');
        input.setAttribute('placeholder', 'Office Name');
        input.setAttribute('required','');
        div.appendChild(input);
        $('#officeDiv').append(div);
    });
    $('#remove_office').click(function(){
        $('#officeDiv').children().last().remove();
    });
</script>