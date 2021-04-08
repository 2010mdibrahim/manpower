<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container col-12" style="padding: 2%">

    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Ticket Information</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Airplane</th>
                        <th>Flight No</th>
                        <th>Flight Date</th>
                        <th>Flight Time</th>
                        <th>Transit</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Amount</th>
                        <th>Comment</th>                        
                        <th>Ticket Copy</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    $agent = $_SESSION['email'];
                    if(isset($_GET['tI'])){
                        $ticketId = base64_decode($_GET['tI']);
                        $result = $conn->query("SELECT processing.pending, passport.fName, passport.lName, ticket.* from ticket INNER JOIN passport on passport.passportNum = ticket.passportNum AND passport.creationDate = ticket.passportCreationDate INNER JOIN processing on processing.passportNum = ticket.passportNum AND processing.passportCreationDate = ticket.passportCreationDate where ticket.ticketId = $ticketId order by passport.creationDate desc");
                    }else{
                        $result = $conn->query("SELECT processing.pending, passport.fName, passport.lName, ticket.* from ticket INNER JOIN passport on passport.passportNum = ticket.passportNum AND passport.creationDate = ticket.passportCreationDate INNER JOIN processing on processing.passportNum = ticket.passportNum AND processing.passportCreationDate = ticket.passportCreationDate order by creationDate desc");
                    }
                    while($ticket = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td>
                            <?php if($ticket['pending'] == 0) { ?>
                                <a href="?page=listCandidate&pp=<?php echo base64_encode($ticket['passportNum'])."&cd=".base64_encode($ticket['passportCreationDate']);?>"><?php echo $ticket['fName']." ".$ticket['lName'];?></a>
                            <?php }else{ ?>
                                <a href="?page=pendingListCandidate&pp=<?php echo base64_encode($ticket['passportNum'])."&cd=".base64_encode($ticket['passportCreationDate']);?>"><?php echo $ticket['fName']." ".$ticket['lName'];?></a>
                            <?php } ?>
                            </td>
                            <td><?php echo $ticket['airline'];?></td>
                            <td><?php echo $ticket['flightNo'];?></td>
                            <td><?php echo $ticket['flightDate'];?></td>
                            <td><?php echo $ticket['flightTime'];?></td>
                            <td>
                            <?php  
                            if($ticket['transit'] == 0.0){
                                echo "No Transit";
                            }else{
                                echo $ticket['transit']." Hours";
                            }
                            ?></td>
                            <td><?php  echo $ticket['flightFrom'];?></td>
                            <td><?php  echo $ticket['flightTo'];?></td>
                            <td><?php  echo $ticket['ticketPrice'];?></td>
                            <td>
                            <?php  
                            if(empty($ticket['comment'])){
                                echo 'No Comment';
                            }else{
                                echo $ticket['comment'];
                            }
                            
                            ?></td>
                            <td><a href="<?php echo $ticket['ticketCopy']; ?>" target="_blank"><button class="btn btn-info btn-sm">Copy</button></a></td>
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editTicket" name="pagePost">
                                            <input type="hidden" value="<?php echo $ticket['ticketId']; ?>" name="ticketId">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/editTicketQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editTicket" name="pagePost">
                                            <input type="hidden" value="<?php echo $ticket['ticketId']; ?>" name="ticketId">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot hidden>
                    <tr>
                        <th>Passport No</th>
                        <th>Airplane</th>
                        <th>Flight No</th>
                        <th>Flight Date</th>
                        <th>Flight Time</th>
                        <th>Transit</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Amount</th>
                        <th>Comment</th>                        
                        <th>Ticket Copy</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('#ticketNav').addClass('active');
</script>

