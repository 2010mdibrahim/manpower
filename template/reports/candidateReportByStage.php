<?php
// $by = $_GET['by'];
// $qry = "select agentId, agentName from agent";
// $result = mysqli_query($conn,$qry);
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Expense Report</h2>
    </div>
    <form action="index.php" method="get">
        <div class="form-group">
            <input type="hidden" value="candidateReport" name="page">
            <div class="row">
                <div class="col-md-12">
                    <label for="sel1">Select Stage:</label>
                    <select class="form-control" id="stage" name="stage">
                        <option value="">Select Stage</option>
                        <option value="testMedical-passport">Test Medical</option>
                        <option value="finalMedical-passport">Final Medical</option>
                        <option value="empRqst-processing">Employee Request</option>
                        <option value="foreignMole-processing">Foreign Mole</option>
                        <option value="okala-processing">Okala</option>
                        <option value="mufa-processing">Mufa</option>
                        <option value="medicalUpdate-processing">Medical Update</option>
                        <option value="medicalUpdate-processing">Visa Stamping</option>
                        <option value="finger-processing">Finger</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <input type="submit" value="Search">
    </form>
</div>