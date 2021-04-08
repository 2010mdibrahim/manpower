<?php
include ('dbc.class.php');
class changeCandidateStatus extends Dbc{    
    
    public function change(){
        $conn = $this->connection();
        $today = date('Y-m-d');
        $result_completed = $conn->query("SELECT passport.passportNum, passport.creationDate, processing.processingId from passport LEFT JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.pending = 1 AND processing.pendingTill < '$today'");
        print_r("SELECT passport.passportNum, passport.creationDate, processing.processingId from passport LEFT JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where processing.pending = 1 AND processing.pendingTill < '$today'");
        $payMode = 'paid';
        while($completed = mysqli_fetch_assoc($result_completed)){
            $passportNum = $completed['passportNum'];
            $creationDate = $completed['creationDate'];
            $processingId = $completed['processingId'];
            $candidateExpense = mysqli_fetch_assoc($conn->query("SELECT (SELECT sum(advanceAmount) from advance where advance.comissionId = agentcomission.comissionId) as advanceSum, sum(candidateexpense.amount) as candidateExpenseSum, agentcomission.amount, agentcomission.comissionId from agentcomission LEFT JOIN candidateexpense on candidateexpense.passportNum = agentcomission.passportNum AND candidateexpense.passportCreationDate = agentcomission.passportCreationDate where agentcomission.passportNum = '$passportNum' AND agentcomission.passportCreationDate = '$creationDate'"));
            $comissionSumAmount = (is_null($candidateExpense['candidateExpenseSum'])) ? 0 : $candidateExpense['candidateExpenseSum'];
            $advanceSumAmount = (is_null($candidateExpense['advanceSum'])) ? 0 : $candidateExpense['advanceSum'];
            $amount = $candidateExpense['amount'] - ($comissionSumAmount + $advanceSumAmount);
            $result = $conn->query("UPDATE processing set pending = 2 where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
            $result = $conn->query("UPDATE agentcomission set payMode = '$payMode', paidAmount = $amount where comissionId = ".$candidateExpense['comissionId']);
            $result = $conn->query("INSERT INTO passportcompleted SELECT * FROM passport WHERE passportNum = '$passportNum' AND creationDate = '$creationDate'");
            $result = $conn->query("INSERT INTO processingcompleted SELECT * FROM processing WHERE processingId = $processingId");
            if($result){
                if($result){
                    if($result){
                        $result = $conn->query("INSERT INTO completedagentcomission SELECT * FROM agentcomission WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                        $result = $conn->query("INSERT INTO completedcandidateexpense SELECT * FROM candidateexpense WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                        $result = $conn->query("INSERT INTO completedticket SELECT * FROM ticket WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                        $result = $conn->query("INSERT INTO completedadvance SELECT * FROM advance WHERE comissionId = ".$candidateExpense['comissionId']);
                        // $result = $conn->query("DELETE from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'");
                    }
                }
            }
        }
        echo 'done';
    }
}
?>