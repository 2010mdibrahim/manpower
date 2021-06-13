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
    .btn{
        font-size: 11px;
    }
    .indicator{
        font-size: 16px;
        font-weight: bold;
    }
    .processing a{
        color: white;
    }
    .indicator.green{
        border: 5px #66bb6a solid;
    }
    .indicator.blue{
        border: 5px #42a5f5 solid;
    }
    .indicator.red{
        border: 5px #f44336 solid;
    }
    .indicator.black{
        border: 5px #424242 solid;
    }
    .indicator.hold{
        border: 5px #f9a825  solid;
    }
    
    .indicator.disable{
        border: 5px #8d6e63  solid;
    }
</style>
<div class="container-fluid" style="padding: 2%">    
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Notification</h2>
            </div>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table id="all_notification" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Notification</th>
                        <th>Person</th>                               
                        <th>Notified On</th>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr hidden>
                        <th>Notification</th>
                        <th>Person</th>                               
                        <th>Notified On</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>        
    </div>
</div>

<script>
$(document).ready(function() {
    var table_booking = $('#all_notification').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "ScrollX": true,
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo $base_dir ?>template/datatable/all_notification_datatable.php"
    });
})

$('#visaNav').addClass('active');
</script>

