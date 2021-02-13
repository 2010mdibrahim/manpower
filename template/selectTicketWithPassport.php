<?php
$passport = $_GET['passport'];

$qry = "select flightNo, ticketId, amount, paid from ticket where passportNum = '$passport'";
$result = mysqli_query($conn,$qry);
?>
<script>
    $('document').ready(function() {
        $('#ticketTable').DataTable();
    });
</script>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Select Passport</h2>
    </div>
    <div class="container">
        <h3>Payment Information for Passport: '<?php echo $passport;?>'</h3>
    </div>

    <div class="flex-container" style="padding: 2%">
        <div class="table-responsive">
            <form action="template/adjustAmount.php" method="post">
            <table class="table" id="ticketTable">
                <thead>
                <tr>
                    <th>Flight Number</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance</th>
                    <th>Adjust Amount</th>
                </tr>
                </thead>

                <?php
                $i = 1;
                while($taka = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $taka['flightNo'];?></td>
                        <td><?php echo $taka['amount'];?></td>
                        <td><?php  echo $taka['paid'];?></td>
                        <td><?php echo ($taka['amount'] - $taka['paid']);?></td>
                        <td>
                            <input type="number" name="adjustAmount#<?php echo $i;?>">
                            <input type="hidden" name="ticketId#<?php echo $i;?>" value="<?php echo $taka['ticketId'];?>">
                        </td>
                    </tr>
                <?php $i++; } ?>
                <tfoot hidden>
                <tr>
                    <th>Flight Number</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance</th>
                    <th>Adjust Amount</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <input type="submit" value="Save">
    <input type="hidden" value="<?php echo $passport; ?>" name="passport">
    </form>
</div>