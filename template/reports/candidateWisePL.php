<?php
include ('includes/ajax.php');
$qry = "select candidateId, fName, lName from candidate";
$result = mysqli_query($conn,$qry);
?>

<script type="text/javascript">
    function fetch_select(val)
    {
        $.ajax(
            {
                type: 'post',
                url: 'template/reports/fetchCandidateWisePL.php',
                data: {get_option:val},
                success: function (response) {
                    document.getElementById("passport").innerHTML=response;
                }
            }
        );
    }

</script>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add New Agent</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
    <form action="index.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <input type="hidden" name="pagePost" value="candidateWisePlReport">
                    <label for="sel1">Candidate Name:</label>
                    <select class="form-control" id="candidateId" name="candidateId" onchange="fetch_select(this.value);">
                        <option>Select Candidate</option>
                        <?php while($candidate = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $candidate['candidateId'];?>"><?php echo $candidate['fName']." ".$candidate['lName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Passport:</label>
                    <select class="form-control" id="passport" name="passport">
                        <option>Select Agent Type</option>
                    </select>

                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Search">
</div>
</form>
</div>