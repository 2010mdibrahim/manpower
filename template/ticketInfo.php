<?php
$ticketId = base64_decode($_GET['tI']);
$ticketInfo = mysqli_fetch_assoc($conn->query("SELECT * from ticket where ticketId = $ticketId"));
?>
<style>
.box{
    display: flex;
    justify-content: center;
    align-items: center;
}
.card{
    width: 50%;
    margin: 2%;
}
</style>

<div class="box">
    <div class="card">
        <div class="card-header text-center">
            <h3>Ticket Information</h3>
        </div>
        <div class="card-body">
            <img class="card-img" src="<?php echo $ticketInfo['ticketCopy']; ?>" alt="Card image" height="250">
        </div>
        <div class="card-body">
            <p class="card-text">Passport Number: <?php echo $ticketInfo['passportNum']; ?></p>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="card-text">Airlines: <?php echo $ticketInfo['airline']; ?></p>
                </div>
                <div class="col-md-6">
                    <p class="card-text">Flight No: <?php echo $ticketInfo['flightNo']; ?></p>
                </div>
            </div>            
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="card-text">Flight Date: <?php echo $ticketInfo['flightDate']; ?></p>
                </div>
                <div class="col-md-6">
                    <p class="card-text">Transit: <?php echo ($ticketInfo['transit'] == 0) ? 'No Transit' : $ticketInfo['transit']; ?></p>
                </div>
            </div>            
        </div>
        <hr>
        <div class="card-body">
            <p class="card-text">To: <?php echo $ticketInfo['flightTo']; ?></p>         
        </div>
        <hr>
        <div class="card-body">
            <p class="card-text">Total Price: <?php echo number_format($ticketInfo['ticketPrice'])." BDT"; ?></p>         
        </div>
    </div>
</div>
