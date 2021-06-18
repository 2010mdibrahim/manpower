<style>
.table-content{
    padding: 35px;
}
@media screen AND (max-width: 600px) {
    .table-content{
        padding: 0px;
    }
    .container-fluid{
        padding-right: 0px;
        padding-left: 0px;
    }
}
</style>
<div class="container-fluid">
    <div class="table-content" id="info_div"></div>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            type: 'post',
            url: 'template/reports/agentReportForAgent.php',
            data: {agentInfo: '<?php echo $_SESSION['agentName'].'-'.$_SESSION['agent_email'].'-agent_portal';?>'},
            success: function(response){
                $('#info_div').html(response);
                $('#dataTableSeaum').DataTable({
                    "fixedHeader": true,
                    "paging": false,
                    "lengthChange": true,
                    "lengthMenu": [
                        [10, 25, 50, 100, 500],
                        [10, 25, 50, 100, 500]
                    ],
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": false,
                    "order": [[0, "desc"]],
                    "scrollX": false,
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
    });
</script>