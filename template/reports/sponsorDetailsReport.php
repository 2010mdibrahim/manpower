<?php
$sponsorId = $_POST['sponsorId'];
$visaId = $_POST['visaId'];
$qry = "select visainfo.*, agent.agentName from visaInfo
            inner join agent on agent.agentId = visainfo.visaIssuAgent
                where visaSponsorId = $sponsorId";
$result = mysqli_query($conn,$qry);
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<script>
    $(document).ready(function() {
        $('#expenseTable').DataTable();
    } );
</script>

<div class="container-fluid" style="padding: 2%">
    <div class="table-responsive">
        <table class="dataTableSeaum" id="expenseTable" style="width:100%">
            <thead>
            <tr>
                <th>Visa Name</th>
                <th>Issue Date</th>
                <th>Visa Type</th>
                <th>Position</th>
                <th>Basic Salary</th>
                <th>Total Salary</th>
                <th>Visa Issue Agent</th>
                <th>Visa Fee Status</th>
                <th>Passport No.</th>
            </tr>
            </thead>
            <?php
            while( $visa = mysqli_fetch_assoc($result) ){ ?>
                <tr>
                    <td><?php echo $visa['name'];?></td>
                    <td><?php echo $visa['date'];?></td>
                    <td><?php echo $visa['type'];?></td>
                    <td><?php echo $visa['position'];?></td>
                    <td><?php echo number_format($visa['bSalary']);?></td>
                    <td><?php echo number_format($visa['tSalary']);?></td>
                    <td><?php echo $visa['agentName'];?></td>
                    <td><?php echo (is_null($visa['visaFeeStage']) ? $visa['visaFeeStage'] : 'Not Paid');?></td>
                    <td><?php echo (!empty($visa['passNo']))? $visa['passNo'] : 'Not Transferred';?></td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Visa Name</th>
                <th>Issue Date</th>
                <th>Visa Type</th>
                <th>Position</th>
                <th>Basic Salary</th>
                <th>Total Salary</th>
                <th>Visa Issue Agent</th>
                <th>Visa Fee Status</th>
                <th>Passport No.</th>
            </tr>
            </tfoot>

        </table>
    </div>
</div>

