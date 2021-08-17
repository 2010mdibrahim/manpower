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
    .fa-asterisk{
        font-size: 0.5rem;
        color: red;
        vertical-align: text-top;
    }
    .capitalize{
        text-transform: capitalize;
    }
    
    
</style>
<body>
<div id="data-loading"></div>
<?php 
include ('template/database.php'); 
include ('template/class/unsetFailed.php');
$failed = new UnsetFailedLogin();
?>
<div id="seaum_alert">
<script>
    var data_loading = '<div style="position: fixed; z-index: 99999; top: 0%; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);"><center><img src="<?="img/loading.gif";?>" style="margin-top:16%;border-radius:50px 5px 50px 5px;"/></center></div>';
    function random_password(){
        var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var randomPassword = '';
        for (i = 0; i < 6; i++) {
            randomPassword = randomPassword + chars.charAt(
                Math.floor(Math.random() * chars.length)
            );
        }
        return randomPassword;
    }
    function success_alert(title, content){
        new jBox('Notice', {
            attributes: {
                x: 'right',
                y: 'bottom'
            },
            stack: false,
            animation: {
                open: 'tada',
                close: 'zoomIn'
            },
            color: 'green',
            title: title,
            content: content
        });
    }
    function error_alert(title, content){
        new jBox('Notice', {
            attributes: {
                x: 'right',
                y: 'bottom'
            },
            stack: false,
            animation: {
                open: 'tada',
                close: 'zoomIn'
            },
            color: 'red',
            title: title,
            content: content
        });
    }
</script>
<style>
    .col-print-1 {width:8%;  float:left;}
    .col-print-2 {width:16%; float:left;}
    .col-print-3 {width:25%; float:left;}
    .col-print-4 {width:33%; float:left;}
    .col-print-5 {width:42%; float:left;}
    .col-print-6 {width:50%; float:left;}
    .col-print-7 {width:58%; float:left;}
    .col-print-8 {width:66%; float:left;}
    .col-print-9 {width:75%; float:left;}
    .col-print-10{width:83%; float:left;}
    .col-print-11{width:92%; float:left;}
    .col-print-12{width:100%; float:left;}
    .logout_button_nav{
        text-decoration: none;
        color: white;
        border: 2px #8d6e63 solid;
        padding: 3px;
        border-radius: 5px;
        width: auto;
    }
    .logout_button_nav:hover{
        text-decoration: none;
        background-color: #8d6e63;
        color: white;
    }
