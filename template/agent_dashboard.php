<?php
// include ('database.php');
// if(!isset($_SESSION['sections'])){
//     header("Location: ../index.php");
//     exit();
// }else{
//     if(!in_array("All", $_SESSION['sections'])){
//         if(!in_array("Candidate", $_SESSION['sections'])){
//             if (headers_sent()) {
//                 die("No Access");
//             }else{
//                 header("Location: ../index.php");
//                 exit();
//             } 
//         }        
//     }
// }
$agent_info = mysqli_fetch_assoc($conn->query("SELECT agentName, agentPhoto from agent where agentEmail = '".$_SESSION['agent_email']."'"));
$agent_comission = mysqli_fetch_assoc($conn->query("SELECT sum(agentcomission.amount) as comission_sum from agentcomission INNER JOIN processing on processing.passportNum = agentcomission.passportNum AND processing.passportCreationDate = agentcomission.passportCreationDate INNER JOIN passport on passport.passportNum = agentcomission.passportNum AND passport.creationDate = agentcomission.passportCreationDate where agentcomission.agentEmail = '".$_SESSION['agent_email']."' AND processing.pending between 1 AND 2 AND passport.status != 2"));
// print_r(mysqli_error($conn));
$agent_comission_return = mysqli_fetch_assoc($conn->query("SELECT sum(agentcomission.amount) as return_comission_sum from agentcomission INNER JOIN processing on processing.passportNum = agentcomission.passportNum AND processing.passportCreationDate = agentcomission.passportCreationDate where agentcomission.agentEmail = '".$_SESSION['agent_email']."' AND processing.pending = 3"));
// $agent_comission_advance = mysqli_fetch_assoc($conn->query("SELECT sum(advanceAmount) as advance_sum from advance where agentEmail = '".$_SESSION['agent_email']."'"));
$candidate_expense = mysqli_fetch_assoc($conn->query("SELECT sum(candidateexpense.amount) as expense_sum from candidateexpense INNER JOIN passport on passport.passportNum = candidateexpense.passportNum AND passport.creationDate = candidateexpense.passportCreationDate LEFT JOIN processing on processing.passportNum = candidateexpense.passportNum AND processing.passportCreationDate = candidateexpense.passportCreationDate where candidateexpense.agentEmail = '".$_SESSION['agent_email']."' AND passport.status != 2"));
$agent_expense = mysqli_fetch_assoc($conn->query("SELECT sum(agentexpense.fullAmount) as agent_expense from agentexpense where agentexpense.agentEmail = '".$_SESSION['agent_email']."'"));
$total = $agent_comission['comission_sum'] - ($candidate_expense['expense_sum'] + $agent_expense['agent_expense']);
?>
<style>
    .text{
        font-size: 22px;
    }
    .col-md-6{
        padding: 10px;
    }
    .card{
        padding: 10px;
    }
    .header-text{
        font-size: 25px;
        font-weight: 600;
        margin-top: 15px;
    }
    .company-logo{
        width: 130px;
        margin-left: 15px;
    }
    @media only screen and (max-width: 600px) {
        .text{
            font-size: 15px;
        }
        .text-secondary{
            display: block;
        }
        .header-text{
            font-size: 20px;
            font-weight: 600;
            margin-top: 15px;
        }
        .company-logo{
            width: 100px;
            margin-left: 15px;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="row justify-content-between">
                <div class="col-md-2 col-2">
                    <img class="company-logo" src="img/company-logo.png" alt="">
                </div>
                <div class="col-md-10 col-8 text-center align-self-center">
                    <!-- <p style="font-size: 25px;font-weight: 600;margin-top: 15px;">Mahfuza Overseas - Agent Account  </p> -->
                    <p class="header-text">Mahfuza Overseas -  <span class="text-secondary"> Agent Account </span> </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12 text-center">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <img src="<?php echo $agent_info['agentPhoto'];?>" alt="" width="120px" height="120px" style="border-radius: 50%;">
                    </div>
                    <div class="col-md-6 col-6 align-self-center">
                        <p class="text"> <?php echo ($agent_info['agentName']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="card"> 
                <!-- <p class="text"> <span class="text-secondary"> Total Comission: </span> BDT <?php echo number_format($agent_comission['comission_sum']); ?></p> -->
                <p class="text"> <span class="text-secondary"> ????????? ???????????????: </span> BDT <?php echo number_format($agent_comission['comission_sum']); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="card">
                <!-- <p class="text"> <span class="text-secondary"> Total Expense: </span> BDT <?php echo number_format($candidate_expense['expense_sum'] + $agent_expense['agent_expense']); ?></p> -->
                <p class="text"> <span class="text-secondary"> ????????? ?????????: </span> BDT <?php echo number_format($candidate_expense['expense_sum'] + $agent_expense['agent_expense']); ?></p>
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="card">
                <!-- <p class="text"> <span class="text-secondary"> Total Saved: </span> BDT <?php echo ($total >= 0) ? number_format($total) : 0; ?></p> -->
                <p class="text"> <span class="text-secondary"> ????????? ????????? ?????????: </span> BDT <?php echo ($total >= 0) ? number_format($total) : 0; ?></p>
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="card">
                <!-- <p class="text"> <span class="text-secondary"> Total Due: </span> BDT <?php echo ($total < 0) ? number_format(abs($total)) : 0;  ?></p> -->
                <p class="text"> <span class="text-secondary"> ????????? ????????????: </span> BDT <?php echo ($total < 0) ? number_format(abs($total)) : 0;  ?></p>
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="card">
                <!-- <p class="text"> <span class="text-secondary"> Total Return Loss: </span> BDT <?php echo number_format($agent_comission_return['return_comission_sum']); ?></p> -->
                <p class="text"> <span class="text-secondary"> ????????? ???????????? ?????? : </span> BDT <?php echo number_format($agent_comission_return['return_comission_sum']); ?></p>
            </div>
        </div>
        <div class="col-md-12 col-12 text-center">
            <a style="margin-left: 60px;" href="index.php?page=agent_details_information"><button class="btn btn-primary">Details</button></a>
            <span style="float: right;"><a href="template/agent_logout.php"><button class="btn btn-danger">Logout</button></a></span>
        </div>
        <div class="col-md-12 col-12">
        </div>
    </div>
</div>