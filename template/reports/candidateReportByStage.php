<?php
// $by = $_GET['by'];
// $qry = "select agentId, agentName from agent";
// $result = mysqli_query($conn,$qry);
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report</h2>
    </div>
    <form action="index.php" method="get">
        <div class="form-group">
            <input type="hidden" value="candidateReport" name="page">
            <div class="row">
                <div class="col-md-10">
                    <label for="sel1">Select Stage:</label>
                    <select class="form-control" id="stage" name="stage" onchange="fetchStageCandidate(this.value)">
                        <option value="">Select Stage</option>
                        <option value="testMedical">Test Medical</option>
                        <option value="finalMedical">Final Medical</option>
                        <option value="empRqst">Employee Request</option>
                        <option value="foreignMole">Foreign Mole</option>
                        <option value="okala">Okala</option>
                        <option value="mufa">Mufa</option>
                        <option value="medicalUpdate">Medical Update</option>
                        <option value="visaStamping">Visa Stamping</option>
                        <option value="finger">Finger</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div id="showReportDiv" style="margin-top: 5px;">
    </div>
</div>
<script>
    function fetchStageCandidate(stage){
        $.ajax({
        url: 'template/reports/fetchCandidateReportByStage.php',
        data: {
            stage: stage
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