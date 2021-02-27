<?php
$qry = "SELECT * from delegate order by creationDate desc";
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
                <h2>Expense Details</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Delegate Name</th>
                        <th>Country</th>
                        <th>State</th>                
                        <th>Office</th>
                        <th>Comment</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    while( $delegate = mysqli_fetch_assoc($result) ){ ?>
                        <tr>
                            <td><?php echo $delegate['delegateName'];?></td>
                            <td><?php echo $delegate['country'];?></td>
                            <td><?php echo $delegate['delegateState'];?></td>
                            <td><?php echo $delegate['office'];?></td>
                            <td><?php echo $delegate['comment'];?></td>                    
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" value="editDelegate" name="pagePost">
                                            <input type="hidden" value="<?php echo $delegate['delegateId']; ?>" name="delegateId">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/addNewDelegateQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $delegate['delegateId']; ?>" name="delegateId">
                                            <button type="submit" class="btn btn-danger btn-sm" name="addDelegate">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot hidden>
                    <tr>
                        <th>Expense Header</th>
                        <th>Amount</th>
                        <th>Issue Date</th>
                        <th>Paymode</th>
                        <th>Remark</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>

                </table>
            </div>

        </div>
    </div>   
</div>


<script>
    window.onload = function() {
        $('#delegateNav').addClass('active');
    };
</script>
