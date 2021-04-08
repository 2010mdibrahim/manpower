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
}