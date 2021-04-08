<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Sponsor", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$visaSponsor = $_POST['sponsorVisa'];
$amount = mysqli_fetch_assoc($conn->query("SELECT sponsor.sponsorName, sponsorvisalist.sponsorVisa, sponsorvisalist.visaAmount from sponsorvisalist inner join sponsor using (sponsorNID) where sponsorvisalist.sponsorVisa = '$visaSponsor'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add VISA to Sponsor</h2>
    </div>
    
    <form action="template/visaSponsorEditQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>Sponsor Name</label>
                    <input class="form-control" type="text" name="sponsorName" value="<?php echo $amount['sponsorName'];?>" readonly>
                </div>
                <div class="form-group col-md-6" >
                    <label>Sponsor VISA No</label>
                    <input class="form-control" type="text" name="sponsorVisa" value="<?php echo $amount['sponsorVisa'];?>" readonly>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">            
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>VISA Amount</label>
                    <input class="form-control" type="number" name="visaAmount" value="<?php echo $amount['visaAmount'];?>" readonly>
                </div>
                <div class="form-group col-md-6" >
                    <label>Add Amount</label>
                    <input class="form-control" type="number" name="addAmount" placeholder="0">
                </div>
            </div>
        </div>
        <div class="form-group" >        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Add" name="sponsorVisaEdit">
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>