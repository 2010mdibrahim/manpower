<?php
$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];
$qry = "select mofaCode, mofaStage, passNo, mofaRemark from mofa where updatedOn between '$dateFrom' and '$dateTo'";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $('document').ready(function() {
        $('#employeeList').DataTable();
    });
</script>
<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table id="employeeList" class="table col-12"  style="width:100%">
            <thead>
            <tr>
                <th>MOFA Code</th>
                <th>MOFA Stage</th>
                <th>Passport Number</th>
                <th>Mofa Remark</th>
            </tr>
            </thead>
            <?php
            $zeroDate = "0000-00-00";
            while( $mofa = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $mofa['mofaCode'];?></td>
                    <td><?php echo $mofa['mofaStage'];?></td>
                    <td><?php echo $mofa['passNo'];?></td>
                    <td><?php echo $mofa['mofaRemark'];?></td>
                </tr>
            <?php } ?>
            <tfoot>
            <tr>
                <th>MOFA Code</th>
                <th>MOFA Stage</th>
                <th>Passport Number</th>
                <th>Mofa Remark</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


