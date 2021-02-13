<?php
include ('includes/ajax.php');
$qry = "select sponsorId, sponsorName from sponsor";
$result = mysqli_query($conn,$qry);
?>

<script type="text/javascript">
    function fetch_select(val)
    {
        $.ajax({
            type: 'post',
            url: 'template/reports/fetchSponsorVisa.php',
            data: {
                get_option:val
            },
            success: function (response) {
                document.getElementById("visa").innerHTML=response;
            }
        });
    }

</script>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h3>Select Sponsor</h3>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Candidate Agent Information</h3>
    <form action="index.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <input type="hidden" name="pagePost" value="sponsorDetailsReport">
                    <label for="sel1">Sponsor Name:</label>
                    <select class="form-control" id="sponsorId" name="sponsorId" onchange="fetch_select(this.value);">
                        <option>Select Sponsor</option>
                        <?php while($sponsor = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $sponsor['sponsorId'];?>"><?php echo $sponsor['sponsorName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label for="sel1">Visa:</label>
                    <select class="form-control" id="visa" name="visaId">
                        <option>Select Visa</option>
                    </select>

                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Search">
</div>
</form>
</div>