<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("<div class='row text-center'><div class='col-sm no-access'>No Access</div></div>");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$totalDeposit = 0;
$totalWithdraw = 0;
?>
<style>
.container{
    margin-bottom: 2%;
}
</style>
<div class="container-fluid" style="padding: 2%" style="width: 100%;">
    <!-- Passport Photo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editJob">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/jobsEditQry.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Job Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row" id="modalTest">
                            <input type="hidden" name="jobId" id="modalJobId">       
                            <div class="form-group col-sm">
                                <label style="margin-right: 5px;">Job Type: </label>
                                <input class="form-control" type="text" name="jobType" id="modalJobType">       
                            </div>
                            <div class="form-group col-sm">
                                <label style="margin-right: 5px;">Job Credit Type: </label>
                                <select class="form-control" name="creditType" id="modalCreditType">
                                    <option value="">Select Credit Type</option>
                                    <option>Paid</option>
                                    <option>Comission</option>
                                </select>
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
    <?php 
    $delegateId = base64_decode($_GET['dI']);
    $delegateName = mysqli_fetch_assoc($conn->query("SELECT delegateName from delegate where delegateId = $delegateId"));
    $result = $conn->query("SELECT * from delegateaccount where delegateId = $delegateId order by delegateaccount.creationDate desc"); 
    ?>    
    <div class="section-header">
        <h3>Account</h3>
        <h2><?php echo $delegateName['delegateName'];?></h2>
    </div>    
    
    <div class="container-fluid" style="margin-bottom: 2%; padding: 5px; background-color: #fafafa ; border-radius: 15px;">
        <div class="card">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                            <h6>Total Balance</h6>
                            <h4 id="totalBalance"></h4>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                            <h6>Total Deposit</h6>
                            <h4 id="totalDeposit"></h4>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                            <h6>Total Withdraw</h6>
                            <h4 id="totalWithdraw"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                        <thead>
                        <tr>
                            <th>Particulars</th>
                            <th>Deposit Amount</th>
                            <th>Withdraw Amount</th>
                            <th>Transaction Date</th> 
                            <th>Purpose</th> 
                            <th>Transaction Slip</th> 
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <?php while($delegateAccount = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $delegateAccount['particular'];?></td>
                            <td><?php
                            if($delegateAccount['typeOfTransaction'] == 'Deposit'){
                                echo $delegateAccount['amount'];
                                $totalDeposit += (int)$delegateAccount['amount'];
                            }else{
                                echo " - ";
                            }
                            ?></td>
                            <td><?php
                            if($delegateAccount['typeOfTransaction'] == 'Withdraw'){
                                echo $delegateAccount['amount'];
                                $totalWithdraw += (int)$delegateAccount['amount'];
                            }else{
                                echo " - ";
                            }
                            ?></td>
                            <td><?php echo $delegateAccount['dateOfTransaction'];?></td>
                            <td><?php echo $delegateAccount['purpose'];?></td>
                            <td><?php
                            if($delegateAccount['transactionSlip'] == ''){
                                echo " - ";
                            }else{ ?>
                            <a href="<?php echo $delegateAccount['transactionSlip'];?>">Slip</a>
                            <?php } ?></td>
                            <!-- Edit Section -->
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <form action="template/addToDelegateAccount.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" name="delegateId" value="<?php echo $delegateId;?>">
                                            <input type="hidden" value="<?php echo $delegateAccount['delegateAccountId']; ?>" name="delegateAccountId">
                                            <button type="submit" class="btn btn-danger btn-sm" name="jobs"><span class="fa fa-close"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>  
                        <?php } ?>
                        <tfoot>
                        <tr hidden>
                            <th>Particulars</th>
                            <th>Deposit Amount</th>
                            <th>Withdraw Amount</th>
                            <th>Transaction Date</th> 
                            <th>Purpose</th> 
                            <th>Transaction Slip</th> 
                            <th>Edit</th>
                        </tr>
                        </tfoot>
                        <input type="hidden" id="totalDepositInput" value="<?php echo number_format($totalDeposit)?>">
                        <input type="hidden" id="totalWithdrawInput" value="<?php echo number_format($totalWithdraw)?>">
                        <input type="hidden" id="totalBalanceInput" value="<?php echo number_format($totalDeposit - $totalWithdraw)?>">
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-bottom: 2%; padding: 10px; background-color: #fafafa ; border-radius: 15px;">
        <div class="card">
            <div class="card-body">
                <form action="template/addToDelegateAccount.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="delegateId" value="<?php echo $delegateId;?>">
                    <div class="row align-items-end">
                        <div class="col-md-2">
                            <label for="">Purpose</label>
                            <input class="form-control" type="text" name="purpose" placeholder="Purpose" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Amount</label>
                            <input class="form-control" type="number" name="amount" placeholder="Enter Amount" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Date</label>
                            <input class="form-control datepicker" type="text" name="date" autocomplete="off" placeholder="Enter Date" required>
                        </div>
                        <div class="col-md-2" id>
                            <label>Transaction Type</label>
                            <select class="form-control select2" id="transactionType" name="transactionType" onchange="getFile(this.value)" required>
                                <option value="">Select Transaction Type</option>
                                <option>Deposit</option>
                                <option>Withdraw</option>                        
                            </select>
                        </div> 
                        <div class="col-md-2">
                            <label>Particular Type</label>
                            <select class="form-control select2" id="particularType" name="particularType" onchange="fetchParticularType(this.value)" required>
                                <option value="">Select Particular Type</option>
                                <option value="other">Other</option>
                                <option value="manpower">Manpower Office</option>
                            </select>
                        </div>
                        <div class="col-md-2" id="particularTypeDiv">
                        </div> 
                        <div class="col-md-2" id="WithdrawFile" style="display: none;">
                            <label>Withdraw Slip</label>
                            <input class="form-control-file" type="file" name="withdrawFile">
                        </div>
                        <div class="col-md-2" style="margin-top: 5px;">
                            <button class="form-control btn-primary w-25">Add</button>
                        </div>          
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>



<script>
    $('#jobsNav').addClass('active');
    function fetchParticularType(particular){
        $.ajax({
            type: 'post',
            url: 'template/fetchDelegateAccountInfo.php',
            data: {particular : particular},
            success: function (response){
                $('#particularTypeDiv').html(response);
                $('#particular').select2({
                    width: '100%'
                });
            }
        })
    }
    function getFile(file){
        if(file == 'Deposit'){
            $('#WithdrawFile').hide();
        }else{
            $('#WithdrawFile').show();
        }
    }
    $('#totalDeposit').html($('#totalDepositInput').val());
    $('#totalWithdraw').html($('#totalWithdrawInput').val());
    $('#totalBalance').html($('#totalBalanceInput').val());


</script>