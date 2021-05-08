<style>
    .box{
        border: 2px solid;
        margin: 5px;
        padding: 5px;
    }
</style>
<div class="container-fluid" style="padding: 2%;">
    <div class="section-header">
        <h2>Agent Report by Name</h2>
    </div>
    <form action="index.php" method="get">
        <div class="form-group">
            <input type="hidden" value="agentReport" name="page">
            <div class="row">
                <div class="col-sm">
                    <label for="sel1">Select Agent:</label>
                    <select class="form-control select2" id="agentInfo" name="agentInfo">
                        <option value="">Select Agent Name</option>
                        <?php 
                        $result = $conn->query("SELECT agentName, agentEmail from agent");
                        while($agent = mysqli_fetch_assoc($result)){ ?>
                            <option value="<?php echo $agent['agentName']."-".$agent['agentEmail']; ?>"><?php echo $agent['agentName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm date_div">
                    <label for="date_from">Date From</label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date_from" id="date_from" placeholder="Select Date From">
                </div>
                <div class="col-sm date_div">
                    <label for="date_to">Date To</label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date_to" id="date_to" placeholder="Select Date From">
                </div>
                <div class="col-sm align-self-end">
                    <input class="form-control w-25" type="button" value="Search" id="agentShow" onclick="showReport()">
                </div>
            </div>            
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="complete" id="completeReport" name="completeReport" onclick="hideDate()">
                        <label class="form-check-label" for="completeReport">
                            Show Complete Report
                        </label>
                    </div>
                </div> 
            </div>
        </div>
    </form> 
    <div id="showReportDiv" style="margin-top: 5px;">
    </div>
</div>    


<script>
$('#reportNav').addClass('active');

function hideDate(){
    const completeReport = $('input[name="completeReport"]:checked').val();
    if(completeReport == 'complete'){
        $('.date_div').hide();
    }else{
        $('.date_div').show();
    }

}

function showReport(){    
    const agentInfo = $('#agentInfo').val();
    const date_from = $('#date_from').val();
    const date_to = $('#date_to').val();
    const includeCompleted = $('input[name="includeCompleted"]:checked').val();
    const completeReport = $('input[name="completeReport"]:checked').val();
    $.ajax({
        url: 'template/reports/agentReportNameDate.php',
        data: {
            agentInfo: agentInfo,
            date_from: date_from,
            date_to: date_to,
            includeCompleted: includeCompleted,
            completeReport: completeReport
        },
        type: 'post',
        success: function(response){
            $('#showReportDiv').html(response);
            $('#dataTableSeaum').DataTable({
                "fixedHeader": true,
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [
                    [10, 25, 50, 100, 500],
                    [10, 25, 50, 100, 500]
                ],
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "order": [],
                "scrollX": false
            });  
        }
    });
}
</script>