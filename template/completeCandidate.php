<?php
$candidateId = $_POST['candidateId'];
$passport = $_POST['passportNo'];
$qry = "select count(visaId) as countVisa from visainfo where passNo = '$passport'";
$result = mysqli_query($conn,$qry);
$visaCount = mysqli_fetch_assoc($result);
if($visaCount['countVisa'] == 0){ ?>
    <div class="section-header" style="padding: 5%">
        <h3>No Visa is Assigned</h3>
    </div>
<?php }else{
$qry = "select visaId, name, visaFee, visaFeeStage from visainfo where passNo = '$passport'";
$resultVisaInfo = mysqli_query($conn,$qry);
?>
<div class="container-fluid" style="padding: 2%">
    <div class="section-header">
        <h2>Candidate Update Stage</h2>
    </div>
    <?php
    while($visaInfo = mysqli_fetch_assoc($resultVisaInfo)){
    $visaId = $visaInfo['visaId'];
    $qry = "select mediStage, COUNT(mediStage) as mediCount from medical where visaId = $visaId";
    $result = mysqli_query($conn,$qry);
    $mediStage = mysqli_fetch_assoc($result);
    $qry = "select stampStage, COUNT(stampStage) as stampCount from stamping where visaId = $visaId";
    $result = mysqli_query($conn,$qry);
    $stampingStage = mysqli_fetch_assoc($result);
    $qry = "select approval, COUNT(approval) as appCount from emigration where visaId = $visaId";
    $result = mysqli_query($conn,$qry);
    $emiStage = mysqli_fetch_assoc($result);
    ?>
    <div style="padding-bottom: 2%">
        <h3>Stage Update for Visa: <b>'<?php echo $visaInfo['name'];?>'</b></h3>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4">
            <div style="padding-bottom: 2%">
                <label>Medical Stage:</label>
                <?php if( $mediStage['mediCount'] == 0 || $mediStage['mediStage'] == 'Unfit'){?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Unfit</p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Fit</p>
                        </div>
                    </div>
                <?php }?>
                <br>
                <label>Visa Stamping Stage:</label>
                <?php if($stampingStage['stampCount'] == 0 || $stampingStage['stampStage'] != 'Done'){?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Not Done or Pending</p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Stamping Done</p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="col-md-4">
            <div style="padding-bottom: 2%">
                <label>Visa Fee Stage:</label>
                <?php if($visaInfo['visaFeeStage'] == 'Paid'){?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Paid</p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Not yet Paid</p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="col-md-4">
            <div style="padding-bottom: 2%">
                <label>Visa Emigration Stage:</label>
                <?php if($emiStage['appCount'] == 0 || $emiStage['approval'] != 'Done'){?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Emigration Not Done</p>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="row">
                        <div style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
                        </div>
                        <div style="margin-left: 20px;">
                            <p>Emigration Done</p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="col-md-4" style="margin: auto">
            <div style="padding-bottom: 2%">
                <label>Ticket Information:</label>
                <table class="table">
                    <thead>
                    <th>Flight No</th>
                    <th>Ticket Info</th>
                    </thead>
                    <tbody>
                <?php
                $qry = "select flightNo, amount, paid, count(flightNo) as flightCount from ticket where passportNum = '$passport'";
                $result = mysqli_query($conn,$qry);
                while($ticketInfo = mysqli_fetch_assoc($result)){
                    $dueAmount = $ticketInfo['amount'] - $ticketInfo['paid'];
                    if($ticketInfo['flightCount'] == 0){ ?>
                        <td colspan="2" style="text-align: center">No Information</td>
                    <?php }else{
                    if($dueAmount == 0){ ?>
                        <td><?php echo $ticketInfo['flightNo'];?></td>
                        <td>Paid</td>
                    <?php } else { ?>
                        <td><?php echo $ticketInfo['flightNo'];?></td>
                        <td>Not Paid</td>
                    <?php }
                }
                }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>



