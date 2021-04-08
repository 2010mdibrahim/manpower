<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Office", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$officeId = $_POST['officeId'];
$office = mysqli_fetch_assoc($conn->query("SELECT * from office where officeId = $officeId"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Edit Office</h2>
    </div>
    
    <form action="template/newOfficeQry.php" method="post">   
        <input type="hidden" name="officeId" id="" value="<?php echo $officeId; ?>">    
        <input type="hidden" name="alter" id="" value="update">    
        <div class="form-group">            
            <div class="form-row">       
                <div class="form-group col-md-6" >
                    <label> Office Name </label>
                    <input class="form-control" type="text" name="officeName" id="officeName" value="<?php echo $office['officeName'];?>">                 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label> Comment </label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $office['comment'];?>">                 
                </div>
            </div>
        </div>
        <div class="form-group">
            <input style="margin: auto; width: auto" class="form-control" type="submit" value="Update Office">
        </div>        
    </form>
</div>

<script>      

    $('#officeNav').addClass('active');

</script>