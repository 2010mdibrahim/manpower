<?php
$result = $conn->query("SELECT agentName, agentEmail from agent");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    
        <h3 style="background-color: aliceblue; padding: 0.5%">Agent List</h3>
        <div class="form-group">
            <div class="row">
                <div class="column col-md-6" >
                    <label>Select Agent Name</label>
                    <select class="form-control" name="agentEmail">
                        <option>--- Select Agent ---</option>
                        <?php while($agent = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <br>        
        <button class="form-control" type="button" value="Show" name="agent" style="margin: auto; width: auto;">
</div>

<script>
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>


