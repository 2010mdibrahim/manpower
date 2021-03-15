<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Delegate Office Expense</h2>
    </div>
    
    <form action="template/delegateOfficeExpenseQry.php" method="post" enctype="multipart/form-data">       
        <div class="form-group">            
            <div class="form-row">  
                <!-- PASSPORT INFORMATION -->
                <div class="form-group col-md-6">
                    <label> Manpower Office </label>
                    <select class="form-control select2" id="manpowerOfficeId" name="manpowerOfficeId" required>
                        <option value="">Select Manpower Office</option>
                        <?php
                        $result = $conn->query("SELECT manpowerOfficeId, manpowerOfficeName from manpowerOffice");
                        while($manpowerOffice = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $manpowerOffice['manpowerOfficeId']; ?>"><?php echo $manpowerOffice['manpowerOfficeName']; ?></option>
                        <?php } ?>
                    </select>                    
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="form-group col-md-6" >
                    <label> Delegate Name </label>
                    <select class="form-control select2" id="delegateId" name="delegateId" required>
                        <option value="">Select Delegate</option>
                        <?php
                        $result = $conn->query("SELECT delegateId, delegateName from delegate");
                        while($delegate = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $delegate['delegateId']; ?>"><?php echo $delegate['delegateName']; ?></option>
                        <?php } ?>
                    </select>                  
                </div>
            </div>
            <div class="form-row">  
                <!-- PASSPORT INFORMATION -->
                <div class="form-group col-md-6">
                    <label> Office Receipt </label>
                    <input class="form-control-file" type="file" name="officeReceipt" required>                   
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="form-group col-md-6" >
                    <label> Delegate Receipt </label>
                    <input class="form-control-file" type="file" name="delegateReceipt" required>                  
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label> Amount </label>
                    <input class="form-control" type="number" name="amount" placeholder="Enter Amount" required>                 
                </div>
                <div class="form-group col-md-6" >
                    <label> Pay Date </label>
                    <input class="form-control datepicker" type="text" autocomplete="off" name="payDate" placeholder="Enter payment date">                 
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
            <input style="margin: auto; width: auto" class="form-control" type="submit" value="Add Expense">
        </div>        
    </form>
</div>

<script>
    $('#delegateNav').addClass('active');
</script>