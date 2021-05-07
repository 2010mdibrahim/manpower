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
                        <input type="hidden" name="delegateId" id="delegateIdModal">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteDelegateExpense">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editOfficeToDelegateExpense.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion Of Delegate Account?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" name="alter" value="delete">
                        <input type="hidden" name="delegateId" id="delegateIdModalDelete">
                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <button class="btn btn-danger"> Confirm Deletion </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
                        <input type="hidden" name="delegateId" id="delegateIdModalOffice">
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
                <div class="form-group col-print-3" >
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
                
                <div id="localOffice" class="col-print-4">
                    <div class="form-group row align-items-end">
                        <div class="col-sm">
                            <label> Amount in Dollar </label>
                            <input class="form-control" type="number" name="amount" id="amountDelegate" placeholder="Enter Amount in Dollar" onkeyup="calculateBDT()">                   
                        </div>
                        <div class="col-sm">
                            <label> Dollar Rate </label>
                            <input class="form-control" type="number" name="rate" id="rateDelegate" placeholder="Enter Dollar Rate" step="any" onkeyup="calculateBDT()">                 
                        </div>
                    </div>
                </div>
                <div class="form-group col-print-2">
                    <label> Amount in BDT </label>
                    <input class="form-control" type="number" name="amountBDT" id="amountBDTDelegate" readonly="readonly">
                </div>
                <div class="form-group col-print-2">
                    <label> Date </label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="date" placeholder="Enter date">                   
                </div>  
                <div class="form-group col-print-1">
                    <input class="form-control" type="submit" name="submit" id="" value="Add">
                </div>
            </div>
            <div class="form-row">
                <div class="col-print-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="addLocal" name="addLocal" onchange="localCurrancy()">
                        <label class="form-check-label" for="addLocal">
                            Add Local Currancy
                        </label>
                    </div>
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
                    <div class="col-print-3">Delegate Name</div>
                    <div class="col-print-4">Total Amount</div>
                    <div class="col-print-4">Remaining Balance</div>
                    <div class="col-print-1">Show</div>
                </div>
            </li>
            <?php
            $result = $conn->query("SELECT delegateName, delegateId from delegate");
            $i = 1;
            while($delegate = mysqli_fetch_assoc($result)){
                $sumOffice = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as officeSum from delegatetotalexpenseoffice where delegateId = ".$delegate['delegateId']));
            ?>
            <div id="<?php echo $delegate['delegateId']."_print";?>">
                <li class="list-group-item highlight mb-1" id="<?php echo $delegate['delegateId']."_highlight";?>">
                    <div class="row text-center">
                        <div class="col-print-3"><?php echo $delegate['delegateName'];?></div>
                        <div class="col-print-4"><?php 
                        $delegateTotalAmount = mysqli_fetch_assoc($conn->query("SELECT sum(amount*rate) as totalAmount from delegatetotalexpense where delegateId = ".$delegate['delegateId']));
                        echo number_format(round($delegateTotalAmount['totalAmount'])); ?> Taka</div>
                        <div class="col-print-4"><?php echo number_format(round($delegateTotalAmount['totalAmount']) - $sumOffice['officeSum']);?> Taka</div>
                        <div class="col-print-1 exclude">
                            <div class="row justify-content-center">
                                <div class="form-group">
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#addOffice" value="<?php echo $delegate['delegateId'];?>" onclick="modalValue(this.value)"><span class="fa fa-plus"></span></button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-show" id="btnShow<?php echo $delegate['delegateId'];?>" value="<?php echo $delegate['delegateId'];?>" onclick="showExpense(this.value)"><span class="fa fa-sort-down"></span></button>
                                    <button class="btn btn-sm btn-hide" id="btnHide<?php echo $delegate['delegateId'];?>" value="<?php echo $delegate['delegateId'];?>" onclick="hideExpense(this.value)" style="display: none;"><span class="fa fa-sort-up"></span></button>
                                </div>
                                <div class="form-group">
                                    <button data-toggle="modal" data-target="#deleteDelegateExpense" class="btn btn-sm btn-danger" value="<?php echo $delegate['delegateId'];?>" onclick="getDelegateValue(this.value)"><span class="fa fa-close"></span></button>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-info" value="<?php echo $delegate['delegateId'].'_print';?>" onclick="print_div(this.value)"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item details" style="display: none;" id="<?php echo $delegate['delegateId']  ;?>">
                </li>
            </div>
            <?php } ?>
        </ul>
    </div>
</div>

<script>
    function getDelegateValue(val){
        $('#delegateIdModalDelete').val(val);
    }

    function print_div(val){
        $("#" + val).print({
            noPrintSelector: ".exclude",
            globalStyles: true,
            doctype: '<!doctype html>',    
        });
    }
    function localCurrancy(){
        let show = ($("input[name='addLocal']:checked").val() === 'yes') ? 'local' : 'foreign';
        console.log(show);
        $.ajax({
            type: 'post',
            url: 'template/fetchLocal.php',
            data: {show: show},
            success: function (response){
                $('#localOffice').html(response);
                if(show === 'local'){
                    document.getElementById('amountBDTDelegate').readOnly = false;
                }else{
                    document.getElementById('amountBDTDelegate').readOnly = true;
                }
            }
        });
    }

    function calculateBDT(){
        let amount = $('#amountDelegate').val();
        let rate = $('#rateDelegate').val();
        let bdt = amount * rate;
        $('#amountBDTDelegate').val(bdt);
    }

    function getDelegateOffice(type, sentFrom = ''){
        $.ajax({
            type: 'post',
            data: {type: type},
            url: 'template/fetchDelegateExpenseOffice.php',
            success: function (response){
                if(sentFrom === 'local'){
                    $('#getOfficeDelegate').html(response);
                }else{
                    $('#getOffice').html(response);
                }                
                $('#officeSelect').select2({
                    width: '100%'
                });
            }
        });
    }

    var highlight = $('#highlightDelegate').val();
    if(highlight != 'no'){
        showExpense(highlight);
    }
    $('#delegateNav').addClass('active');
    function editOfficeExpense(info){
        const info_split = info.split('_');
        $('#delegateTotalExpenseOfficeId').val(info_split[0]);
        $('#amountModalOffice').val(info_split[1]);
        $('#dateModalOffice').val(info_split[2]);
        $('#delegateIdModalOffice').val(info_split[3]);
    }
    function editDelegateExpense(info){
        const info_split = info.split('_');
        $('#editDelegateTotalExpenseIdModal').val(info_split[0]);
        $('#amountModal').val(info_split[1]);
        $('#dateModal').val(info_split[2]);
    }
    function modalValue(id){
        $('#delegateIdModal').val(id);
    }
    function showExpense(val){
        $('.highlight').css('background-color', 'white'); //resetting prev list
        $('.btn-show').show(); //resetting prev list
        $('.btn-hide').hide(); //resetting prev list
        $('#btnShow'+val).hide();
        $('#btnHide'+val).show();
        $('.details').hide();
        $.ajax({
            type: 'post',
            data: {delegateId : val},
            url: 'template/fetchDelegateAllOfficeExpense.php',
            success: function(response){
                console.log(response);
                $('#'+val).html(response);
                $('#'+val).show();
                $('#'+val+'_highlight').css('background-color', '#b2dfdb');
            }
        });
    }
    function hideExpense(val){
        $('#btnShow'+val).show();
        $('#btnHide'+val).hide();
        $('#'+val).html('');
        $('#'+val).hide();
        $('#'+val+'_highlight').css('background-color', 'white');
    }
</script>