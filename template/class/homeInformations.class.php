<?php
class HomeInformation extends Dbc{

    public function getCandidateExpenseMonthly(){
        $conn = $this->connection();
        $firstDay = date('Y-m-01');
        $lastDay = date('Y-m-t');
        $result = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as candidateExpense from candidateexpense where payDate between '$firstDay' AND '$lastDay'"));
        $resultCompleted = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as candidateExpense from completedcandidateexpense where payDate between '$firstDay' AND '$lastDay'"));
        $total = $result['candidateExpense'] + $resultCompleted['candidateExpense'];
        $totalResult = array("candidateExpense" => $total);
        return $totalResult;
    }
    public function getCandidateExpenseDaily(){
        $conn = $this->connection();
        $today = date('Y-m-d');
        $result = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as candidateExpense from candidateexpense where payDate = '$today'"));
        $resultCompleted = mysqli_fetch_assoc($conn->query("SELECT sum(amount) as candidateExpense from completedcandidateexpense where payDate = '$today'"));
        $total = $result['candidateExpense'] + $resultCompleted['candidateExpense'];
        $totalResult = array("candidateExpense" => $total);
        return $totalResult;
    }
    public function candidateNumbers()
    {
        $conn = $this->connection();
        $firstDay = date('Y-m-01');
        $lastDay = date('Y-m-t');
        $today = date('Y-m-d');
        $monthCount = mysqli_fetch_assoc($conn->query("SELECT count(passportNum) as monthCount from passport where creationDate between '$firstDay' AND '$lastDay'"));
        $dayCount = mysqli_fetch_assoc($conn->query("SELECT count(passportNum) as dayCount from passport where creationDate = '$today'"));
        $monthCountCompleted = mysqli_fetch_assoc($conn->query("SELECT count(passportcompleted.passportNum) as monthCount from passportcompleted INNER JOIN processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate where passportcompleted.creationDate between '$firstDay' AND '$lastDay' AND processingcompleted.pending = 2"));
        $monthCountReturned = mysqli_fetch_assoc($conn->query("SELECT count(passportcompleted.passportNum) as monthCount from passportcompleted INNER JOIN processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate where passportcompleted.creationDate between '$firstDay' AND '$lastDay' AND processingcompleted.pending = 3"));
        $dayCountCompleted = mysqli_fetch_assoc($conn->query("SELECT count(passportcompleted.passportNum) as dayCount from passportcompleted INNER JOIN processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate where passportcompleted.creationDate between '$firstDay' AND '$lastDay' AND processingcompleted.pending = 2"));
        $dayCountReturned = mysqli_fetch_assoc($conn->query("SELECT count(passportcompleted.passportNum) as dayCount from passportcompleted INNER JOIN processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate where passportcompleted.creationDate = '$today' AND processingcompleted.pending = 3"));
        $numberOfCandidate = array("month"=>$monthCount['monthCount'], "day"=>$dayCount['dayCount'], "monthComplete"=>$monthCountCompleted['monthCount'], "monthReturned"=>$monthCountReturned['monthCount'], "dayComplete"=>$dayCountCompleted['dayCount'], "dayReturned"=>$dayCountReturned['dayCount']);
        return $numberOfCandidate;
    }
    public function changeStatus(){
        $conn = $this->connection();
        $today = date('Y-m-d');
        $result_completed = $conn->query("UPDATE processing set pending = 2 where processing.pending = 1 AND processing.pendingTill < '$today'");
        return $result_completed;
    }
}