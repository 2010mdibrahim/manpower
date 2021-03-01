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
                        <th>Passport No</th>
                        <th>Airplane</th>
                        <th>Flight No</th>
                        <th>Flight Date</th>
                        <th>Transit</th>
                        <th>To</th>
                        <th>Amount</th>
                        <th>Comment</th>                        
                        <th>Ticket Copy</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    $agent = $_SESSION['email'];
                    $result = $conn->query("SELECT * from ticket order by creationDate desc");
                    while($ticket = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $ticket['passportNum'];?></td>
                            <td><?php  echo $ticket['airline'];?></td>
                            <td><?php  echo $ticket['flightNo'];?></td>
                            <td><?php  echo $ticket['flightDate'];?></td>
                            <td>
                            <?php  
                            if($ticket['transit'] == 0.0){
                                echo "No Transit";
                            }else{
                                echo $ticket['transit']." Hours";
                            }
                            ?></td>
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
                                            <input type="hidden" value="<?php echo $candidate['ticketId']; ?>" name="ticketId">
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
                        <th>From</th>
                        <th>To</th>
                        <th>Amount</th>
                        <th>Comment</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        $('#ticketNav').addClass('active');
    };
</script>

