<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Ticket", $_SESSION['sections'])){
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
</style>
<div class="container col-12" style="padding: 2%">
    <!-- Passport Photo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editOutsider">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/outsideCandidateListQry.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Passanger Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="form-row" id="modalTest">
                        <input type="hidden" name="outsidePassportId" id="outsidePassportId">       
                        <div class="form-group col-sm">
                            <label style="margin-right: 5px;">Passenger Name: </label>
                            <input class="form-control" type="text" name="name" id="modalName" placeholder="Enter Name">       
                        </div>
                        <div class="form-group col-sm">
                            <label style="margin-right: 5px;">Mobile Number: </label>
                            <input class="form-control" type="text" name="mobNum" id="modalMobNum" placeholder="Enter Mobile Number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="margin-right: 5px;">Passport Number: </label>
                            <input class="form-control" type="text" name="passportNum" id="modalPassportNum" placeholder="Enter Passport Number">
                        </div>
                        <div class="form-group col-md-6">
                            <label style="margin-right: 5px;">Issue Date: </label>
                            <input class="form-control datepicker" type="text" autocomplete="off" name="issueDate" id="modalIssueDate" placeholder="Enter Issue Date">
                        </div>
                        <div class="form-group col-sm">
                            <label style="margin-right: 5px;">Passport Copy: </label>
                            <input class="form-control-file" type="file" autocomplete="off" name="outsidePassportCopy" required>
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

    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Outside Candidate Information</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Candidate Referrer</th>
                        <th>Mobile Number</th>
                        <th>Passport Number</th>
                        <th>Passport Issue Date</th>
                        <th>Passport Copy</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    if(isset($_GET['ti'])){
                        $outsidePassportId = $_GET['ti'];
                        $result = $conn->query("SELECT localreferrer.localReferrerName, localreferrer.localReferrerMob, agent.agentName, outsidepassport.* from outsidepassport LEFT JOIN localreferrer using (localReferrerId) LEFT JOIN agent using (agentEmail) where outsidePassportId = $outsidePassportId");
                    }else{
                        $result = $conn->query("SELECT localreferrer.localReferrerName, localreferrer.localReferrerMob, agent.agentName, outsidepassport.* from outsidepassport LEFT JOIN localreferrer using (localReferrerId) LEFT JOIN agent using (agentEmail) order by outsidePassportId desc");
                    }
                    while($outsider = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $outsider['name'];?></td>
                            <td><?php 
                            if($outsider['referrerMedia'] == 'local'){ ?>
                                <p><?php echo $outsider['localReferrerName'];?></p>
                                <p><?php echo $outsider['localReferrerMob'];?></p>
                            <?php }else if($outsider['referrerMedia'] == 'existing'){ ?>
                                <a href="?page=agentList&agE=<?php echo base64_encode($outsider['agentEmail']);?>"><?php echo $outsider['agentName'];?></a>
                            <?php }else{ ?>
                                <p><?php echo $outsider['referrerMedia'];?></p>
                            <?php }?></td>
                            <td><?php echo $outsider['mobNum'];?></td>
                            <td><?php echo $outsider['passportNum'];?></td>
                            <td><?php echo $outsider['issuDate'];?></td>
                            <td><a href="<?php echo $outsider['outsidePassportCopy'];?>" target="_blank"><button class="btn btn-info">Passport</button></a></td>
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">                                        
                                        <button type="submit" data-toggle="modal" data-target="#editOutsider" class="btn btn-primary btn-sm" value="<?php echo $outsider['outsidePassportId'];?>" onclick="fetchOutsiderValue(this.value)">Edit</></button>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/outsideCandidateListQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $outsider['outsidePassportId']; ?>" name="outsidePassportId">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot hidden>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Candidate Referrer</th>
                        <th>Mobile Number</th>
                        <th>Passport Number</th>
                        <th>Passport Issue Date</th>
                        <th>Passport Copy</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('#ticketNav').addClass('active');
    function fetchOutsiderValue(outsidePassportId){
        $.ajax({
            type: 'post',
            url: 'template/fetchOutsiderValue.php',
            data: {outsidePassportId: outsidePassportId},
            dataType: 'json',
            success: function (outsider){
                $('#outsidePassportId').val(outsidePassportId);
                $('#modalName').val(outsider.name);
                $('#modalMobNum').val(outsider.mobNum);
                $('#modalPassportNum').val(outsider.passportNum);
                $('#modalIssueDate').val(outsider.issuDate);
            }
        });
    }
</script>

