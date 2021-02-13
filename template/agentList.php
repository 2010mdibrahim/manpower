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
                <th>Agent Name</th>
                <th>Agent Type</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            $qry = "select agent.agentId, agent.agentName, agent.phone, agent.email, agenttype.agentType, agenttype.agentTypeId from agent 
                        inner join agenttype on agent.agentType = agenttype.agentTypeId";
            $result = mysqli_query($conn,$qry);
            while($agent = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $agent['agentName'];?></td>
                    <td><?php echo $agent['agentType'];?></td>
                    <td><?php echo $agent['phone'];?></td>
                    <td><?php echo $agent['email'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editAgent" name="pagePost">
                                    <input type="hidden" value="<?php echo $agent['agentId']; ?>" name="agentId">
                                    <input type="hidden" value="<?php echo $agent['agentType']; ?>" name="agentType">
                                    <input type="hidden" value="<?php echo $agent['agentTypeId']; ?>" name="agentTypeId">
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
                <th>Agent Name</th>
                <th>Agent Type</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Alter</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

