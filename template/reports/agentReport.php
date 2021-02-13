<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>

<?php
$by = $_POST['by'];
if($by == 'ticket'){
    $agentId = $_POST['agentId'];
    $qry = "select agent.agentId, agent.agentName, agent.email, ticket.ticketid, ticket.passportNum, ticket.amount, ticket.paid from agent 
                        inner join ticket on agent.agentId = ticket.agent where agent.agentId = $agentId";
}else if($by == 'date'){
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $qry = "SELECT expense.amount,expense.paymode,expense.date,expense.remark,expenseheader.expenseName,expense.expenseId,expenseheader.expenseheadId FROM expense 
            INNER JOIN expenseheader ON expense.expenseheadId=expenseheader.expenseheadId where expense.date between '$dateFrom' and '$dateTo'";
}else{
    $expenseHeadId = $_POST['expenseHead'];
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $qry = "SELECT expense.amount,expense.paymode,expense.date,expense.remark,expenseheader.expenseName,expense.expenseId,expenseheader.expenseheadId FROM expense 
            INNER JOIN expenseheader ON expense.expenseheadId=expenseheader.expenseheadId where expenseheader.expenseheadId = $expenseHeadId and expense.date between '$dateFrom' and '$dateTo'";
}
$result = mysqli_query($conn,$qry);
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>All Agent Information</h2>
    </div>
    <div class="table-responsive">
        <table class="table col-12" id="dataTableSeaum" style="width:100%">
            <thead>
            <tr>
                <th>Agent Name</th>
                <th>Agent Email</th>
                <th>Passport No.</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
            </tr>
            </thead>
            <?php
                while($agent = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><?php echo $agent['agentName'];?></td>
                    <td><?php echo $agent['email'];?></td>
                    <td><?php echo $agent['passportNum'];?></td>
                    <td><?php echo $agent['amount'];?></td>
                    <td><?php echo $agent['paid'];?></td>
                </tr>
            <?php } ?>
            <thead hidden>
            <tr>
                <th>Agent Name</th>
                <th>Agent Email</th>
                <th>Passport No.</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
            </tr>
            </thead>

        </table>
    </div>
</div>

