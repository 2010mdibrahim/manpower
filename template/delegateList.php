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
        <!-- Passport Photo Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="changeDelegateOffice">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="template/delegateOfficeEdit.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Office Name</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="delegateOfficeId" id="delegateOfficeIdModal">
                            <input type="text" name="officeName" id="officeNameModal">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-header">
            <div class="section-header">
                <h2>Delegate List</h2>
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
                        <th>Expense</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    while( $delegate = mysqli_fetch_assoc($result) ){ ?>
                        <tr>
                            <td><?php echo $delegate['delegateName'];?></td>
                            <td><?php echo $delegate['country'];?></td>
                            <td><?php echo $delegate['delegateState'];?></td>
                            <td><?php 
                            $result_office = $conn->query("SELECT delegateOfficeId, officeName from delegateOffice where delegateId = ".$delegate['delegateId']);
                            while($office = mysqli_fetch_assoc($result_office)){ ?>
                                <button class="btn btn-sm" data-toggle="modal" data-target="#changeDelegateOffice" value="<?php echo $office['officeName']."_".$office['delegateOfficeId']; ?>" onclick="delegateOffice(this.value)"><?php echo $office['officeName']; ?></button>
                            <?php } ?></td>
                            <td><?php echo $delegate['comment'];?></td>                    
                            <td class="text-center">
                                <a href="?page=addDelegateExpense&dl=<?php echo base64_encode($delegate['delegateId'])?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-plus"></span></button></a>
                                <a href="?page=dlel&dl=<?php echo base64_encode($delegate['delegateId'])?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                            </td>
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
                        <th>Expense</th>
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
    function delegateOffice(info){
        var info_split = info.split('_');
        $('#officeNameModal').val(info_split[0]);
        $('#delegateOfficeIdModal').val(info_split[1]);
    }
</script>
