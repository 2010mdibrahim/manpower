<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h3>All Agent Information</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12" style="width:100%">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Agent Email</th>
                <th>Agent Name</th>
                <th>Agent Phone</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <?php
            $qry = "SELECT agentEmail, agentName, agentPhone, agentPhoto, comment FROM agent";
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
                                    <input type="hidden" value="<?php echo $agent['agentId']; ?>" name="agentId">
                                    <input type="hidden" value="<?php echo $agent['agentType']; ?>" name="agentType">
                                    <input type="hidden" value="<?php echo $agent['agentTypeId']; ?>" name="agentTypeId">
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
                <th>Remarks</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>


<script>
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>
