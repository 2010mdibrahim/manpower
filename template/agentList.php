<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Agent", $_SESSION['sections'])){
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
    .modal-dialog {
        max-width: 80%;
        margin: 1.75rem auto;
    }
    .returned_col{
        background-color: #bdbdbd;
        color: white;
    }
    .table-print a{
        text-decoration: none;
        color: black;
    }
</style>
<div class="container-fluid" style="padding: 2%">
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="check">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>
    <!-- Agent Report Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="showAgentReport">
        <div class="modal-dialog modal-xl" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agent Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="showAgentReportDiv">

                    </div>
                    <div class="modal-footer">
                        <button id="print_button" class="btn btn-info" type="button" onclick="print_div(this.value)"><i class="fa fa-print"></i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Agent Information</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Agent Email</th>
                        <th>Agent Name</th>
                        <th>Agent Phone</th>
                        <th>Document</th>
                        <th>Expense</th>
                        <th>Alter</th>
                    </tr>
                    </thead>
                    <?php
                    if(isset($_GET['agE'])){
                        $agentEmail = base64_decode($_GET['agE']);
                        $result = $conn->query("SELECT agentPassport, agentPoliceClearance, agentEmail, agentName, agentPhone, agentPhoto, comment FROM agent where agentEmail = '$agentEmail' order by creationDate desc");
                    }else{
                        $qry = "SELECT agentPassport, agentPoliceClearance, agentEmail, agentName, agentPhone, agentPhoto, comment FROM agent order by creationDate desc";
                        $result = mysqli_query($conn,$qry);
                    }                    
                    while($agent = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td>
                                <a target="_blank" href="<?php echo $agent['agentPhoto'];?>">
                                    <img class="agent thumbnail" src="<?php echo $agent['agentPhoto'];?>" alt="Forest">
                                </a>
                            </td>
                            <td><?php echo $agent['agentEmail'];?></td>
                            <td><?php echo $agent['agentName'];?></td>
                            <td><?php echo $agent['agentPhone'];?></td>
                            <td>
                            <a href="<?php echo $agent['agentPassport'];?>" target="_blank"><button class="btn btn-warning">Passport</button></a>
                            <a href="<?php echo $agent['agentPoliceClearance'];?>" target="_blank" ><button class="btn btn-info">Clearance</button></a>
                            </td>
                            <td>
                                <abbr title="Add Candidate Expense"><a href="?page=addExpenseAgent&ag=<?php echo base64_encode($agent['agentEmail']);?>"><button class="btn btn-sm btn-info"><span class="fas fa-plus"></span></button></a></abbr>
                                <abbr title="Add Agent Expense"><a href="?page=addExpenseAgentPersonal&ag=<?php echo base64_encode($agent['agentEmail']);?>"><button class="btn btn-sm btn-info"><i class="fas fa-user-plus"></i></button></a></abbr>
                                <!-- <abbr title="Agent Account"><a href="?page=showAgentExpenseList&ag=<?php echo base64_encode($agent['agentEmail']);?>" target="_blank"><button class="btn btn-sm btn-info"><span class="fas fa-dollar"></span></button></a></abbr> -->
                                <abbr title="Agent Report"><button data-target="#showAgentReport" data-toggle="modal" class="btn btn-info btn-sm" value="<?php echo $agent['agentName']."-".$agent['agentEmail'];?>" onclick="showReport(this.value)"><span class="fas fa-eye"></span></button></abbr>
                            </td>
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editAgent" name="pagePost">
                                            <input type="hidden" value="<?php echo $agent['agentEmail']; ?>" name="agentEmail">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/addNewAgentQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editAgent" name="pagePost">
                                            <input type="hidden" value="<?php echo $agent['agentEmail']; ?>" name="agentEmail">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Photo</th>
                        <th>Agent Email</th>
                        <th>Agent Name</th>
                        <th>Agent Phone</th>
                        <th>Document</th>
                        <th>Expense</th>
                        <th>Alter</th>
                    </tr>
                    </tfoot>

                </table>
                <div id="showAgentReportDivPrint">

                </div>
            </div>
        </div>
    </div>  
</div>


<script>
    function print_div(agentInfo){
        $.ajax({
            url: 'template/reports/agentReportPrint.php',
            data: {agentInfo: agentInfo},
            type: 'post',
            success: function(response){
                $('#showAgentReportDivPrint').html(response);
                $('#dataTableSeaumPrint').DataTable({
                    "paging": false,
                    "order": [[0, "desc"]],
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                        }
                    ],
                    "searching": false,
                    "bInfo" : false
                });
                $("#showAgentReportDivPrint").print({
                    noPrintSelector: ".exclude",
                    globalStyles: true,
                    doctype: '<!doctype html>',
                    title: agentInfo,   
                });
                $('#showAgentReportDivPrint').html('');
                
            }
        });        
    }
    $('#agentNav').addClass('active');
    function showReport(agentInfo){
        $.ajax({
            url: 'template/reports/agentReport.php',
            data: {agentInfo: agentInfo},
            type: 'post',
            success: function(response){
                $('#showAgentReportDiv').html(response);
                $('#print_button').val(agentInfo);
                console.log(agentInfo);
                $('.returned').parent().addClass('returned_col');
                let table = $('#dataTableSeaum').DataTable({
                    "fixedHeader": true,
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "scrollX": false,
                    "order": [[0, "desc"]],
                    "scrollX": false,
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],
                    "lengthMenu": [
                        [10, 25, 50, 100, 500],
                        [10, 25, 50, 100, 500]
                    ],
                    
                });
                // table.buttons().remove();
            }
        });
    }
</script>
