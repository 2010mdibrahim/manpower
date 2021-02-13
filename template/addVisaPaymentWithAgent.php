<?php
$agent = $_GET['agentId'];
$qry = "select visaId, name, visaIssuAgent from visainfo where visaIssuAgent = $agent";
$result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add payment information of VISA</h2>
    </div>

    <div class="container">
        <h3>Payment Information:</h3>
    </div>

    <div class="flex-container" style="padding: 2%">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Visa Name: </th>
                    <th>Total Amount: </th>
                    <th>Paid Amount: </th>
                    <th>Enter Add Amount</th>
                    <th>Enter Paid Amount</th>
                </tr>
                <form action="template/adjustAmountVisa.php" method="post">
                    <?php
                    $i = 1;
                    while($visa = mysqli_fetch_assoc($result)){
                        $visaId = $visa['visaId'];
                        $qry = "select amount,paidAmount, count(amount) as visaPayCount from visapayment where visaId = $visaId";
                        $resultAmount = mysqli_query($conn,$qry);
                        $payAmount = mysqli_fetch_assoc($resultAmount);
                    ?>
                        <tr>
                            <input type="hidden" name="visaId#<?php echo $i;?>" value="<?php echo $visa['visaId'];?>">
                            <td><?php echo $visa['name'];?></td>
                            <td><?php echo ($payAmount['visaPayCount'] == 0) ? 'No Payment Added' : $payAmount['amount'];?></td>
                            <td><?php echo ($payAmount['visaPayCount'] == 0) ? 0 :$payAmount['paidAmount'];?></td>
                            <td>
                                <input type="number" name="amount#<?php echo $i;?>" value="">
                            </td>
                            <td>
                                <input type="number" name="paidAmount#<?php echo $i;?>" value="">
                            </td>
                        </tr>
                        <?php $i++; } ?>
            </table>
        </div>
    </div>
    <input type="submit" value="Save">
    <input type="hidden" value="<?php echo $agent; ?>" name="agent">
    </form>
</div>