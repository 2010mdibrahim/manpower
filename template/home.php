<?php
include ('homeController.php');
$homeController = new HomeController();
$monthlyCandidateExpense = $homeController->candidateMonthlyExpense();
$dailyCandidateExpense = $homeController->candidateDailyExpense();
$candidateNumbers = $homeController->candidateNumbers();
$homeController->change();
?>

<style>
    .inside{
        background-color: rgba(92, 107, 192, 0.8);
        color: black;        
    }
    .box{
        margin: 5px;
        height: 100%;
        border: 1px gray solid;
        border-radius: 5px;
    }
    .row{
        margin-right: 0;
        margin-left: 0;
    }
    .header{
        color: white;
        background-color: rgba(92, 107, 192, 1);
        border-bottom: 1px gray solid;
        border-width: inherit;
    }
    .text-nowrap {
        white-space: nowrap;
    }
    .header-inside{
        border-bottom: 1px rgba(92, 107, 192, 1) solid;
    }
</style>
<div class="service">
    <div class="container-fluid">
        <div style="text-align: center">
            <h2>Basic Overview</h2>
        </div>
        <div class="row" style="padding: 2%">
            <div class="box">
                <div class="row header  text-center">
                    <div class="col-sm">Total Candidate Expense</div>
                </div>
                <div class="inside">
                    <div class="row header-inside">
                        <div class="col-sm">
                            <div class="col-sm">Monthly</div>
                        </div>
                        <div class="col-sm">
                            <div class="col-sm text-right"><span class="text-nowrap"><?php echo number_format($monthlyCandidateExpense["candidateExpense"]); ?> &#2547</span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="col-sm">Daily</div>
                        </div>
                        <div class="col-sm">
                            <div class="col-sm text-right"><?php echo number_format($dailyCandidateExpense["candidateExpense"]); ?> &#2547</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div>
                    <canvas id="piechart" aria-label="Reprot" role="img"></canvas>
                </div>
                <div><p class="text-center">This months candidate amount</p></div>
            </div>
            <input type="hidden" id="monthProcessing" value="<?php echo $candidateNumbers['month'];?>">
            <input type="hidden" id="monthComplete" value="<?php echo $candidateNumbers['monthComplete'];?>">
            <input type="hidden" id="monthReturned" value="<?php echo $candidateNumbers['monthReturned'];?>">
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $('#home_nav').addClass('active');

    
    var ctx = document.getElementById('piechart');
    var monthProcessing = document.getElementById("monthProcessing").value;
    var monthComplete = document.getElementById("monthComplete").value;
    var monthReturned = document.getElementById("monthReturned").value;
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Processing', 'Completed', 'Returned'],
            datasets: [{
                label: '# of Votes',
                data: [monthProcessing, monthComplete, monthReturned],
                backgroundColor: [
                    'rgba(249, 251, 231, 1)',
                    'rgba(224, 242, 241, 1)',
                    'rgba(255, 205, 210, 1)'
                ],
                borderColor: [
                    'rgba(205, 220, 57, 1)',
                    'rgba(0, 121, 107, 1)',
                    'rgba(244, 67, 54, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    myChart.canvas.parentNode.style.height = '300px';
    myChart.canvas.parentNode.style.width = '300px';
</script>