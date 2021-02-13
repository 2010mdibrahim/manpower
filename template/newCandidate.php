<?php
$qry = "select professionId, professionName from profession";
$result = mysqli_query($conn,$qry);
?>

<div class="container">
    <div class="section-header">
        <h2>New Candidate Information</h2>
    </div>
    <form action="template/newCandidateInsert.php" method="post">
        <h4 class="bg-light">Candidate Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName"/>
                <br>
                <label>Fathers Name</label>
                <input type="text" class="form-control" required="required" name="fathName"/>
                <br>
                <label>DOB</label>
                <input type="date" class="form-control" required="required" name="dob"/>
                <br>
                <label for="sel1">Profession:</label>
                <select class="form-control" id="professionId" name="professionId">
                    <option>Select profession</option>
                    <?php
                    while($profession = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?php echo $profession['professionId'];?>"><?php echo $profession['professionName'];?></option>
                    <?php }?>
                </select>
            </div>
            <div class="column col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" required="required" name="lName"/>
                <br>
                <label>Mobile No.</label>
                <input type="text" class="form-control" required="required" name="mbNo"/>
                <br>
                <label>Place of Birth</label>
                <input type="text" class="form-control datepicker" required="required" name="pob"/>
            </div>
        </div>
        <br>
        <h4 class="bg-light">Address Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>Address</label>
                <input type="text" class="form-control" required="required" name="add"/>
                <br>
                <label>City</label>
                <input type="text" class="form-control" required="required" name="city"/>
            </div>
            <div class="column col-md-6">
                <label for="sel1">Country:</label>
                <select class="form-control" id="count" name="count">
                    <option>Select Country</option>
                    <option>Bangladesh</option>
                    <option>India</option>
                </select>
                <br>
                <label>State</label>
                <input type="text" class="form-control" required="required" name="state"/>
            </div>
        </div>
        <br>
        <h4 class="bg-light">Passport Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passNo"/>
                <br>
                <label>Issue Date</label>
                <input type="date" class="form-control" required="required" name="issuD"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Issue place</label>
                <input type="text" class="form-control" required="required" name="issuP"/>
                <br>
                <label>Expiry Date</label>
                <input type="date" class="form-control" required="required" name="expD"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label for="sel1">Type of passport:</label>
                <select class="form-control" id="type" name="type">
                    <option>Select type passport</option>
                    <option>E - passport</option>
                    <option>GE</option>
                </select>
            </div>
        </div>
        <br>
        <div>
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: 15%" value="Submit">
        </div>
    </form>
</div>
