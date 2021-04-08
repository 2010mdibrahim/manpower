<?php
include ('class/homeInformations.class.php');
class HomeController{
    private $homeInformation;

    function __construct()
    {
        $this->homeInformation = new HomeInformation();
    }
    

    public function candidateMonthlyExpense()
    {
        $expense = $this->homeInformation->getCandidateExpenseMonthly();
        return $expense;
    }
    public function candidateDailyExpense()
    {
        $expense = $this->homeInformation->getCandidateExpenseDaily();
        return $expense;
    }
}