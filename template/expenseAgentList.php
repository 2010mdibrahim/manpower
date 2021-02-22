<?php
$result = $conn->query("SELECT agentName, agentEmail from agent");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Expense for Agent</h2>
    </div>
    
    <form action="index.php" method="post">
        <input type="hidden" name="pagePost" value="showAgentExpenseList">
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
        <input class="form-control" type="submit" value="Show" name="agent" style="margin: auto; width: auto;">
    </form>
</div>

<script>
    window.onload = function() {
        $('#agentNav').addClass('active');
    };
</script>


