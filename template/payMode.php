<div class="container">
    <div class="section-header">
        <h2>Add payment methods</h2>
    </div> 
    <div class="container" style="margin-bottom: 10px;">
        <form action="template/payModeQry.php" method="post">
            <div class="row align-items-end">
                <div class="form-group col-md-6">
                    <label for="paymode">Add Payment Method</label>
                    <input class="form-control" autocomplete="off" type="text" name="paymode" id="" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" name="submit" id="" value="Add">
                </div>
            </div>
        </form>
    </div>    
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
            <thead>
            <tr>
                <th>Pay Mode</th>
                <th>Creation Date</th> 
                <th>Edit</th>
            </tr>
            </thead>
            <?php 
            $result = $conn->query("SELECT * FROM paymentmethod");
            while($paymode = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $paymode['paymentMode'];?></td>
                <td><?php echo $paymode['creationDate'];?></td>
                <!-- Edit Section -->
                <td>
                    <div class="flex-container">
                        <div style="padding-left: 2%">
                            <form action="template/payModeQry.php" method="post">
                                <input type="hidden" name="alter" value="delete">
                                <input type="hidden" value="<?php echo $paymode['paymentMode']; ?>" name="paymode">
                                <button type="submit" class="btn btn-danger btn-sm" name="jobs">Delete</></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>  
            <?php } ?>
            <tfoot>
            <tr hidden>
                <th>Job Name</th>
                <th>Creation Date</th> 
                <th>Edit</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>