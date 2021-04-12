<?php 
require_once 'lib/dompdf/autoload.inc.php';
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
    });
</script>
<style>
    h4{
        padding: 0.5%;
    }
    .btn{
        font-size: 11px;        
    }
    .button_div{
        margin: 5%;
    }
    .no-access{
        color: red;
    }
</style>
<body>
<div id="data-loading"></div>
<?php include ('template/database.php'); ?>
<div id="seaum_alert">
<script>
    var data_loading = '<div style="position: fixed; z-index: 99999; top: 0%; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);"><center><img src="<?="img/loading.gif";?>" style="margin-top:16%;border-radius:50px 5px 50px 5px;"/></center></div>';
</script>
<div class="wrapper">
    <?php
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
        }
        // else if($page == 'expenseHeader'){
        //     include ('template/expenseHeader.php');
        // }else if($page == 'newExpenseHeader'){
        //     include ('template/newExpenseHeader.php');
        // }else if($pagePost == 'editExpenseHeader'){
        //     include ('template/editExpenseHeader.php');
        // }else if($page == 'newExpense'){
        //     include ('template/newExpense.php');
        // }else if($page == 'expenseDetails'){
        //     include ('template/expenseDetails.php');
        // }else if($pagePost == 'editExpense'){
        //     include ('template/editExpense.php');
        // }else if($page == 'addAdmin'){
        //     include ('template/addAdmin.php');
        // }
        else if($page == 'addVisaPayment'){
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
        }else if($page == 'selectCandidateReportByDate'){
            include ('template/reports/selectCandidateReportByDate.php');
        }else if($page == 'selectReportByNameDate'){
            include ('template/reports/selectReportByNameDate.php');
        }else if($page == 'selectAgentByTicket'){
            include ('template/reports/selectAgentByTicket.php');
        }else if($page == 'stageWiseCandidateReport'){
            include ('template/reports/candidateReportByStage.php');
        }else if($page == 'candidateReport'){
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
        }
        // else if($page == 'employeeList') {
        //     include('template/admin/employeeList.php');
        // }
        else if($page == 'addDepartment') {
            include('template/admin/addDepartment.php');
        }else if($pagePost == 'companyEmployeeList') {
            include('template/admin/companyEmployeeList.php');
        }
        // else if($pagePost == 'editEmployee') {
        //     include('template/admin/addEmployee.php');
        // }
        else if($pagePost == 'completeCandidate') {
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
        }else if($page == 'showAgentExpenseList') {
            include('template/showAgentExpenseList.php');
        }else if($pagePost == 'editAgentExpense') {
            include('template/editAgentExpense.php');
        }else if($pagePost == 'editSponsorVisa') {
            include('template/editSponsorVisa.php');
        }else if($page == 'addNewDelegate') {
            include('template/addNewDelegate.php');
        }else if($page == 'delegateList') {
            include('template/delegateList.php');
        }else if($pagePost == 'editDelegate') {
            include('template/editDelegate.php');
        }else if($page == 'tN') {  //ticket info
            include('template/ticketInfo.php');
        }else if($page == 'tNc') {  //ticket info
            include('template/completedTicketInfo.php');
        }else if($page == 'jobs') {
            include('template/jobs.php');
        }else if($pagePost == 'editVisaData') {
            include('template/editVisaData.php');
        }else if($pagePost == 'addCandidatePayment') {
            include('template/addCandidatePayment.php');
        }else if($pagePost == 'showCandidatePayment') {
            include('template/showCandidatePayment.php');
        }else if($pagePost == 'exchangeVisa') {
            include('template/exchangeVisa.php');
        }else if($page == 'ce') {
            include('template/showCandidatePayment.php');
        }else if($page == 'cI') {
            include('template/candidateDocumentInfo.php');
        }else if($page == 'ccI') {
            include('template/completeCandidateDocumentInfo.php');
        }else if($pagePost == 'editCandidatePayment') {
            include('template/editCandidatePayment.php');
        }else if($page == 'agentReport') {
            include('template/reports/agentReport.php');
        }else if($page == 'payMode') {
            include('template/payMode.php');
        }else if($page == 'addDelegateExpense') {
            include('template/addDelegateExpense.php');
        }else if($page == 'dlel') {
            include('template/delegateExpenseList.php');
        }else if($page == 'svf') {
            include('template/showVisaStampingFiles.php');
        }else if($page == 'svfc') {
            include('template/showVisaStampingFilesComplete.php');
        }else if($page == 'demo') {
            include('template/demo.php');
        }else if($page == 'completeListCandidate') {
            include('template/completeListCandidate.php');
        }else if($page == 'completeVisaList') {
            include('template/completeVisaList.php');
        }else if($page == 'cec') {
            include('template/showCandidatePaymentCompleted.php');
        }else if($page == 'delegateOfficeExpense') {
            include('template/delegateOfficeExpense.php');
        }else if($page == 'delegateOfficeExpenseList') {
            include('template/delegateOfficeExpenseList.php');
        }else if($pagePost == 'delegateOfficeExpenseListEdit') {
            include('template/delegateOfficeExpenseListEdit.php');
        }else if($page == 'newOffice') {
            include('template/newOffice.php');
        }else if($page == 'officeList') {
            include('template/officeList.php');
        }else if($pagePost == 'editOffice') {
            include('template/editOffice.php');
        }else if($page == 'delegateAllOfficeExpense') {
            include('template/delegateAllOfficeExpense.php');
        }else if($pagePost == 'editManpowerOffice') {
            include('template/editManpowerOffice.php');
        }else if($page == 'outsideListTicket') {
            include('template/outsideListTicket.php');
        }else if($page == 'outsideCandidateList') {
            include('template/outsideCandidateList.php');
        }else if($pagePost == 'editOutsideTicket') {
            include('template/editOutsideTicket.php');
        }else if($page == 'candidateInfo') {
            include('template/candidateInfo.php');
        }else if($page == 'manpowerJobList') {
            include('template/manpowerJobList.php');
        }else if($page == 'pendingListCandidate') {
            include('template/pendingListCandidate.php');
        }else if($page == 'pendingVisaList') {
            include('template/pendingVisaList.php');
        }else if($page == 'returnedListCandidate') {
            include('template/returnedListCandidate.php');
        }else if($page == 'returnedVisaList') {
            include('template/returnedVisaList.php');
        }else if($page == 'test') {
            include('template/test.php');
        }else if($page == 'newEmployee') {
            include('template/newEmployee.php');
        }else if($page == 'employeeList') {
            include('template/employeeList.php');
        }else if($page == 'addSections') {
            include('template/addSections.php');
        }else if($pagePost == 'editEmployee') {
            include('template/editEmployee.php');
        }else if($page == 'completedCandidateInfo') {
            include('template/completedCandidateInfo.php');
        }else if($page == 'getZip') {
            include('template/getZip.php');
        }else{
            include ('template/home.php');
        }
    } ?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php include 'includes/script.php'?>
