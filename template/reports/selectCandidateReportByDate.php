<div class="container-fluid" style="padding: 2%;">
    <div class="section-header">
        <h2>Candidate Report by Date</h2>
    </div>
    <form action="index.php" method="get">
        <input type="hidden" value="agentReport" name="page">
        <div class="form-group">
            <div class="row">
                <div class="col-sm">
                    <label for="date_from">Date From</label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date_from" id="date_from" placeholder="Select Date From">
                </div>
                <div class="col-sm">
                    <label for="date_to">Date To</label>
                    <input class="form-control datepicker" autocomplete="off" type="text" name="date_to" id="date_to" placeholder="Select Date From">
                </div>
                <div class="col-md-1 align-self-end">
                    <input class="form-control" type="button" value="Search" id="agentShow" onclick="showReport()">
                </div>
            </div>
        </div>        
    </form> 
    <div id="showReportDiv" style="margin-top: 5px;">
    </div>
</div>    


<script>
$('#reportNav').addClass('active');

function showReport(){    
    const date_from = $('#date_from').val();
    const date_to = $('#date_to').val();
    const includeCompleted = $('input[name="includeCompleted"]:checked').val();
    $.ajax({
        url: 'template/reports/candidateReportByDate.php',
        data: {
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