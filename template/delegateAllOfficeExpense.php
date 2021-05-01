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
?>
<style>
.form-group{
    padding-right: 2%;
}
</style>
<div class="container-fluid" style="padding: 2%" style="width: 100%;">
    <!-- Add Office to delegate expense Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addOffice">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/addOfficeToDelegateExpense.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Office Expense Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delegateTotalExpenseId" id="delegateTotalExpenseIdModal">
                        <label> Choose Type Of Recipient </label>
                        <select class="form-control select2" id="type" name="type" onchange="getDelegateOffice(this.value)" required>
                            <option value="">Select Type</option>
                            <option value="manpower">Manpower Office</option>
                            <option value="outside">Outside Office</option>
                            <option value="other">Other</option>
                        </select>
                        <div id="getOffice"></div>                        
                        <label> Amount </label>
                        <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter Amount">
                        <label> Date </label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="date" placeholder="Enter date">                       
                        <label> Receipt </label>
                        <input class="form-control" type="file" name="officeReceipt" id="officeReceipt">                       
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
    <input type="hidden" value="<?php echo (isset($_GET['dei'])) ? base64_decode($_GET['dei']) : 'no'; ?>" name="highlightDelegate" id="highlightDelegate">
    <form action="template/delegateAllOfficeExpenseQry.php" method="post" enctype="multipart/form-data">       
        <div class="form-group">            
            <div class="form-row align-items-end">      
                <div class="form-group col-md-3" >
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
                <div class="form-group col-md-2">
                    <label> Amount in Dollar </label>
                    <input class="form-control" type="number" name="amount" id="amountDelegate" placeholder="Enter Amount in Dollar" onkeyup="calculateBDT()">                   
                </div>
                <div class="form-group col-md-2">
                    <label> Dollar Rate </label>
                    <input class="form-control" type="number" name="rate" id="rateDelegate" placeholder="Enter Dollar Rate" step="any" onkeyup="calculateBDT()">                 
                </div>
                <div class="form-group col-md-2">
                    <label> Amount in BDT </label>
                    <input class="form-control" type="number" name="amountBDT" id="amountBDTDelegate" readonly>                 
                </div>
                <div class="form-group col-md-2">
                    <label> Date </label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="date" placeholder="Enter date">                   
                </div>  
                <div class="form-group col-md-1">
                    <input class="form-control" type="submit" name="submit" id="" value="Add">
                </div>
            </div>
        </div>      
    </form>
    <div class="card" style="width: 100%;">
        <div class="card-header text-center">
            Delegate Expense Details
        </div>
        <ul class="list-group list-group-flush" style="height: 500px; overflow: auto;">
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
                <li class="list-group-item" id="<?php echo $delegateTotal['delegateTotalExpenseId']."_highlight";?>">
                    <div class="row text-center">
                        <div class="col-md-2"><?php echo $delegateTotal['delegateName'];?></div>
                        <div class="col-md-3"><?php echo number_format($delegateTotal['amount'] * $delegateTotal['rate']);?> Taka</div>
                        <div class="col-md-3"><?php echo number_format($delegateTotal['amount'] * $delegateTotal['rate'] - $sumOffice['officeSum']);?> Taka</div>
                        <div class="col-md-3"><?php echo $delegateTotal['date'];?></div>
                        <div class="col-md-1">
                            <div class="row justify-content-center">
                                <div class="form-group">
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#addOffice" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>" onclick="modalValue(this.value)"><span class="fa fa-plus"></span></button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-show" id="btnShow<?php echo $delegateTotal['delegateTotalExpenseId'];?>" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>" onclick="showExpense(this.value)"><span class="fa fa-sort-down"></span></button>
                                    <button class="btn btn-sm btn-hide" id="btnHide<?php echo $delegateTotal['delegateTotalExpenseId'];?>" value="<?php echo $delegateTotal['delegateTotalExpenseId'];?>" onclick="hideExpense(this.value)" style="display: none;"><span class="fa fa-sort-up"></span></button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editDelegateExpense" value="<?php echo $delegateTotal['delegateTotalExpenseId']."_".$delegateTotal['amount']."_".$delegateTotal['date'];?>" onclick="editDelegateExpense(this.value)"><span class="fa fa-edit"></span></button>
                                </div>
                                <div class="form-group">
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
    function calculateBDT(){
        let amount = $('#amountDelegate').val();
        let rate = $('#rateDelegate').val();
        let bdt = amount * rate;
        $('#amountBDTDelegate').val(bdt);
    }

    function getDelegateOffice(type){
        $.ajax({
            type: 'post',
            data: {type: type},
            url: 'template/fetchDelegateExpenseOffice.php',
            success: function (response){
                $('#getOffice').html(response);
                $('#officeSelect').select2({
                    width: '100%'
                });
            }
        });
    }

    var highlight = $('#highlightDelegate').val();
    if(highlight != 'no'){
        $('#'+highlight+'_highlight').attr("style", "background-color: #b2dfdb;");
        setTimeout(function(){ $('#'+highlight+'_highlight').attr("style", "background-color: '';"); }, 3000);        
    }
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