<?php include ('includes/select2.php')?>
</div>
</body>
</html>


<script>
    $.ajax({
        type: 'post',
        url: 'template/notification.php',
        success: function(body){
            // Let's check if the browser supports notifications
            if(body != ""){
                if (!("Notification" in window)) {
                    alert("This browser does not support desktop notification");
                }

                // Let's check whether notification permissions have already been granted
                else if (Notification.permission === "granted") {
                    var notification = new Notification('Final Medical Report Due:', {body});
                }

                else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function (permission) {
                    // If the user accepts, let's create a notification
                        if (permission === "granted") {
                            var notification = new Notification('Final Medical Report Due:', {body});
                        }
                    });
                }
            }
        }
    });
    $.ajax({
        type: 'post',
        url: 'template/notificationTicket.php',
        success: function(body){
            // Let's check if the browser supports notifications
            if(body != ""){
                if (!("Notification" in window)) {
                    alert("This browser does not support desktop notification");
                }

                // Let's check whether notification permissions have already been granted
                else if (Notification.permission === "granted") {
                    var notification = new Notification('Ticket Date:', {body});
                }

                else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function (permission) {
                    // If the user accepts, let's create a notification
                        if (permission === "granted") {
                            var notification = new Notification('Ticket Date:', {body});
                        }
                    });
                }
            }
        }
    });
    $(".timePicker").timepicker();

    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        todayHighlight:'TRUE',
        autoclose: true,
    });
    window.onpageshow = function() {
        $('.select2').select2({
            width: '100%'
        });
    };    

    let permission = Notification.permission;
    if(permission === 'default'){
        Notification.requestPermission();
    }



    
</script>
