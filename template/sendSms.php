<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Send SMS</h4>
        </div>
        <form action="" id="send_sms_form" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="numbers">Enter Number/Numbers <abbr title="Use ',' to separate numbers."><i class="fa fa-question" style="color: #ef5350 ;"></i></abbr> </label>
                        <input class="form-control" type="text" name="numbers" placeholder="Enter Number">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="numbers">Enter Massage Body <abbr title="Use ',' to separate numbers."> </label>
                        <textarea class="form-control" name="massage" placeholder="Enter Text" style="height:150px;"></textarea>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group col-sm-12 p-2">
                    <button class="btn btn-success  " style="float: right;"> <i class="fas fa-sms"></i> Send SMS</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#send_sms_form').on('submit', function(){
        event.preventDefault();
        var form = $('#send_sms_form')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'post',
            data: data,
            url: "template/sendSmsQry.php",
            processData: false,
            contentType: false,
            success: function (data) {
                let info = JSON.parse(data);
                if(info.success){
                    $("#send_sms_form")[0].reset();
                    new jBox('Notice', {
                        color: 'green',
                        content: 'SMS sent successfully!',
                        attributes: {
                            x: 'right',
                            y: 'bottom'
                        }
                    });
                }else{
                    new jBox('Notice', {
                        color: 'red',
                        content: 'SMS failed to send!',
                        attributes: {
                            x: 'right',
                            y: 'bottom'
                        }
                    });
                }
            }
        });
    })
</script>