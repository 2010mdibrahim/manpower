<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$qry = "SELECT delegate.delegateName, manpoweroffice.manpowerOfficeName, delegateofficeexpense.* from delegateofficeexpense inner join manpoweroffice using (manpowerOfficeId) inner join delegate using (delegateId) order by updatedOn desc";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>

<div class="container-fluid" style="padding: 2%">
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Delegate Manpower Office Expense Details</h2>
            </div>
        </div>
        <div class="card-body text-center">
        <p>Total:</p>
        <?php $total = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as total from delegateofficeexpense"));?>
        <h4><?php echo number_format($total['total'])?> Taka</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Delegate Name</th>
                        <th>Manpower Office</th>
                        <th>Delegate Receipt</th>
                        <th>Office Receipt</th>
                        <th>Amount</th>                
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    while( $delegateOffice = mysqli_fetch_assoc($result) ){ ?>
                        <tr>
                            <td><?php echo $delegateOffice['delegateName'];?></td>
                            <td><?php echo $delegateOffice['manpowerOfficeName'];?></td>
                            <td><a href="<?php echo $delegateOffice['delegateReceipt'];?>">Delegate Receipt</a></td>
                            <td><a href="<?php echo $delegateOffice['officeReceipt'];?>">Office Receipt</a></td>
                            <td><?php echo $delegateOffice['amount'];?></td>                    
                            <td><?php echo $delegateOffice['date'];?></td> 
                            <td><?php echo $delegateOffice['comment'];?></td> 
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" value="delegateOfficeExpenseListEdit" name="pagePost">
                                            <input type="hidden" value="<?php echo $delegateOffice['expenseId']; ?>" name="expenseId">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/delegateOfficeExpenseQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $delegateOffice['expenseId']; ?>" name="expenseId">
                                            <button type="submit" class="btn btn-danger btn-sm" name="addDelegate">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot hidden>
                    <tr>
                        <th>Delegate Name</th>
                        <th>Manpower Office</th>
                        <th>Delegate Receipt</th>
                        <th>Office Receipt</th>
                        <th>Amount</th>                
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Alter</th>
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
