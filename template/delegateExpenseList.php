<?php 
$delegateId = base64_decode($_GET['dl']);
$delegateName = mysqli_fetch_assoc($conn->query("SELECT delegateName from delegate where delegateId = $delegateId"));
$result_expense = $conn->query("SELECT delegateexpense.* from delegateexpense where delegateexpense.delegateId = $delegateId order by delegateexpense.delegateExpenseId desc");
?>
<div class="container">
    <div class="section-header">
        <h2>Candidate Comission</h2>
    </div>
    <div class="container" style="margin-bottom: 2%;">
        <form action="index.php" method="get">
            <div class="form-row align-items-end">
                <input type="hidden" value="dlel" name="page">
                <div class="col-md-6">
                    <label for="sel1">Select Agent:</label>
                    <select class="form-control select2" id="dl" name="dl">
                        <?php 
                        $result = $conn->query("SELECT delegateName, delegateId from delegate");
                        while($delegate = mysqli_fetch_assoc($result)){ ?>
                        <?php if($delegate['delegateId'] == $delegateId){ ?>
                            <option value="<?php echo base64_encode($delegate['delegateId']); ?>" selected><?php echo $delegate['delegateName']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo base64_encode($delegate['delegateId']); ?>"><?php echo $delegate['delegateName']; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <input class="form-control btn-sm" type="submit" value="Search" id="agentShow">
                </div>
            </div>
        </form>
    </div>    
    <!-- <div class="container loader"></div>   -->
    <div class="card">
        <div class="card-header"><p class="text-center" style="font-size: 18px;">Candidate Comission Information of: <span style="font-size: 25px;"><?php echo $delegateName['delegateName'];?></span></p></div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Number of Candidate</th>
                        <th>Amount</th> 
                        <th>Pay Date</th>
                        <th>Comment</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <?php while($delegateExpense = mysqli_fetch_assoc($result_expense)){?>
                    <tr>
                        <td><?php echo $delegateExpense['candidateNumber'];?></td>
                        <td><?php echo number_format($delegateExpense['amount']);?></td>
                        <td><?php echo $delegateExpense['payDate'];?></td>
                        <td><?php echo $delegateExpense['comment'];?></td>
                        <!-- Edit Section -->
                        <td>
                            <div class="flex-container">
                                <!-- <div style="padding-right: 2%">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="alter" value="update">
                                        <input type="hidden" value="editCandidate" name="pagePost">
                                        <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                        <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                    </form>
                                </div> -->
                                <div style="padding-left: 2%">
                                    <form action="template/addDelegateExpenseQry.php" method="post">
                                        <input type="hidden" name="alter" value="delete">
                                        <input type="hidden" value="<?php echo $delegateId; ?>" name="delegateId">
                                        <input type="hidden" value="<?php echo $delegateExpense['delegateExpenseId']; ?>" name="delegateExpenseId">
                                        <button type="submit" class="btn btn-danger btn-sm" name="jobs">Delete</></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>  
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Number of Candidate</th>
                        <th>Amount</th> 
                        <th>Pay Date</th>
                        <th>Comment</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>        
    </div>
	<script>
	$('#delegateNav').addClass('active');
	</script>