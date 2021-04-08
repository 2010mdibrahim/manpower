<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$expenseId = $_POST['expenseId'];
$officeExpense = mysqli_fetch_assoc($conn->query("SELECT * from delegateofficeexpense where expenseId = $expenseId"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Delegate Office Expense</h2>
    </div>
    
    <form action="template/delegateOfficeExpenseQry.php" method="post" enctype="multipart/form-data">       
        <input type="hidden" name="alter" value="update">
        <input type="hidden" name="expenseId" value="<?php echo $expenseId;?>">
        <div class="form-group">            
            <div class="form-row">  
                <!-- PASSPORT INFORMATION -->
                <div class="form-group col-md-6">
                    <label> Manpower Office </label>
                    <select class="form-control select2" id="manpowerOfficeId" name="manpowerOfficeId" required>
                        <?php
                        $result = $conn->query("SELECT manpowerOfficeId, manpowerOfficeName from manpowerOffice");
                        while($manpowerOffice = mysqli_fetch_assoc($result)){
                            if($officeExpense['manpowerOfficeId'] == $manpowerOffice['manpowerOfficeId']){ ?>
                                <option value="<?php echo $manpowerOffice['manpowerOfficeId']; ?>" selected><?php echo $manpowerOffice['manpowerOfficeName']; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $manpowerOffice['manpowerOfficeId']; ?>"><?php echo $manpowerOffice['manpowerOfficeName']; ?></option>
                            <?php }?>
                        <?php } ?>
                    </select>                    
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="form-group col-md-6" >
                    <label> Delegate Name </label>
                    <select class="form-control select2" id="delegateId" name="delegateId" required>
                        <?php
                        $result = $conn->query("SELECT delegateId, delegateName from delegate");
                        while($delegate = mysqli_fetch_assoc($result)){
                            if($officeExpense['delegateId'] == $delegate['delegateId']){ ?>
                                <option value="<?php echo $delegate['delegateId']; ?>" selected><?php echo $delegate['delegateName']; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $delegate['delegateId']; ?>"><?php echo $delegate['delegateName']; ?></option>
                            <?php }?>
                        <?php } ?>
                    </select>                  
                </div>
            </div>
            <div class="form-row">  
                <!-- PASSPORT INFORMATION -->
                <div class="form-group col-md-6">
                    <label> Office Receipt </label>
                    <input class="form-control-file" type="file" name="officeReceipt">                   
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="form-group col-md-6" >
                    <label> Delegate Receipt </label>
                    <input class="form-control-file" type="file" name="delegateReceipt">                  
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label> Amount </label>
                    <input class="form-control" type="number" name="amount" value="<?php echo $officeExpense['amount'];?>" required>                 
                </div>
                <div class="form-group col-md-6" >
                    <label> Pay Date </label>
                    <input class="form-control datepicker" type="text" autocomplete="off" name="payDate" value="<?php echo $officeExpense['date'];?>">                 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label> Comment </label>
                    <input class="form-control" type="text" name="comment" placeholder="Any Comment...">                 
                </div>
            </div>
        </div>
        <div class="form-group">
            <input style="margin: auto; width: auto" class="form-control" type="submit" value="Update Expense">
        </div>        
    </form>
</div>

<script>
    $('#delegateNav').addClass('active');
</script>