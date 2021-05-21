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
.flex-container {
    display: flex;
    flex-direction: row;
}
.modal-dialog.modal-dialog-report {
    max-width: 80%;
    margin: 1.75rem auto;
}
.returned_col{
    background-color: #bdbdbd;
    color: white;
}
.table-print a{
    text-decoration: none;
    color: black;
}
.form-group{
    padding-right: 2%;
}
.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0px;
  /* background-color: yellow;
  padding: 50px;
  font-size: 20px; */
}
.header-expesne-list{
    font-weight: bold;
}

@media print {
    .print-header{
        display: static;
    }
}
@media screen  {
    .print-header{
        display: none;
    }
    .list-overflow{
        height: 500px;
        overflow: auto;
    }
}
ul, li{
    list-style-type: none;
}
.row{
    margin-right: 0px;
    margin-left: 0px;
}
</style>
<div class="container-fluid" style="padding: 2%" style="width: 100%;">
    <!-- Agent Report Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="showAgentReport">
        <div class="modal-dialog modal-dialog-report modal-xl" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agent Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="showAgentReportDiv">

                    </div>
                    <div class="modal-footer">
                        <button id="print_button" class="btn btn-info" type="button" onclick="print_div_report(this.value)"><i class="fa fa-print"></i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
    <!-- Edit Delegate Office Expense Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editOfficeExpense">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editOfficeExpense.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Office Expense Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="account_maheer_id" id="account_maheer_id">
                        <input class="form-control" type="text" id="modal_office_name" disabled>
                        <div id="getOffice"></div>  
                        <div id="debit-modal">
                            <label> Debit Amount </label>
                            <input class="form-control" type="number" name="edit_debit_amount" id="edit_debit_amount">
                        </div>
                        <div id="debit-modal-dollar">                            
                            <label> Debit Amount in Dollar </label>
                            <input class="form-control" type="number" name="edit_dollar_rate" id="edit_dollar_rate" step="any">
                        </div>
                        <div id="credit-modal">
                            <label> Credit Amount </label>
                            <input class="form-control" type="number" name="edit_credit_amount" id="edit_credit_amount">
                            <label> Receipt </label>
                            <input class="form-control" type="file" name="officeReceipt" id="officeReceipt"> 
                        </div>
                        <label> Date </label>
                        <input class="form-control datepicker" autocomplete="off" type="text" name="date" id="edit_date" placeholder="Enter date">                                              
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php $delegate = mysqli_fetch_assoc($conn->query("SELECT delegateId, delegateName from delegate where delegateId = 22"));?>
    <div class="section-header">
        <h2><?php echo "'".$delegate['delegateName']."'"." Account"; ?></h2>
    </div>
    <input type="hidden" value="<?php echo (isset($_GET['dei'])) ? base64_decode($_GET['dei']) : 'no'; ?>" name="highlightDelegate" id="highlightDelegate">
    <form action="template/delegateAllOfficeExpenseQry.php" method="post" enctype="multipart/form-data">       
        <div class="form-group">                      
            <div class="form-row align-items-end">      
                <div class="form-group col-print-3" >
                    <label> Delegate Name </label>
                    <select class="form-control" id="delegateId" name="delegateId" required readonly>
                        <option value="<?php echo $delegate['delegateId']; ?>"><?php echo $delegate['delegateName']; ?></option>
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
            <div class="row justify-content-between">
                <div class="col-print-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="addLocal" name="addLocal" onchange="localCurrancy()">
                        <label class="form-check-label" for="addLocal">
                            Add Local Currancy
                        </label>
                    </div>
                </div>
                <div class="col-print-2">
                    <div style="float: right;" class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="full_report" name="full_report">
                        <label class="form-check-label" for="addLocal">
                            Include Full Report
                        </label>
                    </div>
                </div>
            </div>
        </div>      
    </form>
    <div class="card" style="width: 100%;">
        <div class="card-header text-center">
            <div class="row text-center">
                <div class="col-print-2 center-column">Delegate Name</div>
                <div class="col-print-4">Total Debit Amount</div>
                <div class="col-print-4">Remaining Balance</div>
                <div class="col-print-2">Options</div>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            
            <?php
            $today = date('Y-m-d');
            $delegate = mysqli_fetch_assoc($conn->query("SELECT delegateName, delegateId from delegate where delegateId = 22"));
            $i = 1;
            $sum_office = mysqli_fetch_assoc($conn->query("SELECT sum(credit) as credit_sum, sum(debit*dollar_rate_debit) as debit_sum from account_maheer"));
            // this is comission and other expense that maheer gave maam
            $sumAgent = mysqli_fetch_assoc($conn->query("SELECT sum(fullAmount) as total from agentexpense where agentEmail = 'maheeer2010@hotmail.com'"));
            // candidate expense w/o ticket price and manpowerprocessing cost
            $delegateCandidateExpense = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as totalAmount from candidateexpense where agentEmail = 'maheeer2010@hotmail.com'"));
            // sum of processing cost
            $manpower_processing = mysqli_fetch_assoc($conn->query("SELECT sum(manpowerjobprocessing.processingCost) as processing_cost_sum from passport INNER JOIN manpoweroffice USING (manpowerOfficeName) INNER JOIN manpowerjobprocessing on manpoweroffice.manpowerOfficeId = manpowerjobprocessing.manpowerOfficeId INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where passport.agentEmail = 'maheeer2010@hotmail.com' and processing.visaStampingDate < '$today'"));
            // sum of ticket price
            $ticket_price = mysqli_fetch_assoc($conn->query("SELECT SUM(ticket.ticketPrice) as ticket_sum FROM ticket INNER JOIN processing on processing.passportNum = ticket.passportNum AND processing.passportCreationDate = ticket.passportCreationDate INNER JOIN passport on passport.passportNum = ticket.passportNum AND passport.creationDate = ticket.passportCreationDate where processing.visaStampingDate < '$today' and passport.agentEmail = 'maheeer2010@hotmail.com'"));

            $totalCredit = $sum_office['debit_sum'] + $delegateCandidateExpense['totalAmount'] + $manpower_processing['processing_cost_sum'] + $ticket_price['ticket_sum'];
            $totalDebit = $sumAgent['total'] + $sum_office['credit_sum'];
            ?>
            <!-- Expense details Modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="expense_details">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="template/addOfficeToDelegateExpense.php" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Expense details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Total Debit: <?php echo number_format($sum_office['debit_sum']); ?> &#2547;</li>
                                            <li class="list-group-item">Total candidate expense: <?php echo number_format($delegateCandidateExpense['totalAmount']); ?> &#2547;</li>
                                            <li class="list-group-item">Total processing cost: <?php echo number_format($manpower_processing['processing_cost_sum']); ?> &#2547;</li>
                                            <li class="list-group-item">Total ticket price: <?php echo number_format($ticket_price['ticket_sum']); ?> &#2547;</li>
                                            <li class="list-group-item">Total comission received for candidate: <?php echo number_format($sumAgent['total']); ?> &#2547;</li>
                                            <li class="list-group-item">Total credit: <?php echo number_format($sum_office['credit_sum']); ?> &#2547;</li>
                                        </ul> 
                                    </div>
                                </div>                                                      
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="<?php echo $delegate['delegateId']."_print";?>">
                <li class="list-group-item bg-light print-header print-header">
                    <div class="row text-center">
                        <div class="col-print-2 center-column">Delegate Name</div>
                        <div class="col-print-4">Total Debit Amount</div>
                        <div class="col-print-4">Remaining Balance</div>
                    </div>
                </li>
                <li class="list-group-item highlight <?php echo $delegate['delegateId']."_highlight";?>" id="<?php echo $delegate['delegateId']."_highlight";?>">
                    <div class="row text-center">
                        <div class="col-print-2 center-column"><?php echo $delegate['delegateName'];?></div>
                        <div class="col-print-4"><?php 
                        echo number_format(round($totalCredit)); ?> Taka</div>
                        <div class="col-print-4"><?php echo number_format(round($totalCredit) - $totalDebit);?> Taka</div>
                        <div class="col-print-2 exclude">
                            <div class="row justify-content-center">
                                <div class="form-group">
                                    <abbr title="Candidate Report"><button data-target="#showAgentReport" data-toggle="modal" class="btn btn-info btn-sm" value="<?php echo $delegate['delegateName']."-maheeer2010@hotmail.com";?>" onclick="showReport(this.value)"><span class="fas fa-eye"></span></button></abbr>
                                </div>
                                <div class="form-group">
                                    <abbr title="Add Candidate Comission"><a href="?page=addExpenseAgentPersonal&ag=<?php echo base64_encode('maheeer2010@hotmail.com');?>&lp=delegateAllOfficeExpense"><button class="btn btn-sm btn-info"><i class="fas fa-user-plus"></i></button></a></abbr>
                                </div>
                                <div class="form-group">
                                    <abbr title="Enter Office Credit Amount"><button class="btn btn-sm" data-toggle="modal" data-target="#addOffice" value="<?php echo $delegate['delegateId'];?>" onclick="modalValue(this.value)"><span class="fa fa-plus"></span></button></abbr>
                                </div>
                                <div class="form-group">
                                    <abbr title="Show List of Offices"><button class="btn btn-sm btn-show" id="btnShow<?php echo $delegate['delegateId'];?>" value="<?php echo $delegate['delegateId'];?>" onclick="showExpense(this.value)"><span class="fa fa-sort-down"></span></button></abbr>
                                    <abbr title="Hide List of Offices"><button class="btn btn-sm btn-hide" id="btnHide<?php echo $delegate['delegateId'];?>" value="<?php echo $delegate['delegateId'];?>" onclick="hideExpense(this.value)" style="display: none;"><span class="fa fa-sort-up"></span></button></abbr>
                                </div> 
                                <div class="form-group">
                                    <abbr title="Print A Receipt"><button type="button" class="btn btn-sm btn-info" value="<?php echo $delegate['delegateId'];?>" onclick="print_div(this.value)"><i class="fa fa-print"></i></button></abbr>
                                </div>
                                <div class="form-group">
                                    <abbr title="Show Detailed Expense Report"><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#expense_details"><i class="fas fa-info-circle"></i></button></abbr>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>                
                <li class="list-group-item details" style="display: none;" id="<?php echo $delegate['delegateId']  ;?>">
                </li>
            </div>
        </ul>
    </div>
    <div id="showAgentReportDivPrint">

    </div>
