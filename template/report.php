<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Report", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
?>
<div class="container-fluid" style="padding: 2%">
    <div class="row">
        <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Reports By Date</h5>
            <div>
                <a href="?page=selectReportByNameDate">Agent Report By Date</a>
            </div>
            <div>
                <a href="?page=selectCandidateReportByDate">Candidate Report By Date</a>
            </div>
            <!-- <div>
                <a href="?page=selectReportByName&by=name">Delegate Report By Date</a>
            </div> -->
            <!-- <div>
                <a href="?page=selectReportByNameDate&by=nameDate">Agent Report By Name and Date</a>
            </div>
            <div>
                <a href="?page=demo">Income Expense Report</a>
            </div> -->
        </div>
        <!-- <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Agent Report</h5>
            <div>
                <a href="?page=selectAgentByTicket&by=ticket">Ticket Agent Report</a>
            </div>
        </div> -->
        <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Candidate Report</h5>
            <div>
                <a href="?page=stageWiseCandidateReport&by=stage">Stage Wise Candidate Report</a>
            </div>
        </div>
        <!-- <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Visa Report</h5>
            <div>
                <a href="?page=visaReportBySponsor&by=sponsor">Visa Report by Sponsor</a>
            </div>
        </div>
        <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Sponsor Report</h5>
            <div>
                <a href="?page=selectSponsorDetailsReport&by=sponsor">Sponsor details report</a>
            </div>
            <div>
                <a href="?page=selectSponsorReportByCategory&by=sponsor">Sponsor Report by Visa Category</a>
            </div>
        </div>
        <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Profit and Loss Report</h5>
            <div>
                <a href="?page=candidateWisePL">Candidate wise profit and loss</a>
            </div>
        </div>
        <div class="column col-md-6" style="padding: 2%">
            <h5 style="background-color: aliceblue; padding: 0.5%">Report by Date</h5>
            <div>
                <a href="?page=reportByDate&reportType=employee">Employee report</a>
            </div>
            <div>
                <a href="?page=reportByDate&reportType=mofa">MOFA report</a>
            </div>
        </div> -->
    </div>
</div>

<script>
    $('#reportNav').addClass('active');
</script>