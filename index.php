<?php
$GLOBALS['base_url'] = "C:/xampp/htdocs/mahfuza/";
if(!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = '';
}
if(!empty($_GET['stage'])){
    $stage = $_GET['stage'];
}else{
    $stage = '';
}
if(!empty($_POST['pagePost'])){
    $pagePost = $_POST['pagePost'];
}else{
    $pagePost = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('includes/meta.php');?>
    <?php include ('includes/link.php')?>
    <?php include ('includes/datatable.php')?>
</head>

<script>

    $(document).ready(function() {
        $('#dataTableSeaum').DataTable({
            fixedHeader: true,
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
            "order": []
        });

              
    } );
</script>
<style>
    h4{
        padding: 0.5%;
    }
    .btn{
        font-size: 11px;        
    }
</style>
<body>
<div class="wrapper">
    <?php
    include ('template/database.php');
    if(isset($_SESSION['email']) === false){
        include 'template/login.php';
    }else{
        // include 'includes/topbar.php';
        include 'includes/navbar.php';
        if($page == 'newCandidate'){
            include ('template/newCandidate.php');
        }else if ($page == 'listCandidate'){
            include ('template/listCandidate.php');
        }else if($page == 'newVisa'){
            include ('template/newVisa.php');
        }else if($page == 'visaList'){
            include ('template/visaList.php');
        }else if($page == 'newTicket'){
            include ('template/newTicket.php');
        }else if($page == 'listTicket'){
            include ('template/listTicket.php');
        }else if($page == 'selectTicket'){
            include ('template/selectTicket.php');
        }else if($page == 'selectTicketWithPassport'){
            include ('template/selectTicketWithPassport.php');
        }else if($pagePost == 'editCandidate'){
            include ('template/editCandidate.php');
        }else if($pagePost == 'editVisa'){
            include ('template/editVisa.php');
        }else if($pagePost == 'editTicket'){
            include ('template/editTicket.php');
        }else if($page == 'expenseHeader'){
            include ('template/expenseHeader.php');
        }else if($page == 'newExpenseHeader'){
            include ('template/newExpenseHeader.php');
        }else if($pagePost == 'editExpenseHeader'){
            include ('template/editExpenseHeader.php');
        }else if($page == 'newExpense'){
            include ('template/newExpense.php');
        }else if($page == 'expenseDetails'){
            include ('template/expenseDetails.php');
        }else if($pagePost == 'editExpense'){
            include ('template/editExpense.php');
        }else if($page == 'addAdmin'){
            include ('template/addAdmin.php');
        }else if($page == 'addVisaPayment'){
            include ('template/addVisaPayment.php');
        }else if($page == 'addVisaPaymentWithAgent'){
            include ('template/addVisaPaymentWithAgent.php');
        }else if($page == 'addNewAgent'){
            include ('template/addNewAgent.php');
        }else if($page == 'agentList'){
            include ('template/agentList.php');
        }else if($pagePost == 'editAgent'){
            include ('template/editAgent.php');
        }else if($page == 'addNewSponsor'){
            include "template/addNewSponsor.php";
        }else if($page == 'sponsorList'){
            include "template/sponsorList.php";
        }else if($pagePost == 'editSponsor'){
            include ('template/editSponsor.php');
        }else if($page == 'transferVisa'){
            include ('template/transferVisa.php');
        }else if($pagePost == 'transferVisaWithCandidate'){
            include ('template/transferVisaWithCandidate.php');
        }else if($page == 'candidateVisaList'){
            include ('template/candidateVisaList.php');
        }else if($page == 'selectStageVisa'){
            include ('template/selectStageVisa.php');
        }else if($pagePost == 'medicalStage'){
            include ('template/medicalStage.php');
        }else if($pagePost == 'emigrationStage'){
            include ('template/emigrationStage.php');
        }else if($page == 'visaStamping'){
            include ('template/selectStageVisa.php');
        }else if($pagePost == 'visaStampingStage'){
            include ('template/stampingStage.php');
        }else if($pagePost == 'paymentStage'){
            include ('template/paymentStage.php');
        }else if($page == 'completeCandidate'){
            include ('template/selectCandidateUpdate.php');
        }else if($page == 'report'){
            include ('template/report.php');
        }else if($page == 'selectReportByName'){
            include ('template/reports/selectReportByName.php');
        }else if($pagePost == 'expenseReport'){
            include ('template/reports/expenseReport.php');
        }else if($page == 'selectReportByDate'){
            include ('template/reports/selectReportByDate.php');
        }else if($page == 'selectReportByNameDate'){
            include ('template/reports/selectReportByNameDate.php');
        }else if($page == 'selectAgentByTicket'){
            include ('template/reports/selectAgentByTicket.php');
        }else if($pagePost == 'agentReportWithTicket'){
            include ('template/reports/agentReport.php');
        }else if($page == 'stageWiseCandidateReport'){
            include ('template/reports/candidateReportByStage.php');
        }else if($pagePost == 'candidateReport'){
            include ('template/reports/candidateReport.php');
        }else if($page == 'visaReportBySponsor'){
            include ('template/reports/visaReportBySponsor.php');
        }else if($pagePost == 'visaSponsorReport'){
            include ('template/reports/visaSponsorReport.php');
        }else if($page == 'candidateWisePL') {
            include('template/reports/candidateWisePL.php');
        }else if($page == 'datatable') {
            include('template/datatable.php');
        }else if($page == 'admin') {
            include('template/admin/admin.php');
        }else if($page == 'createCompany') {
            include('template/admin/createCompany.php');
        }else if($page == 'company') {
            include('template/admin/company.php');
        }else if($page == 'companyList') {
            include('template/admin/companyList.php');
        }else if($pagePost == 'editCompany'){
            include ('template/admin/createCompany.php');
        }else if($page == 'department') {
            include('template/admin/department.php');
        }else if($page == 'createDepartment') {
            include('template/admin/createDepartment.php');
        }else if($page == 'departmentList') {
            include('template/admin/departmentList.php');
        }else if($pagePost == 'editDepartment'){
            include ('template/admin/createDepartment.php');
        }else if($page == 'branch') {
            include('template/admin/branch.php');
        }else if($page == 'createBranch') {
            include('template/admin/createBranch.php');
        }else if($page == 'branchList') {
            include('template/admin/branchList.php');
        }else if($pagePost == 'editBranch'){
            include ('template/admin/createBranch.php');
        }else if($page == 'salary') {
            include('template/admin/salary.php');
        }else if($page == 'salaryList') {
            include('template/admin/salaryList.php');
        }else if($page == 'createSalary') {
            include('template/admin/createSalary.php');
        }else if($pagePost == 'editSalary'){
            include ('template/admin/createSalary.php');
        }else if($page == 'profession') {
            include('template/admin/profession.php');
        }else if($page == 'createProfession') {
            include('template/admin/createProfession.php');
        }else if($page == 'professionList') {
            include('template/admin/professionList.php');
        }else if($pagePost == 'editProfession'){
            include ('template/admin/createProfession.php');
        }else if($page == 'createDesignation') {
            include('template/admin/createDesignation.php');
        }else if($page == 'designationList') {
            include('template/admin/designationList.php');
        }else if($pagePost == 'editDesignation') {
            include('template/admin/createDesignation.php');
        }else if($page == 'designation') {
            include('template/admin/designation.php');
        }else if($page == 'employee') {
            include('template/admin/employee.php');
        }else if($page == 'addEmployee') {
            include('template/admin/addEmployee.php');
        }else if($page == 'employeeList') {
            include('template/admin/employeeList.php');
        }else if($page == 'addDepartment') {
            include('template/admin/addDepartment.php');
        }else if($pagePost == 'companyEmployeeList') {
            include('template/admin/companyEmployeeList.php');
        }else if($pagePost == 'editEmployee') {
            include('template/admin/addEmployee.php');
        }else if($pagePost == 'completeCandidate') {
            include('template/completeCandidate.php');
        }else if($pagePost == 'candidateWisePlReport') {
            include('template/reports/candidateWisePLReport.php');
        }else if($page == 'companyDepartmentList') {
            include('template/admin/companyDepartmentList.php');
        }else if($pagePost == 'companyDepartmentListWithData') {
            include('template/admin/companyDepartmentListWithData.php');
        }else if($page == 'addBranch') {
            include('template/admin/addBranch.php');
        }else if($page == 'companyBranchList') {
            include('template/admin/selectCompanyForBranch.php');
        }else if($pagePost == 'companyBranchListWithData') {
            include('template/admin/companyBranchList.php');
        }else if($page == 'reportByDate') {
            include('template/reports/reportByDate.php');
        }else if($pagePost == 'employeeReportTable') {
            include('template/reports/employeeReportTable.php');
        }else if($page == 'cityWiseCandidateReport') {
            include('template/reports/cityWiseCandidateReport.php');
        }else if($pagePost == 'cityWiseCandidateReportWithData') {
            include('template/reports/cityWiseCandidateReportWithData.php');
        }else if($page == 'addMofa') {
            include('template/mofa.php');
        }else if($page == 'selectPassport') {
            include('template/selectPassport.php');
        }else if($pagePost == 'mofaUpdate') {
            include('template/mofaUpdate.php');
        }else if($page == 'showEvidence') {
            include('template/showEvidence.php');
        }else if($pagePost == 'mofaReportTable') {
            include('template/reports/mofaReportTable.php');
        }else if($page == 'tmp') {
            include('template/tmp.php');
        }else if($page == 'selectSponsorDetailsReport') {
            include('template/reports/selectSponsorDetailsReport.php');
        }else if($pagePost == 'sponsorDetailsReport') {
            include('template/reports/sponsorDetailsReport.php');
        }else if($page == 'selectSponsorReportByCategory') {
            include('template/reports/selectSponsorReportByCategory.php');
        }else if($pagePost == 'sponsorReportByCategory') {
            include('template/reports/sponsorReportByCategory.php');
        }else if($page == 'switchJob') {
            include('template/admin/switchJob.php');
        }else if($page == 'visaSponsor') {
            include('template/visaSponsor.php');
        }else if($page == 'allVisaList') {
            include('template/allVisaList.php');
        }else if($page == 'manpower') {
            include('template/manpower.php');
        }else if($page == 'manpowerList') {
            include('template/manpowerList.php');
        }else if($page == 'addExpenseAgent') {
            include('template/addExpenseAgent.php');
        }else if($page == 'expenseAgentList') {
            include('template/expenseAgentList.php');
        }else if($pagePost == 'showAgentExpenseList') {
            include('template/showAgentExpenseList.php');
        }else if($pagePost == 'editAgentExpense') {
            include('template/editAgentExpense.php');
        }else if($pagePost == 'editSponsorVisa') {
            include('template/editSponsorVisa.php');
        }else if($page == 'addNewDelegate') {
            include('template/addNewDelegate.php');
        }else if($page == 'delegateList') {
            include('template/delegateList.php');
        }else{
            include ('template/service.php');
            include 'includes/newsletter.php';
        }
        include 'includes/footer.php';
    } ?>




    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</div>
<?php include 'includes/script.php'?>
<?php include ('includes/select2.php')?>
</body>
</html>


<script>

    $('.select2').select2({
        placeholder: 'Select an option',
        width: '100%'
    });

    // $.fn.datepicker.defaults.format = "yyyy/mm/dd";
    // $('.datepicker').datepicker({
    //     format: "yyyy/mm/dd"
    // }); 


    
</script>
