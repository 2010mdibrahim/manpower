<div class="container-fluid">
    <div id="info_div" style="padding: 35px;"></div>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            type: 'post',
            url: 'template/reports/agentReport.php',
            data: {agentInfo: '<?php echo $_SESSION['agentName'].'-'.$_SESSION['agent_email'].'-agent_portal';?>'},
            success: function(response){
                $('#info_div').html(response);
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
                    "scrollX": false
                });
            }
        });
    });
</script>