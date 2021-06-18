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
    .modal-xl {
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
    <!-- Add/Update Agent Password Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="update_password_modal">
        <div class="modal-dialog modal-sm" role="document">
            <form method="post" id="update_password">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add/Update Agent Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="agent_email" id="agent_email">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-danger" id="error_message"></p>
                            </div>
                            <div class="col-md-12 mb-2">
                                <input class="form-control" type="text" name="password" id="password" placeholder="Enter Password">
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add/Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
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
                <table id="agent_list_datatable" class="table table-bordered table-hover" style="width:100%">
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
                    <tbody></tbody>
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
    $('#update_password').submit(function(){
        event.preventDefault();
        let password = $('#password').val();
        let password_confirm = $('#password_confirm').val();
        if(password != password_confirm){
            $('#error_message').html("Password Does Not Match");
            return false;
        }
        let agent_email = $('#agent_email').val();
        $.ajax({
            url: 'template/ajax/update_agent_password.php',
            data: {agent_email: agent_email, password: password},
            type: 'post',
            success: function(response){
                $('#update_password_modal').modal('hide');
                $('#password').val('');
                $('#password_confirm').val('');
                if(response === 'true'){
                    success_alert('Password Changed Successfull!!');
                }else{
                    error_alert('Something went wrong!!');
                }
            }
        });
    });
    function update_password_agent_val(agent_email){
        $('#agent_email').val(agent_email);
    }
    function print_div(agentInfo){
        console.log(agentInfo);
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
                $('.returned').parent().addClass('returned_col');
                let pdf_total_comission = $('#pdf_total_comission').html();
                console.log(pdf_total_comission);
                let pdf_total_expense = $('#pdf_total_expense').html();
                let pdf_total_final = $('#pdf_total_final').html();
                let pdf_total_loss = $('#pdf_total_loss').html();
                if(pdf_total_final.charAt(0) === '-'){
                    color_div = 'red';
                }else{
                    color_div = 'black';
                }
                console.log(color_div);
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
                    "order": [[0, "desc"]],
                    "scrollX": false,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            exportOptions : {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions : {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions : {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            customize: function ( doc ) {
                                doc.content.splice(0, 1, {
                                    text: [
                                            { text: 'Total Comission: \n',fontSize:12,alignment: 'center' },
                                            { text: pdf_total_comission + '\n',bold: true, fontSize:15,alignment: 'center' },
                                            '\n',
                                            { text: 'Total Expense: \n',fontSize:12,alignment: 'center' },
                                            { text: pdf_total_expense + '\n',bold: true, fontSize:15,alignment: 'center' },
                                            '\n',
                                            { text: 'Grand Total: \n',fontSize:12,alignment: 'center' },
                                            { text: pdf_total_final + '\n',color: color_div,bold: true, fontSize:15,alignment: 'center' },
                                            '\n',
                                            { text: 'Return Loss: \n',fontSize:12,alignment: 'center' },
                                            { text: pdf_total_loss + '\n',bold: true, fontSize:15,alignment: 'center' },
                                    ],
                                    margin: [0, 0, 0, 12],
                                    alignment: 'center'
                                });
                            },
                            exportOptions : {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],

                });
            }
        });
        // $.ajax({
        //     url: 'template/reports/agentReport.php',
        //     data: {agentInfo: agentInfo},
        //     type: 'post',
        //     success: function(response){
        //         $('#showAgentReportDiv').html(response);
        //         $('#print_button').val(agentInfo);
        //         console.log(agentInfo);
        //         $('.returned').parent().addClass('returned_col');
        //         let table = $('#dataTableSeaum').DataTable({
        //             "fixedHeader": true,
        //             "paging": true,
        //             "lengthChange": true,
        //             "searching": true,
        //             "ordering": true,
        //             "info": true,
        //             "autoWidth": true,
        //             "responsive": true,
        //             "scrollX": false,
        //             "order": [[0, "desc"]],
        //             "scrollX": false,
        //             "columnDefs": [
        //                 {
        //                     "targets": [ 0 ],
        //                     "visible": false,
        //                     "searchable": false
        //                 }
        //             ],
        //             "lengthMenu": [
        //                 [10, 25, 50, 100, 500],
        //                 [10, 25, 50, 100, 500]
        //             ],
        //             dom: 'Bfrtip',
        //             buttons: [
        //                 'copyHtml5',
        //                 'excelHtml5',
        //                 'csvHtml5',
        //                 'pdfHtml5'
        //             ]                    
        //         });
        //         // table.buttons().remove();
        //     }
        // });
    }
    $(document).ready(function(){
        var table_booking = $('#agent_list_datatable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "ScrollX": true,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo $datable_path ?>template/datatable/agentListDatatable.php",
            
        });
    });
</script>
