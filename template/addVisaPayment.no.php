<?php
$qry = "select agentId, agentName from agent";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Visa Bulk Payment</h2>
    </div>
    <form action="?page=">
        <div class="form-group">
            <label for="sel1">Select Visa Agent:</label>
            <select class="form-control" id="agentEmail" name="agentId">
                <option>Select agent</option>
                <?php while($agent = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $agent['agentId']; ?>"><?php echo $agent['agentName']; ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="page" value="addVisaPaymentWithAgent">
        </div>
        <br>
        <input type="submit" value="Search">
    </form>
</div>