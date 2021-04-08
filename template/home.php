<?php
include ('homeController.php');
$homeController = new HomeController();
$monthlyCandidateExpense = $homeController->candidateMonthlyExpense();
$dailyCandidateExpense = $homeController->candidateDailyExpense();
$ticketAmount = mysqli_fetch_assoc($conn->query("SELECT sum(ticketPrice) as price from ticket"));
$agentAmount = mysqli_fetch_assoc($conn->query("SELECT sum(fullAmount) as price from agentexpense"));
$officeAmount = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as price from expense"));
?>

<style>
    .card-header{
        height: 80%;
        background-color: rgba(92, 107, 192, 1);
        color: white;
    }
    .inside{
        background-color: rgba(92, 107, 192, 0.8);
        color: black;
    }
</style>
<!-- Service Start -->
<div class="service">
    <div class="container-fluid">
        <div class="section-header">
            <h2>Total Expenses Overview</h2>
        </div>
        <div style="text-align: center">
            <h2>Expense Information</h2>
        </div>
        <div class="row" style="padding: 2%">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-header">Total Candidate Expense</div>
                    <div class="card-group">
                        <div class="card text-center">
                            <div class="card-header inside">Monthly</div>
                            <div class="card-body"><?php echo $monthlyCandidateExpense["candidateExpense"]; ?></div>
                        </div>
                        <div class="card text-center">
                            <div class="card-header inside">Daily</div>
                            <div class="card-body"><?php echo $dailyCandidateExpense["candidateExpense"]; ?></div>
                        </div>
                    </div>                    
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