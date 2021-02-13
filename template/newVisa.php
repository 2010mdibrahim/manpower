<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Visa Information</h2>
    </div>
    <h4 class="bg-light">Visa Information</h4>
    <form action="template/saveVisa.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <?php
                    $qry = "select sponsorNID, sponsorName from sponsor";
                    $result = mysqli_query($conn,$qry);
                    ?>
                    <label> Select Sponsor of VISA </label>
                    <select class="form-control" id="sponsorId" name="sponsorId" onchange="fetchSponsorData(this.value)">
                        <option>Select Sponsor</option>
                        <?php
                        while($sponsor = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $sponsor['sponsorNID']; ?>"><?php echo $sponsor['sponsorName']; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label>Visa Catagory</label>
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input style="width: 50%" type="text" name="category[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">
                            <input type="number" name="categoryAmount[]" class="form-control m-input" placeholder="Amount" autocomplete="off">
                        </div>
                    </div>
                    <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                </div>
                <div class="column col-md-6">
                    <label>Sponsor Visa Id</label>
                    <input type="text" class="form-control" required="required" name="name" id="sponsorVisaId" value="Select Sponsor" readonly/>
                    <br>
                    <label>Visa Date</label>
                    <input type="date" class="form-control" required="required" name="date"/>
                </div>
            </div>
        </div>
        <h4 class="bg-light">Visa Detail Information</h4>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-4">
                    <label>Basic Salary</label>
                    <input type="number" class="form-control" required="required" name="bSalary"/>
                </div>
                <br>
                <div class="column col-md-4" style="margin-left: auto">
                    <label>Visa Inclusions</label>
                    <div class="form-check" >
                        <div class="row">
                            <input type="checkbox" name="check1" value="one" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Accommodation</label>
                        </div>
                        <div class="row">
                            <input type="checkbox" name="check1" value="one" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Food</label>
                        </div>
                        <div class="row">
                            <input type="checkbox" name="check1" value="one" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Overtime</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <input style="margin: auto; width: 15%" class="form-control" type="submit" value="Add Visa">
</div>
</form>
</div>
<script>
    function fetchSponsorData(val){
        $('#sponsorVisaId').val(val);
    };
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input style="width: 50%" type="text" name="category[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
        html += '<input type="number" name="categoryAmount[]" class="form-control m-input" placeholder="Amount" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });

</script>