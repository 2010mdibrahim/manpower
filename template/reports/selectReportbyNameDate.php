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
                <div class="col-sm">
                    <label for="date_from">Date From</label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date_from" id="date_from" placeholder="Select Date From">
                </div>
                <div class="col-sm">
                    <label for="date_to">Date To</label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date_to" id="date_to" placeholder="Select Date From">
                </div>
                <div class="col-sm align-self-end">
                    <input class="form-control" type="button" value="Search" id="agentShow" onclick="showReport()">
                </div>
            </div>            
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="include" id="includeCompleted" name="includeCompleted">
                        <label class="form-check-label" for="includeCompleted">
                            Include Completed List
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
function showReport(){    
    const agentInfo = $('#agentInfo').val();
    const date_from = $('#date_from').val();
    const date_to = $('#date_to').val();
    const includeCompleted = $('input[name="includeCompleted"]:checked').val();
    $.ajax({
        url: 'template/reports/agentReportNameDate.php',
        data: {
            agentInfo: agentInfo,
            date_from: date_from,
            date_to: date_to,
            includeCompleted: includeCompleted
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