</style>
<div class="wrapper">
    <div class="notification-slider custom-scroll">
        <div class="row notification-content">
            <div class="col-sm-12">
                <ul class="list-group">
                <li class="list-group-item"><span style="float: left;font-weight: 600;">Notifications</span><span style="float: right;cursor: pointer;" onclick="hide_notification()">Close</span></li> 
                </ul>
            </div>
            <div class="col-sm-12 notification-content-list" id="notification_slider_body"></div>
        </div>
    </div>
    <?php
    
    
        // include 'includes/topbar.php';
        if($page == 'newCandidate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/newCandidate.php');
            }
        }else if ($page == 'listCandidate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/listCandidate.php');
            }
        }else if($page == 'newVisa'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/newVisa.php');
            }
        }else if($page == 'visaList'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/visaList.php');
            }
        }else if($page == 'newTicket'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/newTicket.php');
        
            }
        }else if($page == 'listTicket'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/listTicket.php');
        
            }
        }else if($page == 'selectTicket'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/selectTicket.php');
        
            }
        }else if($page == 'selectTicketWithPassport'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/selectTicketWithPassport.php');
        
            }
        }else if($pagePost == 'editCandidate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/editCandidate.php');
        
            }
        }else if($pagePost == 'editVisa'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/editVisa.php');
        
            }
        }else if($pagePost == 'editTicket'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/editTicket.php');
            }
        }
        else if($page == 'addVisaPayment'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/addVisaPayment.php');
        
            }
        }else if($page == 'addVisaPaymentWithAgent'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/addVisaPaymentWithAgent.php');
        
            }
        }else if($page == 'addNewAgent'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/addNewAgent.php');        
            }
        }else if($page == 'agentList'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/agentList.php');
        
            }
        }else if($pagePost == 'editAgent'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/editAgent.php');
        
            }
        }else if($page == 'addNewSponsor'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include "template/addNewSponsor.php";

            }
        }else if($page == 'sponsorList'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include "template/sponsorList.php";
        
            }
        }else if($pagePost == 'editSponsor'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/editSponsor.php');
        
            }
        }else if($page == 'transferVisa'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/transferVisa.php');
        
            }
        }else if($pagePost == 'transferVisaWithCandidate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/transferVisaWithCandidate.php');
        
            }
        }else if($page == 'candidateVisaList'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/candidateVisaList.php');
        
            }
        }else if($page == 'selectStageVisa'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/selectStageVisa.php');
        
            }
        }else if($pagePost == 'medicalStage'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/medicalStage.php');
        
            }
        }else if($pagePost == 'emigrationStage'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/emigrationStage.php');
        
            }
        }else if($page == 'visaStamping'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/selectStageVisa.php');
        
            }
        }else if($pagePost == 'visaStampingStage'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/stampingStage.php');
        
            }
        }else if($pagePost == 'paymentStage'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/paymentStage.php');
        
            }
        }else if($page == 'completeCandidate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/selectCandidateUpdate.php');
        
            }
        }else if($page == 'report'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/report.php');
        
            }
        }else if($page == 'selectReportByName'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/selectReportByName.php');
        
            }
        }else if($pagePost == 'expenseReport'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/expenseReport.php');
        
            }
        }else if($page == 'selectCandidateReportByDate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/selectCandidateReportByDate.php');
        
            }
        }else if($page == 'selectReportByNameDate'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/selectReportByNameDate.php');
        
            }
        }else if($page == 'selectAgentByTicket'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/selectAgentByTicket.php');
        
            }
        }else if($page == 'stageWiseCandidateReport'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/candidateReportByStage.php');
        
            }
        }else if($page == 'candidateReport'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/candidateReport.php');
        
            }
        }else if($page == 'visaReportBySponsor'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/visaReportBySponsor.php');
        
            }
        }else if($pagePost == 'visaSponsorReport'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/reports/visaSponsorReport.php');
        
            }
        }else if($page == 'candidateWisePL') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/reports/candidateWisePL.php');
        
            }
        }else if($page == 'datatable') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/datatable.php');
        
            }
        }else if($page == 'admin') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/admin.php');
        
            }
        }else if($page == 'createCompany') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/createCompany.php');
        
            }
        }else if($page == 'company') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/company.php');
        
            }
        }else if($page == 'companyList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/companyList.php');
        
            }
        }else if($pagePost == 'editCompany'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/admin/createCompany.php');
            }
        }else if($page == 'department') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/department.php');
        
            }
        }else if($page == 'createDepartment') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/createDepartment.php');
        
            }
        }else if($page == 'departmentList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include('template/admin/departmentList.php');
        
            }
        }else if($pagePost == 'editDepartment'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/admin/createDepartment.php');
        
            }
        }else if($page == 'branch') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/branch.php');
        
            }
        }else if($page == 'createBranch') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/createBranch.php');
        
            }
        }else if($page == 'branchList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/branchList.php');
        
            }
        }else if($pagePost == 'editBranch'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/admin/createBranch.php');
        
            }
        }else if($page == 'salary') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/salary.php');
        
            }
        }else if($page == 'salaryList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/salaryList.php');
        
            }
        }else if($page == 'createSalary') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/createSalary.php');
        
            }
        }else if($pagePost == 'editSalary'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/admin/createSalary.php');
        
            }
        }else if($page == 'profession') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/profession.php');
        
            }
        }else if($page == 'createProfession') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/createProfession.php');
        
            }
        }else if($page == 'professionList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/professionList.php');
        
            }
        }else if($pagePost == 'editProfession'){
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/admin/createProfession.php');
        
            }
        }else if($page == 'createDesignation') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/createDesignation.php');
        
            }
        }else if($page == 'designationList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/designationList.php');
        
            }
        }else if($pagePost == 'editDesignation') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/createDesignation.php');
        
            }
        }else if($page == 'designation') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/designation.php');
        
            }
        }else if($page == 'employee') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/employee.php');
            }
        }else if($page == 'addEmployee') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/addEmployee.php');
            }
        }
        // else if($page == 'employeeList') {
        //     include('template/admin/employeeList.php');
        // }
        else if($page == 'addDepartment') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/addDepartment.php');
            }
        }else if($pagePost == 'companyEmployeeList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/companyEmployeeList.php');
            }
        }
        // else if($pagePost == 'editEmployee') {
        //     include('template/admin/addEmployee.php');
        // }
        else if($pagePost == 'completeCandidate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/completeCandidate.php');
            }
        }else if($pagePost == 'candidateWisePlReport') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/candidateWisePLReport.php');
            }
        }else if($page == 'companyDepartmentList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/companyDepartmentList.php');
            }
        }else if($pagePost == 'companyDepartmentListWithData') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/companyDepartmentListWithData.php');
            }
        }else if($page == 'addBranch') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/addBranch.php');
            }
        }else if($page == 'companyBranchList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/selectCompanyForBranch.php');
            }
        }else if($pagePost == 'companyBranchListWithData') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/companyBranchList.php');
            }
        }else if($page == 'reportByDate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/reportByDate.php');
            }
        }else if($pagePost == 'employeeReportTable') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/employeeReportTable.php');
            }
        }else if($page == 'cityWiseCandidateReport') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/cityWiseCandidateReport.php');
            }
        }else if($pagePost == 'cityWiseCandidateReportWithData') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/cityWiseCandidateReportWithData.php');
            }
        }else if($page == 'addMofa') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/mofa.php');
            }
        }else if($page == 'selectPassport') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/selectPassport.php');
            }
        }else if($pagePost == 'mofaUpdate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/mofaUpdate.php');
            }
        }else if($page == 'showEvidence') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showEvidence.php');
            }
        }else if($pagePost == 'mofaReportTable') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/mofaReportTable.php');
            }
        }else if($page == 'tmp') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/tmp.php');
            }
        }else if($page == 'selectSponsorDetailsReport') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/selectSponsorDetailsReport.php');
            }
        }else if($pagePost == 'sponsorDetailsReport') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/sponsorDetailsReport.php');
            }
        }else if($page == 'selectSponsorReportByCategory') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/selectSponsorReportByCategory.php');
            }
        }else if($pagePost == 'sponsorReportByCategory') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/sponsorReportByCategory.php');
            }
        }else if($page == 'switchJob') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/admin/switchJob.php');
            }
        }else if($page == 'visaSponsor') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/visaSponsor.php');
            }
        }else if($page == 'allVisaList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/allVisaList.php');
            }
        }else if($page == 'manpower') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/manpower.php');
            }
        }else if($page == 'manpowerList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/manpowerList.php');
            }
        }else if($page == 'addExpenseAgent') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/addExpenseAgent.php');
            }
        }else if($page == 'expenseAgentList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/expenseAgentList.php');
            }
        }else if($page == 'showAgentExpenseList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showAgentExpenseList.php');
            }
        }else if($pagePost == 'editAgentExpense') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editAgentExpense.php');
            }
        }else if($pagePost == 'editSponsorVisa') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editSponsorVisa.php');
            }
        }else if($page == 'addNewDelegate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/addNewDelegate.php');
            }
        }else if($page == 'delegateList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateList.php');
            }
        }else if($pagePost == 'editDelegate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editDelegate.php');
            }
        }else if($page == 'tN') {  //ticket info
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/ticketInfo.php');
            }
        }else if($page == 'tNc') {  //ticket info
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/completedTicketInfo.php');
            }
        }else if($page == 'jobs') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/jobs.php');
            }
        }else if($pagePost == 'editVisaData') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editVisaData.php');
            }
        }else if($pagePost == 'addCandidatePayment') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/addCandidatePayment.php');
            }
        }else if($pagePost == 'showCandidatePayment') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showCandidatePayment.php');
            }
        }else if($pagePost == 'exchangeVisa') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/exchangeVisa.php');
            }
        }else if($page == 'ce') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showCandidatePayment.php');
            }
        }else if($page == 'cI') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/candidateDocumentInfo.php');
            }
        }else if($page == 'ccI') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/completeCandidateDocumentInfo.php');
            }
        }else if($pagePost == 'editCandidatePayment') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editCandidatePayment.php');
            }
        }else if($page == 'agentReport') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/reports/agentReport.php');
            }
        }else if($page == 'payMode') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/payMode.php');
            }
        }else if($page == 'addDelegateExpense') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/addDelegateExpense.php');
            }
        }else if($page == 'dlel') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateExpenseList.php');
            }
        }else if($page == 'svf') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showVisaStampingFiles.php');
            }
        }else if($page == 'svfc') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showVisaStampingFilesComplete.php');
            }
        }else if($page == 'demo') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/demo.php');
            }
        }else if($page == 'completeListCandidate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/completeListCandidate.php');
            }
        }else if($page == 'completeVisaList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/completeVisaList.php');
            }
        }else if($page == 'cec') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/showCandidatePaymentCompleted.php');
            }
        }else if($page == 'delegateOfficeExpense') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateOfficeExpense.php');
            }
        }else if($page == 'delegateOfficeExpenseList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateOfficeExpenseList.php');
            }
        }else if($pagePost == 'delegateOfficeExpenseListEdit') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateOfficeExpenseListEdit.php');
            }
        }else if($page == 'newOffice') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/newOffice.php');
            }
        }else if($page == 'officeList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/officeList.php');
            }
        }else if($pagePost == 'editOffice') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editOffice.php');
            }
        }else if($page == 'delegateAllOfficeExpense') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateAllOfficeExpense.php');
            }
        }else if($pagePost == 'editManpowerOffice') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editManpowerOffice.php');
            }
        }else if($page == 'outsideListTicket') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/outsideListTicket.php');
            }
        }else if($page == 'outsideCandidateList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/outsideCandidateList.php');
            }
        }else if($pagePost == 'editOutsideTicket') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editOutsideTicket.php');
            }
        }else if($page == 'candidateInfo') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/candidateInfo.php');
            }
        }else if($page == 'manpowerJobList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/manpowerJobList.php');
            }
        }else if($page == 'pendingListCandidate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/pendingListCandidate.php');
            }
        }else if($page == 'pendingVisaList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/pendingVisaList.php');
            }
        }else if($page == 'returnedListCandidate') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/returnedListCandidate.php');
            }
        }else if($page == 'returnedVisaList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/returnedVisaList.php');
            }
        }else if($page == 'test') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/test.php');
            }
        }else if($page == 'newEmployee') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/newEmployee.php');
            }
        }else if($page == 'employeeList') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/employeeList.php');
            }
        }else if($page == 'addSections') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/addSections.php');
            }
        }else if($pagePost == 'editEmployee') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/editEmployee.php');
            }
        }else if($page == 'completedCandidateInfo') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/completedCandidateInfo.php');
            }
        }else if($page == 'getZip') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/getZip.php');
            }
        }else if($page == 'delegateAccount') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/delegateAccount.php');
            }
        }else if($page == 'resetPass') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/resetPass.php');
            }
        }else if($page == 'sendSms') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/sendSms.php');
            }
        }else if($page == 'crm') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/crm.php');
            }
        }else if($page == 'addExpenseAgentPersonal') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/addExpenseAgentPersonal.php');
            }
        }else if($page == 'all_notification') {
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include('template/all_notification.php');
            }
        }else if($page == 'agent_login') {
            if(isset($_SESSION['agent_email']) === false){
                include 'template/login_agent.php';
                $failed->unset_failed_login();
            }else{
                include 'template/agent_dashboard.php';
            }
        }else if($page == 'agent_dashboard') {
            if(isset($_SESSION['agent_email']) === false){
                include 'template/login_agent.php';
                $failed->unset_failed_login();
            }else{
                include 'template/agent_dashboard.php';
            }
        }else if($page == 'agent_details_information') {
            if(isset($_SESSION['agent_email']) === false){
                include 'template/login_agent.php';
                $failed->unset_failed_login();
            }else{
                include 'template/agent_details_information.php';
            }
        }else{
            if(isset($_SESSION['email']) === false){
                include 'template/login.php';
                $failed->unset_failed_login();
            }else{
                include 'includes/navbar.php';
                include ('template/home.php');
            }
        }
    ?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php include 'includes/script.php'?>
