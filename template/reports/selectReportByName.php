<?php
$by = $_GET['by'];
$result = $conn->query("SELECT agentName, agentEmail from agent");
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>Agent Report by Name</h2>
    </div>
    <form action="index.php" method="get">
        <div class="form-group">
            <input type="hidden" value="agentReport" name="page">
            <label for="sel1">Select Agent:</label>
            <select class="form-control select2" id="agentInfo" name="agentInfo" onchange="showReport()">
                <option value="">Select Agent Name</option>
                <?php while($agent = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?php echo $agent['agentName']."-".$agent['agentEmail']; ?>"><?php echo $agent['agentName']; ?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <!-- <input type="button" value="Search" id="agentShow" onclick="showReport()"> -->
    </form> 
    <div id="showReportDiv">
    </div>
</div>

<script>
$('#reportNav').addClass('active');
function showReport(){    
    const agentInfo = $('#agentInfo').val();
    $.ajax({
        url: 'template/reports/agentReport.php',
        data: {agentInfo: agentInfo},
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