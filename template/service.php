<?php
$ticketAmount = mysqli_fetch_assoc($conn->query("SELECT sum(ticketPrice) as price from ticket"));
$agentAmount = mysqli_fetch_assoc($conn->query("SELECT sum(fullAmount) as price from agentexpense"));
$officeAmount = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as price from expense"));
?>

<style>
    .card{
        padding: 5%;
        align-items: center;
    }
</style>
<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header">
            <h2>Total Expenses Overview</h2>
        </div>
        <div style="text-align: center">
            <h2>Expense Information</h2>
        </div>
        <div class="row" style="padding: 2%">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <h3>Total Ticket Expense</h3>
                    <p>
                        <?php echo number_format($ticketAmount['price'])." /- Taka";?>
                    </p>
                    <a class="btn" href="?page=listTicket">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">

                    <h3>Total Agent Expense</h3>
                    <p>
                        <?php echo number_format($agentAmount['price'])." /- Taka";?>
                    </p>
                    <a class="btn" href="?page=listTicket">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <h3>Ticket Office Expesne</h3>
                    <p>
                        <?php echo number_format($officeAmount['price'])." /- Taka";?>
                    </p>
                    <a class="btn" href="?page=listTicket">Learn More</a>
                </div>
            </div>
        </div>
        <div style="text-align: center">
            <h2>Expenses Information</h2>
        </div>
        <!-- <div class="row" style="padding: 2%">
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
        </div> -->
    </div>
</div>
<!-- Service End -->

<script>
    $('#home_nav').addClass('active');
</script>