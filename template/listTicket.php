<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container col-12" style="padding: 2%">
    <div class="section-header">
        <h3>All Ticket Information</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table">
            <thead>
            <tr>
                <th>Passport No</th>
                <th>Airplane</th>
                <th>Flight No</th>
                <th>Flight Date</th>
                <th>Flight Time</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Departure</th>
                <th>Terminal</th>
                <th>Agent Name</th>
                <th>Alter</th>
            </tr>
            </thead>
            <?php
            $agent = $_SESSION['email'];
            $qry = "select * from ticket";
            $result = mysqli_query($conn,$qry);
            while($candidate = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $candidate['passportNum'];?></td>
                    <td><?php  echo $candidate['airplane'];?></td>
                    <td><?php  echo $candidate['flightNo'];?></td>
                    <td><?php  echo $candidate['flightDate'];?></td>
                    <td><?php  echo $candidate['flightTime'];?></td>
                    <td><?php  echo $candidate['fromPlace'];?></td>
                    <td><?php  echo $candidate['toPlace'];?></td>
                    <td><?php  echo number_format($candidate['amount']);?></td>
                    <td><?php  echo $candidate['departure'];?></td>
                    <td><?php  echo $candidate['terminal'];?></td>
                    <td><?php echo $candidate['agent'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editTicket" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['ticketId']; ?>" name="ticketId">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div>
                            <div style="padding-left: 2%">
                                <form action="template/editTicketQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editTicket" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['ticketId']; ?>" name="ticketId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tfoot hidden>
            <tr>
                <th>Passport No</th>
                <th>Airplane</th>
                <th>Flight No</th>
                <th>Flight Date</th>
                <th>Flight Time</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Departure</th>
                <th>Terminal</th>
                <th>Agent Name</th>
                <th>Alter</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

