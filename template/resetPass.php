<?php 
$employeeId = base64_decode($_GET['eI']);
?>
<style>
.card{
    margin-top: 50px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-25">
            <div class="card-header text-center">
            Change Password
            </div>
            <div class="card-body">
                <div class="text-center">
                <span id="done" style="color: green; display: none;font-weight: 600;">Done</span>
                </div>
                <form action="template/restPassQry.php" id="restPassForm">
                    <input type="hidden" name="employeeId" value="<?php echo $employeeId?>">
                    <div class="form-group">
                        <label for="old_password">Enter Old Password <span id="noMatch" style="color: red; display: none;">No Match</span> </label>
                        <input class="form-control" type="password" name="old_password" id="old_password" placeholder="Enter old password" required>
                    </div>
                    <div class="form-group">
                        <label for="old_password">Enter New Password </label>
                        <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group">
                        <label for="old_password">Confirm New Password <span id="notEqual" style="color: red; display: none;">Confirm Same Password</span> </label>
                        <input class="form-control" type="password" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm New Password" onclick="resetPass()" required>
                    </div>
                    <input class="form-control" type="button" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function resetPass(){
    event.preventDefault();
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var new_password_confirm = $('#new_password_confirm').val();
    $.ajax({
        type: 'post',
        url: 'template/resetPassQry.php',
        data: {old_password : old_password, new_password : new_password, new_password_confirm : new_password_confirm},
        success: function (response){
            if(response === 'noMatch'){
                $('#noMatch').show();
            }else if(response === 'notEqual'){
                $('#notEqual').show();
            }else{
                $('#done').show();
                setTimeout(function(){ window.location.href='../index.php?page=employeeList'; }, 3000);
            }
        }
    });
}
</script>