</div>

<script>
    function print_div_report(agentInfo){
        $.ajax({
            url: 'template/reports/agentReportPrint.php',
            data: {agentInfo: agentInfo},
            type: 'post',
            success: function(response){
                $('#showAgentReportDivPrint').html(response);
                $('#dataTableSeaumPrint').DataTable({
                    "paging": false,
                    "order": [[0, "desc"]],
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                        }
                    ],
                    "searching": false,
                    "bInfo" : false
                });
                $("#showAgentReportDivPrint").print({
                    noPrintSelector: ".exclude",
                    globalStyles: true,
                    doctype: '<!doctype html>',
                    title: agentInfo,   
                });
                $('#showAgentReportDivPrint').html('');
                
            }
        });        
    }
    function showReport(agentInfo){
        $.ajax({
            url: 'template/agentReportMaheer.php',
            data: {agentInfo: agentInfo},
            type: 'post',
            success: function(response){
                $('#showAgentReportDiv').html(response);
                $('#print_button').val(agentInfo);
                console.log(agentInfo);
                $('.returned').parent().addClass('returned_col');
                let table = $('#dataTableSeaum').DataTable({
                    "fixedHeader": true,
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "scrollX": false,
                    "order": [[0, "desc"]],
                    "scrollX": false,
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    "lengthMenu": [
                        [10, 25, 50, 100, 500],
                        [10, 25, 50, 100, 500]
                    ],
                    
                });
                // table.buttons().remove();
            }
        });
    }
    function show_expense_list(id){
        console.log('show');
        $('.expense-list').hide();
        $('.expense_hide').hide();
        $('.expense_show').show();
        $('#'+id+'_expense_show').hide();
        $('#'+id+'_expense_hide').show();
        $('#'+id+'_expense_list').show();
    }
    function hide_expense(id){
        $('#'+id+'_expense_list').hide();
        $('#'+id+'_expense_show').show();
        $('#'+id+'_expense_hide').hide();
    }

    function getDelegateValue(val){
        $('#delegateIdModalDelete').val(val);
    }

    function print_div(id){
        // showExpense(id);
        // show_expense_list(id);
        $('.center-column').removeClass('col-print-2');
        $('.center-column').addClass('col-print-4');
        $('.center-column-2').removeClass('col-print-2');
        $('.center-column-2').addClass('col-print-3');
        $("#" + id + '_print').print({
            noPrintSelector: ".exclude",
            globalStyles: true,
            doctype: '<!doctype html>',    
        })       
        $('.center-column').removeClass('col-print-4');
        $('.center-column').addClass('col-print-2');
        $('.center-column-2').removeClass('col-print-3');
        $('.center-column-2').addClass('col-print-2');
    }
    function finally_print(){
        
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
        (highlight);
    }
    $('#delegateNav').addClass('active');
    function editOfficeExpense(info){
        const info_split = info.split('_');
        $('#account_maheer_id').val(info_split[0]);
        console.log( $('#edit_debit_amount').val(info_split[1]) );
        if(info_split[1] === '0'){
            $('#debit-modal').hide();
            $('#debit-modal-dollar').hide();
        }else{
            if(info_split[5] != 1){
                $('#debit-modal-dollar').show();
            }else{
                $('#debit-modal-dollar').hide();
            }
            $('#debit-modal').show();
        }
        if(info_split[2] === '0'){
            $('#credit-modal').hide();
        }else{
            $('#credit-modal').show();
        }
        $('#edit_debit_amount').val(info_split[1]);
        $('#edit_credit_amount').val(info_split[2]);
        $('#edit_date').val(info_split[3]);
        $('#modal_office_name').val(info_split[4]);
        $('#edit_dollar_rate').val(info_split[5]);
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
        console.log($("input[name='full_report']:checked").val());
        let full_report = (typeof $("input[name='full_report']:checked").val() === 'undefined') ? 'no' : 'yes';
        $('.highlight').css('background-color', 'white'); //resetting prev list
        $('.btn-show').show(); //resetting prev list
        $('.btn-hide').hide(); //resetting prev list
        $('#btnShow'+val).hide();
        $('#btnHide'+val).show();
        $('.details').hide();
        $.ajax({
            type: 'post',
            data: {delegateId : val, full_report: full_report},
            url: 'template/fetchDelegateAllOfficeExpense.php',
            success: function(response){
                $('#'+val).html(response);
                $('#'+val).show();
                $('.'+val+'_highlight').css('background-color', '#b2dfdb');
            }
        });
    }
    function hideExpense(val){
        $('#btnShow'+val).show();
        $('#btnHide'+val).hide();
        $('#'+val).html('');
        $('#'+val).hide();
        $('.'+val+'_highlight').css('background-color', 'white');
    }
</script>