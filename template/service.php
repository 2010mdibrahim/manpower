<?php
$qry = "select SUM(amount) as sumTotal from ticket";
$result = mysqli_query($conn,$qry);
$ticketInfo = mysqli_fetch_assoc($result);
$totalTicketAmount = $ticketInfo['sumTotal'];
$qry = "select SUM(paid) as paidTotal from ticket";
$result = mysqli_query($conn,$qry);
$ticketInfo = mysqli_fetch_assoc($result);
$totalPaidTicketAmount = $ticketInfo['paidTotal'];
$totalDueTicketAmount = $totalTicketAmount - $totalPaidTicketAmount;
$qry = "select SUM(amount) as expenseTotal from expense";
$result = mysqli_query($conn,$qry);
$expenseInfo = mysqli_fetch_assoc($result);
$totalExpenseAmount = $expenseInfo['expenseTotal'];
?>
<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header">
            <h2>Total Expenses Overview</h2>
        </div>
        <div style="text-align: center">
            <h2>Ticket Information</h2>
        </div>
        <div class="row" style="padding: 2%">
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <h3>Total Amount</h3>
                    <p>
                        <?php echo number_format($totalTicketAmount)." /- Taka";?>
                    </p>
                    <a class="btn" href="?page=listTicket">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">

                    <h3>Total Received</h3>
                    <p>
                        <?php echo number_format($totalPaidTicketAmount)." /- Taka";?>
                    </p>
                    <a class="btn" href="?page=listTicket">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <h3>Ticket Due</h3>
                    <p>
                        <?php echo number_format($totalDueTicketAmount)." /- Taka";?>
                    </p>
                    <a class="btn" href="?page=listTicket">Learn More</a>
                </div>
            </div>
        </div>
        <div style="text-align: center">
            <h2>Expenses Information</h2>
        </div>
        <div class="row" style="padding: 2%">
            <div class="col-lg-4 col-md-6" style="display: block; margin-left: auto; margin-right: auto;">
                <div class="service-item">

                    <h3>Total Expenses</h3>
                    <p>
                        <?php
                        echo number_format($totalExpenseAmount)." /- Taka";
                        ?>
                    </p>
                    <a class="btn" href="?page=expenseDetails">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->