<?php include ('includes/select2.php')?>
</div>
</body>
</html>


<script>
    function show_notification(){
        $.ajax({
            type: 'post',
            url: 'template/notification_slider.php',
            success: function(body_msg){
                $('#notification_slider_body').html(body_msg);
            }
        });
        $(".notification-slider").addClass('show');
    }
    function hide_notification(){
        $(".notification-slider").removeClass('show');
    }
    $(document).ready(function(){
        let table = $('#dataTableSeaum').DataTable({
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
        table.row( 11 ).scrollTo();
        table.scroller.toPosition( 15 );
        console.log(table);
        $('#dataTableSeaumAgentList').DataTable({
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
            "order": [[ 4, "desc" ]],
            "scrollX": false
        });
        $.ajax({
            type: 'post',
            url: 'template/notification.php',
            success: function(body_msg){
                // if(body_msg != ""){
                //     new jBox('Notice', {
                //         animation: 'flip',
                //         color: 'blue',
                //         content: body_msg,
                //         attributes: {
                //             x: 'right',
                //             y: 'bottom'
                //         },                            
                //         delayOnHover: true,
                //         showCountdown: true
                //     });
                // }
            }
        });
        $(".timePicker").timepicker();

        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            todayHighlight:'TRUE',
            autoclose: true,
        });
    });
    
    window.onpageshow = function() {
        $('.select2').select2({
            width: '100%'
        });
    };    
</script>
