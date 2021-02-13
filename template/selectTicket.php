<?php
$qry = "select passNo from passport";
$result = mysqli_query($conn,$qry);

?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Select Passport</h2>
    </div>
    <form action="?page=selectTicketWithPassport">
        <div class="form-group">
            <label for="sel1">Select Passport Number:</label>
            <select class="form-control" id="passport" name="passport">
                <option>Select passport</option>
                <?php while($passNo = mysqli_fetch_assoc($result)){ ?>
                    <option><?php echo $passNo['passNo']; ?></option>
                <?php } ?>
            </select>
            <input type="hidden" value="selectTicketWithPassport" name="page">
        </div>
        <br>
        <input type="submit" value="Search">
    </form>
</div>