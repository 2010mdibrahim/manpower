<?php
    $candidateId = $_POST['candidateId'];
    $qry = "select candidate.*,profession.professionId,profession.professionName from candidate
                inner join profession on profession.professionId = candidate.profId where candidate.candidateId = $candidateId";
    $result = mysqli_query($conn,$qry);
    $candidate = mysqli_fetch_assoc($result);
    $professionId = $candidate['professionId'];
    $qry = "select * from passport where candidateId = $candidateId";
    $result = mysqli_query($conn,$qry);
    $passport = mysqli_fetch_assoc($result);
    $qry = "select professionId, professionName from profession where professionId != $professionId";
    $result = mysqli_query($conn,$qry);
?>

<!-- Contact Start -->
<div class="contact">
    <div class="container">
        <div class="section-header">
            <h2>New Candidate Information</h2>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="contact-form">
                    <form action="template/editCandidateQry.php" method="post">
                        <input type="hidden" value="<?php echo $candidateId;?>" name="candidateId">
                        <input type="hidden" value="update" name="alter">
                        <h3>Candidate Information</h3>
                        <div class="form-group" style="background-color: #D6D6D6; padding: 2%">
                            <label>First Name</label>
                            <input type="text" class="form-control" required="required" name="fName" value="<?php echo $candidate['fName']; ?>"/>
                            <br>
                            <label>Last Name</label>
                            <input type="text" class="form-control" required="required" name="lName" value="<?php echo $candidate['lName']; ?>"/>
                            <br>
                            <label>Fathers Name</label>
                            <input type="text" class="form-control" required="required" name="fathName" value="<?php echo $candidate['fathName']; ?>"/>
                            <br>
                            <label>Mobile No.</label>
                            <input type="text" class="form-control" required="required" name="mbNo" value="<?php echo $candidate['mob']; ?>"/>
                            <br>
                            <label>DOB</label>
                            <input type="date" class="form-control" required="required" name="dob" value="<?php echo $candidate['dob']; ?>"/>
                            <br>
                            <label>Place of Birth</label>
                            <input type="text" class="form-control" required="required" name="pob" value="<?php echo $candidate['pob']; ?>"/>
                            <br>
                            <label for="sel1">Profession:</label>
                            <select class="form-control" id="prof" name="profId">
                                <option value="<?php echo $candidate['professionId']; ?>"><?php echo $candidate['professionName']; ?></option>
                                <?php
                                while($profession = mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?php echo $profession['professionId']; ?>"><?php echo $profession['professionName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <h3>Address information</h3>
                        <div class="form-group" style="background-color: #D6D6D6; padding: 2%">
                            <label>Address</label>
                            <input type="text" class="form-control" required="required" name="add" value="<?php echo $candidate['addrs']; ?>"/>
                            <br>
                            <label for="sel1">Country:</label>
                            <select class="form-control" id="count" name="count">
                                <option><?php echo $candidate['count']; ?></option>
                                <option>Bangladesh</option>
                                <option>India</option>
                            </select>
                            <br>
                            <label>State</label>
                            <input type="text" class="form-control" required="required" name="state" value="<?php echo $candidate['state']; ?>"/>
                            <br>
                            <label>City</label>
                            <input type="text" class="form-control" required="required" name="city" value="<?php echo $candidate['city']; ?>"/>
                        </div>
                        <h3>Passport Information</h3>
                        <div class="form-group" style="background-color: #D6D6D6; padding: 2%">
                            <label>Passport No.</label>
                            <input type="text" class="form-control" required="required" name="passNo" value="<?php echo $passport['passNo']; ?>"/>
                            <br>
                            <label>Issue place</label>
                            <input type="text" class="form-control" required="required" name="issuP" value="<?php echo $passport['issuPlace']; ?>"/>
                            <br>
                            <label>Issue Date</label>
                            <input type="date" class="form-control" required="required" name="issuD" value="<?php echo $passport['issuDate']; ?>"/>
                            <br>
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" required="required" name="expD" value="<?php echo $passport['expDate']; ?>"/>
                            <br>
                            <label for="sel1">Type of passport:</label>
                            <select class="form-control" id="type" name="type">
                                <option><?php echo $passport['type']; ?></option>
                                <option>E - passport</option>
                                <option>GE</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>