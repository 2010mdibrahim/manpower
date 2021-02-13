<?php
$qry = "select passNo from passport";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Select Visa</h2>
    </div>
    <form action="index.php" method="post">
        <div class="form-group">
            <input type="hidden" name="pagePost" value="mofaUpdate">
            <label for="sel1">Select Passport:</label>
            <select class="form-control" id="passNo" name="passNo">
                <option>Select Passport</option>
                <?php while($pass = mysqli_fetch_assoc($result)){ ?>
                    <option><?php echo $pass['passNo']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <input type="submit" value="search">
</div>
</form>
</div>