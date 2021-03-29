<div class="container-fluid" style="padding: 2%" style="width: 100%;">
    <!-- Add Office to delegate expense Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addOffice">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/addOfficeToDelegateExpense.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Office Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delegateTotalExpenseId" id="delegateTotalExpenseIdModal">
                        <label> Office Name </label>
                        <select class="form-control select2" id="officeId" name="officeId" required>
                            <option value="">Select Office</option>
                            <?php
                            $result = $conn->query("SELECT officeId, officeName from office");
                            while($office = mysqli_fetch_assoc($result)){
                            ?>
                                <option value="<?php echo $office['officeId']; ?>"><?php echo $office['officeName']; ?></option>
                            <?php } ?>
                        </select>
                        <label> Amount </label>
                        <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter Amount">
                        <label> Date </label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="date" placeholder="Enter date">                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Delegate Expense Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editDelegateExpense">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editOfficeToDelegateExpense.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Delegate Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delegateTotalExpenseId" id="editDelegateTotalExpenseIdModal">
                        <label> Amount </label>
                        <input class="form-control" type="number" name="amount" id="amountModal">
                        <label> Date </label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="dateModal" placeholder="Enter date">                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Delegate Expense Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editOfficeExpense">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editOfficeExpense.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Office Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delegateTotalExpenseOfficeId" id="delegateTotalExpenseOfficeId">
                        <label> Amount </label>
                        <input class="form-control" type="number" name="amount" id="amountModalOffice">
                        <label> Date </label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="dateModalOffice" placeholder="Enter date">                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="section-header">
        <h2>Delegate Office Expense</h2>
    </div>
    
    <form action="template/delegateAllOfficeExpenseQry.php" method="post" enctype="multipart/form-data">       
        <div class="form-group">            
            <div class="form-row align-items-end">      
                <div class="form-group col-md-4" >
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
                <div class="form-group col-md-3">
                    <label> Amount </label>
                    <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter Amount">                   
                </div> 
                <div class="form-group col-md-3">
                    <label> Date </label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="date" placeholder="Enter date">                   
                </div>  
                <div class="form-group col-md-2">
                    <input class="form-control" type="submit" name="submit" id="" value="Add">
                </div>
            </div>
        </div>      
    </form>
    <div class="card" style="width: 100%;">
        <div class="card-header text-center">
            Delegate Expense Details
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
                <div class="row text-center">
                    <div class="col-md-2">Delegate Name</div>
                    <div class="col-md-3">Total Amount</div>
                    <div class="col-md-3">Remaining Balance</div>
                    <div class="col-md-3">Payment Date</div>
                    <div class="col-md-1">Show</div>
                </div>
            </li>
            <?php
            $result = $conn->query("SELECT delegate.delegateName, delegatetotalexpense.* from delegatetotalexpense inner join delegate using (delegateId) order by delegatetotalexpense.delegateTotalExpenseId desc");
            $i = 1;
            while($delegateTotal = mysqli_fetch_assoc($result)){
                $sumOffice = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as officeSum from delegatetotalexpenseoffice where delegateTotalExpenseId = ".$delegateTotal['delegateTotalExpenseId']));
            ?>
                <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-2"><?php echo $delegateTotal['delegateName'];?></div>
                        <div class="col-md-3"><?php echo number_format($delegateTotal['amount']);?> Taka</div>
                        <div class="col-md-3"><?php echo number_format($delegateTotal['amount'] - $sumOffice['officeSum']);?> Taka</div>
                        <div class="col-md-3"><?php echo $delegateTotal['date'];?></div>
                        <div class="col-md-1">
                            <div class="row justify-content-center">
                                <div class="col-md-1">
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#addOffice" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>" onclick="modalValue(this.value)"><span class="fa fa-plus"></span></button>
                                </div>                                
                                <div class="col-md-1">                                
                                    <button class="btn btn-sm btn-show" id="btnShow<?php echo $delegateTotal['delegateTotalExpenseId'];?>" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>" onclick="showExpense(this.value)"><span class="fa fa-sort-down"></span></button>
                                    <button class="btn btn-sm btn-hide" id="btnHide<?php echo $delegateTotal['delegateTotalExpenseId'];?>" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>" onclick="hideExpense(this.value)" style="display: none;"><span class="fa fa-sort-up"></span></button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editDelegateExpense" value="<?php echo $delegateTotal['delegateTotalExpenseId']."_".$delegateTotal['amount']."_".$delegateTotal['date'];?>" onclick="editDelegateExpense(this.value)"><span class="fa fa-edit"></span></button>
                                </div>
                                <div class="col-md-1">
                                <form action="template/editOfficeToDelegateExpense.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" name="delegateTotalExpenseId" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>">
                                    <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item details" style="display: none;" id="<?php echo $delegateTotal['delegateTotalExpenseId']  ;?>">
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<script>
    $('#delegateNav').addClass('active');
    function editOfficeExpense(info){
        const info_split = info.split('_');
        $('#delegateTotalExpenseOfficeId').val(info_split[0]);
        $('#amountModalOffice').val(info_split[1]);
        $('#dateModalOffice').val(info_split[2]);
    }
    function editDelegateExpense(info){
        const info_split = info.split('_');
        $('#editDelegateTotalExpenseIdModal').val(info_split[0]);
        $('#amountModal').val(info_split[1]);
        $('#dateModal').val(info_split[2]);
    }
    function modalValue(id){
        $('#delegateTotalExpenseIdModal').val(id);
    }
    function showExpense(val){
        $('.btn-hide').hide();
        $('.btn-show').show();
        $('#btnShow'+val).hide();
        $('#btnHide'+val).show();
        $('.details').hide();
        $.ajax({
            type: 'post',
            data: {delegateTotalExpenseId : val},
            url: 'template/fetchDelegateAllOfficeExpense.php',
            success: function(response){
                $('#'+val).html(response);
                $('#'+val).show();
            }
        });
    }
    function hideExpense(val){
        $('#btnShow'+val).show();
        $('#btnHide'+val).hide();
        $('#'+val).html('');
        $('#'+val).hide();
    }
</script>