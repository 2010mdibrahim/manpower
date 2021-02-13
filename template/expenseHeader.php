<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container col-12" style="padding: 2%">
    <div class="section-header">
        <h2>All Ticket Information</h2>
    </div>
    <div class="flex-container" style="padding-bottom: 2%; float: right">
            <button type="button" class="btn btn-primary btn-sm"><a href="index.php?page=newExpenseHeader">Add</a></></button>
    </div>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Expense Header</th>
                <th>Alter</th>
            </tr>
            <?php
            $agent = $_SESSION['email'];
            $qry = "select * from expenseHeader";
            $result = mysqli_query($conn,$qry);
            while($expenseHeader = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $expenseHeader['expenseName'];?></td>
                    <td>
                        <div class="flex-container">
                            <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editExpenseHeader" name="pagePost">
                                    <input type="hidden" value="<?php echo $expenseHeader['expenseheadId']; ?>" name="expenseheadId">
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
        </table>
    </div>
</div>

