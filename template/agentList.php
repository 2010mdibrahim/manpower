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
                <h2>All Agent Information</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="display table table-sm table-bordered table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Agent Email</th>
                        <th>Agent Name</th>
                        <th>Agent Phone</th>
                        <th>Document</th>
                        <th>Expense</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    $qry = "SELECT agentPassport, agentPoliceClearance, agentEmail, agentName, agentPhone, agentPhoto, comment FROM agent order by creationDate desc";
                    $result = mysqli_query($conn,$qry);
                    while($agent = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td>
                                <a target="_blank" href="<?php echo $agent['agentPhoto'];?>">
                                    <img class="agent thumbnail" src="<?php echo $agent['agentPhoto'];?>" alt="Forest">
                                </a>
                            </td>
                            <td><?php echo $agent['agentEmail'];?></td>
                            <td><?php echo $agent['agentName'];?></td>
                            <td><?php echo $agent['agentPhone'];?></td>
                            <td>
                            <a href="<?php echo $agent['agentPassport'];?>" target="_blank"><button class="btn btn-warning">Passport</button></a>
                            <a href="<?php echo $agent['agentPoliceClearance'];?>" target="_blank" ><button class="btn btn-info">Clearance</button></a>
                            </td>
                            <td>
                                <a href="?page=addExpenseAgent&ag=<?php echo base64_encode($agent['agentEmail']);?>"><button class="btn btn-sm btn-info"><span class="fas fa-plus"></span></button></a>
                                <a href="?page=showAgentExpenseList&ag=<?php echo base64_encode($agent['agentEmail']);?>" target="_blank"><button class="btn btn-sm btn-info"><span class="fas fa-dollar"></span></button></a>

                            </td>
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editAgent" name="pagePost">
                                            <input type="hidden" value="<?php echo $agent['agentEmail']; ?>" name="agentEmail">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/addNewAgentQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editAgent" name="pagePost">
                                            <input type="hidden" value="<?php echo $agent['agentEmail']; ?>" name="agentEmail">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot hidden>
                    <tr>
                        <th>Photo</th>
                        <th>Agent Email</th>
                        <th>Agent Name</th>
                        <th>Agent Phone</th>
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
    $('#agentNav').addClass('active');
</script>
